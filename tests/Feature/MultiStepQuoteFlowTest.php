<?php

namespace Tests\Feature;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MultiStepQuoteFlowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the homepage loads the quote flow modal markup and assets.
     */
    public function test_multi_step_quote_flow_modal_is_present_on_site(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('id="quoteModal"', false);
        $response->assertSee('id="quoteFlowCard"', false);
        $response->assertSee('quote-flow.css', false);
        $response->assertSee('quote-flow.js', false);
    }

    /**
     * Test full multi-step quote flow submission with business details and tags.
     */
    public function test_multi_step_quote_submission_stores_structured_record_in_database(): void
    {
        $payload = [
            'fn' => 'Jane',
            'ln' => 'Smith',
            'biz' => 'Smith Roofing LLC',
            'em' => 'jane@smithroofing.com',
            'ph' => '(813) 555-4321',
            'zip' => '33602',
            'coverages' => ['bop', 'gl'],
            'btype' => 'Contractor or trades',
            'desc' => 'Residential and commercial roof installations',
            'emp' => '5 to 15',
            'years' => '2 to 5 years',
            'rev' => '$1 million to $3 million',
            'addr' => '456 Florida Ave, Tampa FL',
            'own' => 'Own it and use it',
            'modular_data' => [
                'bop_eq' => '$50,000 to $250,000',
                'gl_sub' => 'Yes',
                'gl_lim' => '$2 million per claim',
            ],
            'renew' => 'Within 30 days',
            'carrier' => 'Travelers',
            'claims' => 'None',
            'bundle' => 'Yes, bundle them',
            'tags' => ['COV-BOP', 'COV-GL', 'BUNDLE', 'RENEW-30D', 'OWNS-BUILDING', 'SOURCE-QUOTE-FLOW'],
        ];

        $response = $this->postJson(route('quotes.store'), $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
        $response->assertJsonStructure([
            'success',
            'message',
            'quote_ref',
            'quote_id',
        ]);

        $this->assertDatabaseHas('quotes', [
            'name' => 'Jane Smith',
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'business_name' => 'Smith Roofing LLC',
            'email' => 'jane@smithroofing.com',
            'phone' => '(813) 555-4321',
            'zip_code' => '33602',
            'type' => 'multi',
            'business_type' => 'Contractor or trades',
            'business_description' => 'Residential and commercial roof installations',
            'employees' => '5 to 15',
            'annual_revenue' => '$1 million to $3 million',
            'business_address' => '456 Florida Ave, Tampa FL',
            'location_ownership' => 'Own it and use it',
            'bundle_preference' => 'Yes, bundle them',
            'renewal_timeline' => 'Within 30 days',
            'current_carrier' => 'Travelers',
            'claims_history' => 'None',
            'status' => 'new',
        ]);

        $quote = Quote::where('email', 'jane@smithroofing.com')->first();
        $this->assertNotNull($quote);
        $this->assertEquals(['bop', 'gl'], $quote->coverages);
        $this->assertContains('COV-BOP', $quote->tags);
        $this->assertContains('BUNDLE', $quote->tags);
        $this->assertContains('RENEW-30D', $quote->tags);
        $this->assertEquals('$2 million per claim', $quote->modular_data['gl_lim']);
    }

    /**
     * Test single line personal coverage submission (e.g. Life Insurance).
     */
    public function test_single_coverage_life_insurance_flow_submission(): void
    {
        $payload = [
            'first_name' => 'Michael',
            'last_name' => 'Brown',
            'email' => 'michael@example.com',
            'phone' => '(813) 555-9876',
            'zip' => '33601',
            'coverages' => ['life'],
            'modular_data' => [
                'lf_age' => '30 to 39',
                'lf_amt' => '$500,000 to $1 million',
                'lf_type' => '20-year term',
                'lf_tob' => 'No',
            ],
        ];

        $response = $this->postJson(route('quotes.store'), $payload);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('quotes', [
            'name' => 'Michael Brown',
            'email' => 'michael@example.com',
            'type' => 'life',
            'type_label' => 'Life Insurance',
            'zip_code' => '33601',
        ]);

        $quote = Quote::where('email', 'michael@example.com')->first();
        $this->assertNotNull($quote);
        $this->assertEquals(['life'], $quote->coverages);
        $this->assertEquals('20-year term', $quote->modular_data['lf_type']);
    }

    /**
     * Test that Admin dashboard delivers the quote flow records with structured data to frontend.
     */
    public function test_admin_dashboard_delivers_quote_flow_data(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'is_super_admin' => true,
        ]);

        Quote::create([
            'quote_ref' => 'Q-88221',
            'name' => 'Sarah Connor',
            'first_name' => 'Sarah',
            'last_name' => 'Connor',
            'business_name' => 'Cyberdyne Systems',
            'email' => 'sarah@cyberdyne.com',
            'phone' => '(813) 555-0001',
            'type' => 'bop',
            'type_label' => 'Business Owner Policy',
            'coverages' => ['bop'],
            'business_type' => 'Office or professional services',
            'tags' => ['COV-BOP', 'SOURCE-QUOTE-FLOW'],
            'coverage' => '$1,000,000 Standard Tier',
            'status' => 'new',
            'zip_code' => '33602',
            'location' => 'ZIP: 33602',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('sarah@cyberdyne.com', false);
        $response->assertSee('Cyberdyne Systems', false);
        $response->assertSee('Q-88221', false);
    }
}
