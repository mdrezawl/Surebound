<?php

namespace Tests\Feature;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class InsurancePagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_personal_insurance_pages_render_successfully(): void
    {
        $pages = [
            '/home-insurance' => 'Home Insurance',
            '/auto-insurance' => 'Auto Insurance',
            '/life-insurance' => 'Life Insurance',
            '/health-insurance' => 'Health Insurance',
            '/umbrella-insurance' => 'Umbrella Insurance',
        ];

        foreach ($pages as $url => $expectedText) {
            $response = $this->get($url);
            $response->assertStatus(200);
            $response->assertSeeText($expectedText);
        }
    }

    public function test_navigation_dropdown_contains_all_five_personal_insurance_links(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee(route('home-insurance'));
        $response->assertSee(route('auto-insurance'));
        $response->assertSee(route('life-insurance'));
        $response->assertSee(route('health-insurance'));
        $response->assertSee(route('umbrella-insurance'));
    }

    public function test_admin_can_update_life_insurance_cms_content(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->postJson(route('admin.life-insurance.update'), [
            'hero_eyebrow' => 'CUSTOM LIFE EYEBROW',
            'hero_title' => 'Custom Life Title For Family',
            'hero_subtitle' => 'Custom subtitle description for life coverage.',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $publicResponse = $this->get(route('life-insurance'));
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('CUSTOM LIFE EYEBROW');
        $publicResponse->assertSee('Custom Life Title For Family');
    }

    public function test_admin_can_update_health_insurance_cms_content(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->postJson(route('admin.health-insurance.update'), [
            'hero_eyebrow' => 'CUSTOM HEALTHCARE SHIELD',
            'hero_title' => 'Affordable Medical and Wellness Plans',
            'hero_subtitle' => 'Comprehensive medical benefits and prescription drug coverage.',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $publicResponse = $this->get(route('health-insurance'));
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('CUSTOM HEALTHCARE SHIELD');
        $publicResponse->assertSee('Affordable Medical and Wellness Plans');
    }

    public function test_admin_can_update_umbrella_insurance_cms_content(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->postJson(route('admin.umbrella-insurance.update'), [
            'hero_eyebrow' => 'CUSTOM UMBRELLA SHIELD',
            'hero_title' => 'Multi-Million Dollar Excess Protection',
            'hero_subtitle' => 'Protecting high-net-worth real estate and retirement funds.',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $publicResponse = $this->get(route('umbrella-insurance'));
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('CUSTOM UMBRELLA SHIELD');
        $publicResponse->assertSee('Multi-Million Dollar Excess Protection');
    }

    public function test_customer_can_quote_commercial_and_separate_health_and_life_policies(): void
    {
        $typesToTest = [
            'workers_comp' => "Workers' Compensation",
            'general_liability' => 'General Liability',
            'commercial_property' => 'Commercial Property Coverage',
            'commercial_auto' => 'Commercial Auto Insurance',
            'surety_bond' => 'Surety Bond',
            'bop' => 'Business Owner Policy (BOP)',
            'health' => 'Health Insurance',
            'life' => 'Life Insurance',
        ];

        foreach ($typesToTest as $type => $expectedLabel) {
            $response = $this->postJson(route('quotes.store'), [
                'name' => 'Acme Corporation',
                'email' => 'contact@acme.com',
                'zip' => '78701',
                'type' => $type,
            ]);

            $response->assertStatus(200);
            $response->assertJson(['success' => true]);

            $this->assertDatabaseHas('quotes', [
                'type' => $type,
                'type_label' => $expectedLabel,
                'email' => 'contact@acme.com',
            ]);
        }
    }

    public function test_public_quote_modal_includes_phone_field_and_saves_phone(): void
    {
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('id="quote-phone"', false);
        $homeResponse->assertSee('type="tel"', false);

        $response = $this->postJson(route('quotes.store'), [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '(555) 234-5678',
            'zip' => '90210',
            'type' => 'auto',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('quotes', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '(555) 234-5678',
            'zip_code' => '90210',
            'type' => 'auto',
        ]);
    }

    public function test_homepage_talk_to_an_expert_links_directly_to_phone_call(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('href="tel:+18132141731"', false);
        $response->assertSee('+1 813-214-1731', false);
        $response->assertSee('Talk to an Expert', false);
        $response->assertDontSee('href="#contact"', false);
    }

    public function test_authenticated_user_can_submit_quote_request_from_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $response = $this->actingAs($user)->post(route('user.quotes.store'), [
            'type' => 'workers_comp',
            'type_label' => "Workers' Compensation Insurance",
            'coverage' => '$1,000,000 Comprehensive Limit',
            'location' => 'Austin, TX 78701',
            'notes' => '50 full-time employees, manufacturing facility.',
        ]);

        $response->assertRedirect(route('user.quote'));
        $this->assertDatabaseHas('quotes', [
            'type' => 'workers_comp',
            'email' => $user->email,
            'type_label' => "Workers' Compensation Insurance",
        ]);
    }

    public function test_commercial_auto_insurance_page_renders_successfully(): void
    {
        $response = $this->get(route('commercial-auto-insurance'));
        $response->assertStatus(200);
        $response->assertSeeText('Commercial Auto');
        $response->assertSee('Calculate Your Commercial Auto Quote');
        $response->assertSee('commercialAutoQuoteForm');
        $response->assertSee('Up to $5M Combined Single Limit');
        $response->assertSee('Hired & Non-Owned Auto (HNOA)');
    }

    public function test_commercial_dropdown_contains_commercial_auto_insurance_link(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee(route('commercial-auto-insurance'));
    }

    public function test_admin_can_update_commercial_auto_insurance_cms_content(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->postJson(route('admin.commercial-auto-insurance.update'), [
            'hero_eyebrow' => 'CUSTOM COMMERCIAL FLEET GUARD',
            'hero_title' => 'Custom Fleet Protection Across All 50 States',
            'hero_subtitle' => 'High-capacity commercial vehicle policies tailored to your routes.',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $publicResponse = $this->get(route('commercial-auto-insurance'));
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('CUSTOM COMMERCIAL FLEET GUARD');
        $publicResponse->assertSee('Custom Fleet Protection Across All 50 States');
    }

    public function test_public_user_can_submit_commercial_auto_quote_request_from_page(): void
    {
        $response = $this->postJson(route('quotes.store'), [
            'type' => 'commercial_auto',
            'company_name' => 'Metro Delivery Express LLC',
            'name' => 'David Martinez',
            'email' => 'david@metrodelivery.com',
            'phone' => '555-432-8765',
            'zip' => '75001',
            'fleet_size' => '6-15 Vehicles',
            'vehicle_type' => 'Cargo Vans / Sprinters',
            'coverage_tier' => 'Preferred Fleet Guard ($2M CSL + Cargo Protection)',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('quotes', [
            'type' => 'commercial_auto',
            'email' => 'david@metrodelivery.com',
            'name' => 'David Martinez',
            'type_label' => 'Commercial Auto Insurance',
            'coverage' => 'Preferred Fleet Guard ($2M CSL + Cargo Protection)',
            'zip_code' => '75001',
        ]);
    }

    public function test_surety_bond_page_renders_successfully(): void
    {
        $response = $this->get(route('surety-bond'));

        $response->assertStatus(200);
        $response->assertSee('COMMERCIAL SURETY');
        $response->assertSee('Calculate Your Surety Bond Quote');
        $response->assertSee('Treasury-Listed');
        $response->assertSee('Contract &amp; Performance Bonds', false);
        $response->assertSee('Freight Broker BMC-84');
        $response->assertSee('Frequently Asked Questions About Surety Bonds');
    }

    public function test_commercial_dropdown_contains_surety_bond_link(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee(route('surety-bond'));
        $response->assertSee('Surety Bond');
    }

    public function test_admin_can_update_surety_bond_cms_content(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->postJson(route('admin.surety-bond.update'), [
            'hero_eyebrow' => 'CUSTOM TREASURY SURETY LINE',
            'hero_title' => 'Nationwide Bonding Capacity &amp; Guarantees',
            'hero_subtitle' => 'High-capacity performance lines backed by Top-Tier Treasury underwriters.',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $publicResponse = $this->get(route('surety-bond'));
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('CUSTOM TREASURY SURETY LINE');
        $publicResponse->assertSee('Nationwide Bonding Capacity &amp; Guarantees', false);
    }

    public function test_public_user_can_submit_surety_bond_quote_request_from_page(): void
    {
        $response = $this->postJson(route('quotes.store'), [
            'type' => 'surety_bond',
            'company_name' => 'Apex General Contracting Corp',
            'name' => 'Robert Sterling',
            'email' => 'robert@apexgeneralcontracting.com',
            'phone' => '555-987-6543',
            'zip' => '75001',
            'bond_type' => 'Contract & Performance Bond',
            'bond_amount' => '$250,000 - $500,000 Contract Line',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('quotes', [
            'type' => 'surety_bond',
            'email' => 'robert@apexgeneralcontracting.com',
            'name' => 'Robert Sterling',
            'type_label' => 'Surety Bond',
            'zip_code' => '75001',
        ]);

        $quote = Quote::where('email', 'robert@apexgeneralcontracting.com')->first();
        $this->assertNotNull($quote);
        $this->assertStringContainsString('Apex General Contracting Corp', $quote->notes);
        $this->assertStringContainsString('Contract & Performance Bond', $quote->notes);
    }

    public function test_contact_page_renders_successfully_with_phone_number(): void
    {
        $response = $this->get(route('contact'));
        $response->assertStatus(200);
        $response->assertSee('+1 813-214-1731');
        $response->assertSee('tel:+18132141731');
    }

    public function test_admin_can_update_contact_cms_content(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->postJson(route('admin.contact.update'), [
            'hero_eyebrow' => 'CUSTOM CONTACT EYEBROW',
            'hero_title' => 'Speak With A Senior Partner Now',
            'hero_subtitle' => 'Custom subtitle description for direct advisory assistance.',
            'primary_phone' => '+1 813-214-1731',
            'channel_1_title' => 'Executive Client Desk',
            'channel_1_value' => '+1 813-214-1731',
            'hq_title' => 'Tampa Advisory Headquarters',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $publicResponse = $this->get(route('contact'));
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('CUSTOM CONTACT EYEBROW');
        $publicResponse->assertSee('Speak With A Senior Partner Now');
        $publicResponse->assertSee('Executive Client Desk');
        $publicResponse->assertSee('Tampa Advisory Headquarters');
        $publicResponse->assertSee('+1 813-214-1731');
    }

    public function test_privacy_policy_page_renders_successfully(): void
    {
        $response = $this->get(route('privacy'));
        $response->assertStatus(200);
        $response->assertSee('Privacy &amp; Security Policy', false);
        $response->assertSee('Gramm-Leach-Bliley Act');
        $response->assertSee('+1 813-214-1731');
    }

    public function test_terms_of_service_page_renders_successfully(): void
    {
        $response = $this->get(route('terms'));
        $response->assertStatus(200);
        $response->assertSee('Terms of Service');
        $response->assertSee('Underwriting &amp; Agency Agreement', false);
        $response->assertSee('+1 813-214-1731');
    }

    public function test_footer_contains_all_working_page_urls(): void
    {
        $response = $this->get(route('home'));
        $response->assertStatus(200);

        // Coverage links
        $response->assertSee(route('home-insurance'));
        $response->assertSee(route('auto-insurance'));
        $response->assertSee(route('life-insurance'));
        $response->assertSee(route('health-insurance'));
        $response->assertSee(route('umbrella-insurance'));
        $response->assertSee(route('business-insurance'));
        $response->assertSee(route('commercial-auto-insurance'));
        $response->assertSee(route('surety-bond'));

        // Company links
        $response->assertSee(route('story'));
        $response->assertSee(route('team'));
        $response->assertSee(route('careers'));
        $response->assertSee(route('community'));
        $response->assertSee(route('contact'));

        // Resources links
        $response->assertSee(route('articles'));
        $response->assertSee(route('faqs'));
        $response->assertSee(route('guides'));
        $response->assertSee(route('claims'));
        $response->assertSee(route('compare'));

        // Support & Legal links
        $response->assertSee(route('payment'));
        $response->assertSee(route('login'));
        $response->assertSee(route('register'));
        $response->assertSee(route('admin.dashboard'));
        $response->assertSee(route('privacy'));
        $response->assertSee(route('terms'));
    }

    public function test_homepage_renders_minimal_insurance_partners_section_with_10_approved_carriers(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // Required headings
        $response->assertSee('Coverage Backed by Trusted Names');
        $response->assertSee('We work with leading insurance carriers to help you find the right coverage.');

        // Approved 10 carrier logos/names
        $carriers = [
            'Travelers',
            'Progressive',
            'Liberty Mutual',
            'Nationwide',
            'Chubb',
            'The Hartford',
            'State Farm',
            'Allstate',
            'CNA',
            'Berkshire Hathaway GUARD',
        ];

        foreach ($carriers as $carrier) {
            $response->assertSee($carrier);
        }
    }

    public function test_admin_can_update_insurance_partners_cms_and_toggle_section(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $updateResponse = $this->actingAs($admin)->postJson(route('admin.partners.update'), [
            'section_enabled' => '1',
            'section_title' => 'Custom Headline For Trusted Carriers',
            'section_subtitle' => 'Our custom network of premier underwriters.',
            'partner_1_name' => 'Travelers Elite',
            'partner_1_logo' => 'images/partners/travelers.svg',
            'partner_1_desc' => 'Premier Underwriting',
            'partner_1_active' => '1',
        ]);

        $updateResponse->assertStatus(200);
        $updateResponse->assertJson(['success' => true]);

        $publicResponse = $this->get('/');
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('Custom Headline For Trusted Carriers');
        $publicResponse->assertSee('Our custom network of premier underwriters.');
        $publicResponse->assertSee('Travelers Elite');
    }

    public function test_admin_can_update_insurance_partners_from_home_cms_endpoint(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $updateResponse = $this->actingAs($admin)->postJson(route('admin.home-insurance.update'), [
            'partners_submitted' => '1',
            'section_enabled' => '1',
            'section_title' => 'Directly Updated From Home CMS Tab',
            'section_subtitle' => 'Live network of accredited national carriers.',
            'partner_1_name' => 'Travelers National',
            'partner_1_logo' => 'images/partners/travelers.svg',
            'partner_1_desc' => 'National Commercial Underwriter',
            'partner_1_active' => '1',
        ]);

        $updateResponse->assertStatus(200);
        $updateResponse->assertJson(['success' => true]);

        $publicResponse = $this->get('/');
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('Directly Updated From Home CMS Tab');
        $publicResponse->assertSee('Live network of accredited national carriers.');
        $publicResponse->assertSee('Travelers National');
    }

    public function test_admin_can_upload_partner_logo_from_local_pc(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $fakeLogo = UploadedFile::fake()->image('my_carrier_logo.png', 200, 80);

        $response = $this->actingAs($admin)->post(route('admin.home-insurance.update'), [
            'partners_submitted' => '1',
            'section_enabled' => '1',
            'section_title' => 'Carriers With Local Uploaded Logos',
            'section_subtitle' => 'Custom uploaded brand marks from admin PC.',
            'partners_count' => '1',
            'partner_1_name' => 'Acme Mutual Insurance',
            'partner_1_desc' => 'High Value Property Line',
            'partner_1_active' => '1',
            'partner_1_file' => $fakeLogo,
        ], ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $responseData = $response->json();
        $this->assertNotEmpty($responseData['partners']['partner_1_logo']);
        $this->assertStringContainsString('images/partners/partner_1_', $responseData['partners']['partner_1_logo']);

        // Check public homepage
        $publicResponse = $this->get('/');
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('Acme Mutual Insurance');
        $publicResponse->assertSee($responseData['partners']['partner_1_logo']);

        // Clean up test generated file
        $createdFile = public_path($responseData['partners']['partner_1_logo']);
        if (file_exists($createdFile)) {
            @unlink($createdFile);
        }
        $createdDistFile = public_path('../dist/'.$responseData['partners']['partner_1_logo']);
        if (file_exists($createdDistFile)) {
            @unlink($createdDistFile);
        }
    }

    public function test_admin_can_remove_partner_and_add_new_partner(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        // Submit with partner 1 active, partner 2 removed, and partner 3 added
        $response = $this->actingAs($admin)->post(route('admin.home-insurance.update'), [
            'partners_submitted' => '1',
            'section_enabled' => '1',
            'section_title' => 'Updated Carrier Roster',
            'section_subtitle' => 'Managing removals and new carriers seamlessly.',
            'partners_count' => '3',
            // Partner 1 kept
            'partner_1_name' => 'Travelers Kept',
            'partner_1_logo' => 'images/partners/travelers.svg',
            'partner_1_desc' => 'Property Line',
            'partner_1_active' => '1',
            // Partner 2 removed
            'partner_2_name' => 'Old Dropped Carrier',
            'partner_2_logo' => 'images/partners/dropped.svg',
            'partner_2_removed' => '1',
            // Partner 3 newly added
            'partner_3_name' => 'Fresh Carrier Partner',
            'partner_3_logo' => 'images/partners/fresh.svg',
            'partner_3_desc' => 'Commercial Specialty',
            'partner_3_active' => '1',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $data = $response->json();
        // Count should be 2 because partner 2 was skipped
        $this->assertEquals('2', $data['partners']['partners_count']);
        $this->assertEquals('Travelers Kept', $data['partners']['partner_1_name']);
        $this->assertEquals('Fresh Carrier Partner', $data['partners']['partner_2_name']);

        // Homepage should see Travelers Kept and Fresh Carrier Partner, but NOT Old Dropped Carrier
        $publicResponse = $this->get('/');
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('Travelers Kept');
        $publicResponse->assertSee('Fresh Carrier Partner');
        $publicResponse->assertDontSee('Old Dropped Carrier');
    }

    public function test_homepage_renders_single_quote_as_fixed_card_without_slider(): void
    {
        // By default or with 1 quote, it must render as a static card and NOT render slider controls
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('brand-pull-quote-card');
        $response->assertSee('Marcel Gherkina');
        $response->assertSee('Verified Perspective');
        $response->assertDontSee('quote-slider-wrapper');
        $response->assertDontSee('quote-slider-track');
        $response->assertDontSee('quote-slider-controls');
        $response->assertDontSee('id="quotePrevBtn"', false);
        $response->assertDontSee('id="quoteNextBtn"', false);
    }

    public function test_homepage_renders_slider_carousel_when_multiple_quotes_added(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.home-insurance.update'), [
            'quotes_submitted' => '1',
            'quotes_enabled' => '1',
            'quotes_count' => '2',
            'quote_1_text' => 'First perspective statement regarding our great coverage.',
            'quote_1_author' => 'Alice Johnson',
            'quote_1_role' => 'Senior Vice President',
            'quote_1_badge' => 'Executive Insight',
            'quote_1_active' => '1',
            'quote_2_text' => 'Second perspective statement on customer peace of mind.',
            'quote_2_author' => 'Bob Martinez',
            'quote_2_role' => 'Managing Director',
            'quote_2_badge' => 'Customer Voice',
            'quote_2_active' => '1',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        // Homepage should now activate the interactive slider wrapper and both quotes
        $publicResponse = $this->get('/');
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('quote-slider-wrapper');
        $publicResponse->assertSee('quote-slider-track');
        $publicResponse->assertSee('quote-slider-controls');
        $publicResponse->assertSee('id="quotePrevBtn"', false);
        $publicResponse->assertSee('id="quoteNextBtn"', false);
        $publicResponse->assertSee('Alice Johnson');
        $publicResponse->assertSee('First perspective statement regarding our great coverage.');
        $publicResponse->assertSee('Bob Martinez');
        $publicResponse->assertSee('Second perspective statement on customer peace of mind.');
    }

    public function test_admin_can_update_multiple_quotes_and_remove_quotes_with_sequential_repacking(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        // Submit 3 quotes, but mark quote 2 as removed
        $response = $this->actingAs($admin)->post(route('admin.home-insurance.update'), [
            'quotes_submitted' => '1',
            'quotes_enabled' => '1',
            'quotes_count' => '3',
            'quote_1_text' => 'Keep quote 1 active.',
            'quote_1_author' => 'Author One',
            'quote_1_role' => 'Role One',
            'quote_1_badge' => 'Badge One',
            'quote_1_active' => '1',
            // Quote 2 removed
            'quote_2_text' => 'This quote was deleted by admin.',
            'quote_2_author' => 'Dropped Author',
            'quote_2_removed' => '1',
            // Quote 3 added
            'quote_3_text' => 'Keep quote 3 as newly added.',
            'quote_3_author' => 'Author Three',
            'quote_3_role' => 'Role Three',
            'quote_3_badge' => 'Badge Three',
            'quote_3_active' => '1',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $content = $response->json()['content'];
        $this->assertEquals('2', $content['quotes_count']);
        $this->assertEquals('Keep quote 1 active.', $content['quote_1_text']);
        $this->assertEquals('Keep quote 3 as newly added.', $content['quote_2_text']);
        $this->assertArrayNotHasKey('quote_3_text', $content);

        // Homepage shows Author One and Author Three, but NOT Dropped Author
        $publicResponse = $this->get('/');
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('Author One');
        $publicResponse->assertSee('Author Three');
        $publicResponse->assertDontSee('Dropped Author');
    }

    public function test_brand_quotes_section_can_be_disabled(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.home-insurance.update'), [
            'quotes_submitted' => '1',
            // quotes_enabled omitted / unchecked
            'quotes_count' => '1',
            'quote_1_text' => 'Some text that should not appear when section is disabled.',
            'quote_1_author' => 'Hidden Author',
            'quote_1_active' => '1',
        ], ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $this->assertEquals('0', $response->json()['content']['quotes_enabled']);

        $publicResponse = $this->get('/');
        $publicResponse->assertStatus(200);
        $publicResponse->assertDontSee('pull-quote-section');
        $publicResponse->assertDontSee('Hidden Author');
    }

    public function test_public_quote_submission_records_coverage_amount_and_source_page(): void
    {
        $response = $this->postJson(route('quotes.store'), [
            'name' => 'Alice Commercial',
            'email' => 'alice@enterprise.com',
            'phone' => '(206) 555-0199',
            'zip' => '98101',
            'type' => 'bop',
            'coverage_amount' => '$1,000,000 BOP Commercial Standard',
            'source_page' => '/business-insurance#coverage-options',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('quotes', [
            'name' => 'Alice Commercial',
            'email' => 'alice@enterprise.com',
            'type' => 'bop',
            'coverage' => '$1,000,000 BOP Commercial Standard',
        ]);

        $saved = Quote::where('email', 'alice@enterprise.com')->first();
        $this->assertNotNull($saved);
        $this->assertStringContainsString('Source Page: /business-insurance#coverage-options', $saved->notes);
        $this->assertStringContainsString('Requested Amount/Limit: $1,000,000 BOP Commercial Standard', $saved->notes);
    }

    public function test_public_quote_submission_supports_custom_amount_and_property_lines(): void
    {
        $response = $this->postJson(route('quotes.store'), [
            'name' => 'Bob Real Estate',
            'email' => 'bob@propertyholdings.com',
            'phone' => '(206) 555-0288',
            'zip' => '98104',
            'type' => 'commercial_property',
            'coverage_amount' => 'Custom: $3,500,000 Multi-Building',
            'source_page' => '/property-insurance',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('quotes', [
            'email' => 'bob@propertyholdings.com',
            'type' => 'commercial_property',
            'coverage' => 'Custom: $3,500,000 Multi-Building',
        ]);
    }
}
