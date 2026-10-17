<?php

namespace Tests\Feature;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
