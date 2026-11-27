<?php

namespace Tests\Feature;

use App\Http\Controllers\AdminController;
use App\Mail\NewQuoteAlert;
use App\Models\Quote;
use App\Services\GoHighLevelService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class GoHighLevelAndQuoteToolTest extends TestCase
{
    use RefreshDatabase;

    public function test_dedicated_quote_page_renders_successfully(): void
    {
        $response = $this->get('/quote');
        $response->assertStatus(200);
        $response->assertSee('Get a Quote');
        $response->assertSee('standaloneQuoteCard');
        $response->assertSee('images/logo.png');
    }

    public function test_unwritten_policies_redirect_to_homepage(): void
    {
        $redirects = [
            '/home-insurance',
            '/auto-insurance',
            '/umbrella-insurance',
            '/health-insurance',
        ];

        foreach ($redirects as $url) {
            $response = $this->get($url);
            $response->assertStatus(301);
            $response->assertRedirect('/');
        }
    }

    public function test_email_recipients_are_strictly_karry_and_info(): void
    {
        $recipients = AdminController::getLeadNotificationRecipients();

        $this->assertEquals([
            'karry@sureboundinsurance.com',
            'info@sureboundinsurance.com',
        ], $recipients);

        foreach ($recipients as $recipient) {
            $this->assertStringNotContainsString('sunshinewashes.com', $recipient);
        }
    }

    public function test_new_quote_alert_email_subject_formats_coverages_accurately(): void
    {
        $quoteMulti = Quote::create([
            'quote_ref' => 'Q-99112',
            'name' => 'John Doe',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@acme.com',
            'phone' => '(813) 555-0199',
            'type' => 'bop',
            'type_label' => 'Business Owner Policy',
            'coverages' => ['wc', 'auto'],
            'coverage' => 'Standard',
            'premium' => '$1,200',
            'location' => 'Tampa, FL',
            'zip_code' => '33602',
            'status' => 'new',
        ]);

        $mailableMulti = new NewQuoteAlert($quoteMulti);
        $envelopeMulti = $mailableMulti->envelope();
        $this->assertEquals("New quote request: Workers' Comp + Commercial Auto", $envelopeMulti->subject);

        $quoteSingle = Quote::create([
            'quote_ref' => 'Q-99113',
            'name' => 'Jane Smith',
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'email' => 'jane@acme.com',
            'phone' => '(813) 555-0198',
            'type' => 'bop',
            'type_label' => 'Business Owner Policy (BOP)',
            'coverages' => ['bop'],
            'coverage' => 'Standard',
            'premium' => '$1,500',
            'location' => 'Tampa, FL',
            'zip_code' => '33602',
            'status' => 'new',
        ]);

        $mailableSingle = new NewQuoteAlert($quoteSingle);
        $envelopeSingle = $mailableSingle->envelope();
        $this->assertEquals('New quote request: Business Owner Policy', $envelopeSingle->subject);
    }

    public function test_gohighlevel_service_dispatches_webhook_payload(): void
    {
        Http::fake([
            'https://services.leadconnectorhq.com/hooks/*' => Http::response(['success' => true], 200),
        ]);

        config(['services.gohighlevel.webhook_url' => 'https://services.leadconnectorhq.com/hooks/test-webhook']);

        $quote = Quote::create([
            'quote_ref' => 'Q-88888',
            'name' => 'Acme Leader',
            'first_name' => 'Acme',
            'last_name' => 'Leader',
            'business_name' => 'Acme Corp',
            'email' => 'leader@acmeweb.com',
            'phone' => '+18135550999',
            'type' => 'bop',
            'type_label' => 'Business Owner Policy (BOP)',
            'coverages' => ['bop', 'auto'],
            'tags' => ['COV-BOP', 'COV-AUTO', 'BUNDLE', 'RENEW-30D', 'OWNS-BUILDING', 'SOURCE-QUOTE-FLOW'],
            'coverage' => '$1,000,000 Tier',
            'premium' => '$2,100 / yr',
            'location' => 'ZIP: 33602',
            'zip_code' => '33602',
            'status' => 'new',
            'modular_data' => ['bop_eq' => 'Under $50,000'],
            'notes' => 'Test notes',
        ]);

        $result = GoHighLevelService::sendContact($quote);

        $this->assertTrue($result['success']);
        $this->assertEquals('webhook', $result['method']);

        Http::assertSent(function ($request) {
            return $request->url() === 'https://services.leadconnectorhq.com/hooks/test-webhook'
                && $request['companyName'] === 'Acme Corp'
                && in_array('COV-BOP', $request['tags'])
                && in_array('OWNS-BUILDING', $request['tags'])
                && $request['source'] === 'Surebound Quote Flow';
        });
    }

    public function test_full_public_quote_submission_dispatches_email_and_ghl(): void
    {
        Mail::fake();
        Http::fake([
            'https://services.leadconnectorhq.com/hooks/*' => Http::response(['success' => true], 200),
        ]);

        config(['services.gohighlevel.webhook_url' => 'https://services.leadconnectorhq.com/hooks/test-webhook']);

        $payload = [
            'fn' => 'Alex',
            'ln' => 'Rivera',
            'biz' => 'Rivera Roofing LLC',
            'em' => 'alex@riveraroofing.com',
            'ph' => '(813) 555-8822',
            'zip' => '33602',
            'coverages' => ['wc', 'auto'],
            'btype' => 'Contractor or trades',
            'desc' => 'Roofing installations and commercial repair',
            'emp' => '5 to 10 employees',
            'years' => '5 to 10 years',
            'rev' => '$500,000 to $1M',
            'claims' => 'None',
            'renew' => 'Within 30 days',
            'tags' => ['COV-WC', 'COV-AUTO', 'BUNDLE', 'RENEW-30D', 'SOURCE-QUOTE-FLOW'],
            'modular_data' => ['wc_payroll' => '$300,000 to $600,000', 'auto_fleet' => '3 to 5 vehicles'],
            'source_page' => '/quote',
        ];

        $response = $this->postJson(route('quotes.store'), $payload);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        // Email Alert dispatched strictly to karry and info
        Mail::assertSent(NewQuoteAlert::class, function ($mail) {
            $envelope = $mail->envelope();
            $this->assertEquals("New quote request: Workers' Comp + Commercial Auto", $envelope->subject);

            return $mail->hasTo('karry@sureboundinsurance.com')
                && $mail->hasTo('info@sureboundinsurance.com')
                && ! $mail->hasTo('test@sunshinewashes.com');
        });

        // GHL Webhook dispatched with tags and contact info
        Http::assertSent(function ($request) {
            return $request['firstName'] === 'Alex'
                && $request['lastName'] === 'Rivera'
                && $request['companyName'] === 'Rivera Roofing LLC'
                && in_array('COV-WC', $request['tags'])
                && in_array('BUNDLE', $request['tags']);
        });
    }
}
