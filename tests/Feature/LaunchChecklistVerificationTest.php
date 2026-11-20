<?php

namespace Tests\Feature;

use App\Http\Controllers\AdminController;
use App\Mail\NewQuoteAlert;
use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class LaunchChecklistVerificationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test POST /contact endpoint successfully stores inquiry lead and sends notification alert to Karry.
     */
    public function test_contact_inquiry_endpoint_stores_lead_and_dispatches_notification(): void
    {
        Mail::fake();

        $payload = [
            'full_name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '(813) 555-0199',
            'insurance_type' => 'commercial_auto',
            'message' => 'Need commercial auto quote for 3 delivery vans in Tampa.',
            'consent' => '1',
        ];

        $response = $this->postJson(route('contact.store'), $payload);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ])
            ->assertJsonStructure([
                'success',
                'message',
                'inquiry_id',
            ]);

        $inquiryId = $response->json('inquiry_id');
        $this->assertStringStartsWith('INQ-', $inquiryId);

        $this->assertDatabaseHas('quotes', [
            'quote_ref' => $inquiryId,
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '(813) 555-0199',
            'type' => 'commercial_auto',
            'status' => 'new',
        ]);

        Mail::assertSent(NewQuoteAlert::class, function ($mail) {
            return $mail->hasTo('karry@sureboundinsurance.com')
                && $mail->hasTo('info@sureboundinsurance.com');
        });
    }

    /**
     * Test POST /contact validation fails gracefully on invalid or missing inputs.
     */
    public function test_contact_inquiry_validates_required_fields(): void
    {
        Mail::fake();

        $response = $this->postJson(route('contact.store'), []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['first_name', 'last_name', 'email', 'phone', 'department', 'message']);

        Mail::assertNothingSent();
    }

    /**
     * Test quote modal / quote creation preserves Umbrella insurance type without collision.
     */
    public function test_quotes_store_preserves_umbrella_insurance_type(): void
    {
        Mail::fake();

        $payload = [
            'type' => 'umbrella',
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'phone' => '(813) 214-1731',
            'preferred_contact' => 'email',
            'zip' => '33602',
            'notes' => 'Looking for a $2M personal umbrella policy.',
            'consent' => '1',
        ];

        $response = $this->postJson(route('quotes.store'), $payload);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('quotes', [
            'email' => 'jane.smith@example.com',
            'type' => 'umbrella',
        ]);

        Mail::assertSent(NewQuoteAlert::class, function ($mail) {
            return $mail->hasTo('karry@sureboundinsurance.com')
                && $mail->hasTo('info@sureboundinsurance.com');
        });
    }

    /**
     * Test www host header permanently redirects (301) to non-www host.
     */
    public function test_www_host_redirects_permanently_to_non_www(): void
    {
        $response = $this->get('https://www.sureboundinsurance.com/');

        $response->assertStatus(301);
        $this->assertEquals('https://sureboundinsurance.com/', $response->headers->get('Location'));
    }

    /**
     * Test robots.txt contains canonical sitemap declaration.
     */
    public function test_robots_txt_contains_sitemap_directive(): void
    {
        $robotsPath = public_path('robots.txt');
        $this->assertFileExists($robotsPath);

        $content = File::get($robotsPath);
        $this->assertStringContainsString('Sitemap: https://sureboundinsurance.com/sitemap.xml', $content);
        $this->assertStringContainsString('Disallow: /admin', $content);
    }

    /**
     * Test schema.org JSON-LD contains Tampa identity and eliminates Wall St / 10005.
     */
    public function test_schema_json_ld_uses_tampa_identity(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('https://sureboundinsurance.com/#agency', false);
        $response->assertSee('100 N Tampa St, Suite 2500', false);
        $response->assertSee('33602', false);
        $response->assertSee('(813) 214-1731', false);

        $response->assertDontSee('Wall St');
        $response->assertDontSee('10005');
        $response->assertDontSee('Marcel Gherkina');
        $response->assertDontSee('Founded in 1982');
    }

    /**
     * Test homepage title and H1 match approved launch copy.
     */
    public function test_homepage_has_approved_launch_titles_and_h1(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('<title>Tampa, FL Insurance Agency | Surebound Insurance</title>', false);
        $response->assertSee('Insurance help from<br>people here in Tampa.', false);
    }

    /**
     * Test homepage renders founder Karry picture and bio.
     */
    public function test_homepage_renders_founder_karry_photo_and_bio(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('karry-founder.webp', false);
        $response->assertSee('I’m Karry, founder of Surebound Insurance.', false);
        $response->assertSee('My background in both personal and commercial insurance helps me work with families and business owners.', false);
    }

    /**
     * Test rebuilt public routes return 200 and legitimate content.
     */
    public function test_all_rebuilt_pages_return_ok(): void
    {
        $routes = [
            'coverage',
            'claims',
            'payment',
            'story',
            'team',
            'workers-compensation',
            'liability-insurance',
            'property-insurance',
            'group-benefits',
            'custom-quote',
            'compare',
            'articles',
            'guides',
            'faqs',
            'careers',
            'community',
            'contact',
        ];

        foreach ($routes as $route) {
            $response = $this->get(route($route));
            $response->assertStatus(200);
            $response->assertDontSee('Marcel Gherkina');
            $response->assertDontSee('Founded in 1982');
        }
    }

    /**
     * Test claims page includes real carrier hotlines and no specialty quote triggers.
     */
    public function test_claims_page_features_carrier_hotlines(): void
    {
        $response = $this->get(route('claims'));

        $response->assertStatus(200);
        $response->assertSee('Travelers', false);
        $response->assertSee('Progressive', false);
        $response->assertSee('Liberty Mutual', false);
        $response->assertSee('The Hartford', false);
        $response->assertSee('Citizens Property Insurance', false);
        $response->assertSee('Florida Peninsula', false);
        $response->assertSee('Tower Hill Insurance', false);
        $response->assertSee('Universal Property', false);
        $response->assertSee('(813) 214-1731', false);

        $response->assertDontSee('openSpecialtyQuoteModal');
        $response->assertDontSee('Aircraft / Drone Liability');
        $response->assertDontSee('Marine &amp; Hull Physical Damage');
    }

    /**
     * Test custom quote page contains functioning in-page form.
     */
    public function test_custom_quote_page_renders_in_page_form(): void
    {
        $response = $this->get(route('custom-quote'));

        $response->assertStatus(200);
        $response->assertSee('action="'.route('quotes.store').'"', false);
        $response->assertSee('name="type"', false);
        $response->assertSee('name="name"', false);
        $response->assertSee('name="email"', false);
        $response->assertSee('name="phone"', false);
    }

    /**
     * Test llms.txt and llms-full.txt machine-readable manifests return 200 and accurate facts for AI search engines.
     */
    public function test_llms_manifests_serve_accurate_knowledge_for_ai(): void
    {
        $response = $this->get('/llms.txt');
        $response->assertStatus(200);
        $this->assertStringContainsString('text/markdown', $response->headers->get('Content-Type'));
        $response->assertSee('# Surebound Insurance');
        $response->assertSee('Karry');
        $response->assertSee('Tampa, FL');
        $response->assertSee('(813) 214-1731');
        $response->assertSee('FL-L114920');

        $wellKnown = $this->get('/.well-known/llms.txt');
        $wellKnown->assertStatus(200);
        $wellKnown->assertSee('# Surebound Insurance');

        $fullResponse = $this->get('/llms-full.txt');
        $fullResponse->assertStatus(200);
        $fullResponse->assertSee('Surebound Insurance – Complete LLM Knowledge Base & Entity Manifest', false);
        $fullResponse->assertSee('Travelers Insurance');
        $fullResponse->assertSee('Progressive Insurance');

        $home = $this->get('/');
        $home->assertSee('rel="llms-txt"', false);
    }

    /**
     * Test robots.txt declares modern AI search engine directives.
     */
    public function test_robots_txt_contains_all_major_ai_crawlers(): void
    {
        $response = $this->get('/robots.txt');
        $response->assertStatus(200);

        $response->assertSee('User-agent: GPTBot');
        $response->assertSee('User-agent: ChatGPT-User');
        $response->assertSee('User-agent: OAI-SearchBot');
        $response->assertSee('User-agent: ClaudeBot');
        $response->assertSee('User-agent: Claude-Web');
        $response->assertSee('User-agent: PerplexityBot');
        $response->assertSee('User-agent: Google-Extended');
        $response->assertSee('User-agent: Applebot');
        $response->assertSee('User-agent: Bingbot');
        $response->assertSee('Sitemap: https://sureboundinsurance.com/sitemap.xml');
    }

    /**
     * Test careers page is strictly for joining the team and contains zero specialty lines or quote buttons.
     */
    public function test_careers_page_is_strictly_for_joining_the_team(): void
    {
        $response = $this->get('/careers');
        $response->assertStatus(200);

        // Positive careers content assertions
        $response->assertSee('CAREERS AT SUREBOUND', false);
        $response->assertSee('View Open Roles', false);
        $response->assertSee('Email Your Resume', false);
        $response->assertSee('careers@sureboundinsurance.com', false);
        $response->assertSee('Open Positions in Tampa, FL', false);
        $response->assertSee('Commercial Lines Account Manager', false);
        $response->assertSee('Personal Lines Account Specialist', false);
        $response->assertSee('Client Care &amp; Support Specialist', false);
        $response->assertSee('Continuing Education', false);
        $response->assertSee('Competitive Benefits', false);

        // Negative assertions: Ensure zero specialty lines or quote buttons
        $response->assertDontSee('Get Specialty Quote', false);
        $response->assertDontSee('Explore Specialty Lines', false);
        $response->assertDontSee('SPECIALTY RISK SOLUTIONS', false);
        $response->assertDontSee('Tailored Protection for One-of-a-Kind Assets', false);
        $response->assertDontSee('Collector Cars & Exotic Autos', false);
        $response->assertDontSee('Collector Cars &amp; Exotic Autos', false);
        $response->assertDontSee('Private Aviation & Aircraft', false);
        $response->assertDontSee('Private Aviation &amp; Aircraft', false);

        // Also verify the exported static dist/careers/index.html
        $distCareersPath = base_path('dist/careers/index.html');
        $this->assertFileExists($distCareersPath);
        $distCareersHtml = file_get_contents($distCareersPath);
        $this->assertStringNotContainsString('Get Specialty Quote', $distCareersHtml);
        $this->assertStringNotContainsString('Explore Specialty Lines', $distCareersHtml);
        $this->assertStringNotContainsString('Tailored Protection for One-of-a-Kind Assets', $distCareersHtml);
        $this->assertStringNotContainsString('Collector Cars', $distCareersHtml);
        $this->assertStringNotContainsString('Private Aviation', $distCareersHtml);
        $this->assertStringContainsString('View Open Roles', $distCareersHtml);
        $this->assertStringContainsString('careers@sureboundinsurance.com', $distCareersHtml);
    }

    /**
     * Test all forms persist data in database and notify both karry@ and info@sureboundinsurance.com simultaneously.
     */
    public function test_form_submission_keeps_data_in_database_and_dispatches_email_to_both_recipients(): void
    {
        Mail::fake();

        $payload = [
            'type' => 'business',
            'name' => 'Michael Scott',
            'email' => 'mscott@dundermifflin.com',
            'phone' => '(813) 555-4321',
            'zip' => '33602',
            'preferred_contact' => 'phone',
            'notes' => 'Looking for general liability and commercial property coverage.',
            'consent' => '1',
        ];

        $response = $this->postJson(route('quotes.store'), $payload);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        // 1. Data is preserved in database
        $this->assertDatabaseHas('quotes', [
            'name' => 'Michael Scott',
            'email' => 'mscott@dundermifflin.com',
            'phone' => '(813) 555-4321',
            'type' => 'business',
            'status' => 'new',
        ]);

        // 2. Email is dispatched simultaneously to both karry@ and info@sureboundinsurance.com
        Mail::assertSent(NewQuoteAlert::class, function ($mail) {
            return $mail->hasTo('karry@sureboundinsurance.com')
                && $mail->hasTo('info@sureboundinsurance.com');
        });

        // 3. Verify getLeadNotificationRecipients helper includes both recipients
        $recipients = AdminController::getLeadNotificationRecipients();
        $this->assertContains('karry@sureboundinsurance.com', $recipients);
        $this->assertContains('info@sureboundinsurance.com', $recipients);
    }
}
