<?php

namespace Tests\Feature;

use App\Models\PageContent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactInfoManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function createAdmin(): User
    {
        return User::factory()->create([
            'role' => 'admin',
            'is_super_admin' => true,
        ]);
    }

    public function test_admin_dashboard_renders_contact_info_tab_and_sidebar_link(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('data-tab="contact-info"', false);
        $response->assertSee('id="tab-contact-info"', false);
        $response->assertSee('Website Contact Information &amp; Hotlines', false);
    }

    public function test_admin_can_update_website_contact_info_via_ajax(): void
    {
        $admin = $this->createAdmin();

        $payload = [
            'primary_phone' => '+1 800-789-0123',
            'primary_phone_label' => 'Direct Advisory Line',
            'primary_hours' => 'Mon–Sat: 7:00 AM – 9:00 PM EST',
            'support_email' => 'clientcare@surebound.com',
            'billing_email' => 'payments@surebound.com',
            'claims_email' => 'newclaims@surebound.com',
            'whatsapp_phone' => '+1 800-789-0123',
            'live_chat_status' => 'Advisors Online & Available',
            'claims_phone' => '+1 888-999-HELP',
            'claims_phone_badge' => '24/7/365 Emergency Dispatch',
            'claims_subtitle' => 'Zero wait emergency claims routing',
            'commercial_phone' => '+1 800-789-COMM',
            'commercial_hours' => 'Mon–Fri: 8:00 AM – 6:00 PM EST',
            'commercial_email' => 'commercial@surebound.com',
            'client_care_phone' => '+1 800-789-CARE',
            'client_care_hours' => 'Mon–Fri: 8:00 AM – 8:00 PM EST',
            'roadside_phone' => '1-800-999-TOWS',
            'cyber_phone' => '1-888-CYBER-911',
            'hq_title' => 'Tampa Global HQ',
            'hq_address' => '400 N Ashley Dr, Suite 1900, Tampa, FL 33602',
            'hq_city' => 'Tampa',
            'hq_state' => 'FL',
            'hq_zip' => '33602',
            'hq_phone' => '+1 800-789-0123',
            'hq_hours' => 'Mon–Fri: 8:00 AM – 5:00 PM EST',
            'branch_title' => 'Austin Regional Hub',
            'branch_address' => '500 Congress Ave, Austin, TX 78701',
            'branch_city' => 'Austin',
            'branch_state' => 'TX',
            'branch_zip' => '78701',
            'branch_phone' => '(512) 555-9988',
            'branch_email' => 'austin@surebound.com',
            'branch_hours' => 'Mon–Fri: 8:30 AM – 5:30 PM CST',
            'map_link' => 'https://maps.google.com/?q=Tampa+FL',
            'underwriter_name' => 'Sarah Jenkins, CPCU',
            'underwriter_title' => 'Executive Underwriting Lead',
            'underwriter_phone' => '(512) 555-8844',
            'underwriter_email' => 's.jenkins@surebound.com',
            'underwriter_hours' => 'Mon – Fri • 8:00 AM – 6:00 PM CST',
        ];

        $response = $this->actingAs($admin)->postJson(route('admin.contact-info.update'), $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertEquals('+1 800-789-0123', PageContent::where('page', 'contact_info')->where('key', 'primary_phone')->value('value'));
        $this->assertEquals('clientcare@surebound.com', PageContent::where('page', 'contact_info')->where('key', 'support_email')->value('value'));
        $this->assertEquals('+1 888-999-HELP', PageContent::where('page', 'contact_info')->where('key', 'claims_phone')->value('value'));
        $this->assertEquals('400 N Ashley Dr, Suite 1900, Tampa, FL 33602', PageContent::where('page', 'contact_info')->where('key', 'hq_address')->value('value'));

        // Verify synced contact page and support page
        $this->assertEquals('+1 800-789-0123', PageContent::where('page', 'contact')->where('key', 'primary_phone')->value('value'));
        $this->assertEquals('+1 888-999-HELP', PageContent::where('page', 'support')->where('key', 'emergency_phone')->value('value'));
    }

    public function test_updated_contact_info_is_reflected_on_public_pages(): void
    {
        $admin = $this->createAdmin();

        $this->actingAs($admin)->post(route('admin.contact-info.update'), [
            'primary_phone' => '+1 813-999-8877',
            'primary_phone_label' => 'Toll-Free',
            'primary_hours' => 'Mon–Fri 8am–8pm',
            'support_email' => 'custom.support@surebound.com',
            'billing_email' => 'custom.billing@surebound.com',
            'claims_email' => 'custom.claims@surebound.com',
            'whatsapp_phone' => '+1 813-999-8877',
            'live_chat_status' => 'Open',
            'claims_phone' => '+1 813-999-8877',
            'claims_phone_badge' => '24/7',
            'claims_subtitle' => 'Immediate response',
            'commercial_phone' => '+1 813-999-8877',
            'commercial_hours' => 'Mon–Fri',
            'commercial_email' => 'custom.commercial@surebound.com',
            'client_care_phone' => '+1 813-999-8877',
            'client_care_hours' => 'Mon–Fri',
            'roadside_phone' => '1-800-555-TOWS',
            'cyber_phone' => '1-888-CYBER',
            'hq_title' => 'Tampa Flagship',
            'hq_address' => '777 Channelside Dr, Tampa, FL 33602',
            'hq_city' => 'Tampa',
            'hq_state' => 'FL',
            'hq_zip' => '33602',
            'hq_phone' => '+1 813-999-8877',
            'hq_hours' => 'Mon–Fri',
            'branch_title' => 'Branch',
            'branch_address' => 'Branch address',
            'branch_city' => 'Dhaka',
            'branch_state' => 'Dhaka',
            'branch_zip' => '1212',
            'branch_phone' => '+880 9612 0000',
            'branch_email' => 'branch@surebound.com',
            'branch_hours' => 'Sun–Thu',
            'map_link' => 'https://maps.google.com',
            'underwriter_name' => 'Marcus Vance, CPCU',
            'underwriter_title' => 'Advisor',
            'underwriter_phone' => '(512) 555-0182',
            'underwriter_email' => 'm.vance@surebound.com',
            'underwriter_hours' => 'Mon–Fri',
        ]);

        // Public home page footer & CTA reflection
        $homeResponse = $this->get(route('home'));
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('+1 813-999-8877');
        $homeResponse->assertSee('custom.support@surebound.com');
        $homeResponse->assertSee('777 Channelside Dr, Tampa, FL 33602');

        // Public contact page reflection
        $contactResponse = $this->get(route('contact'));
        $contactResponse->assertStatus(200);
        $contactResponse->assertSee('+1 813-999-8877');
        $contactResponse->assertSee('777 Channelside Dr, Tampa, FL 33602');

        // Privacy page reflection
        $privacyResponse = $this->get(route('privacy'));
        $privacyResponse->assertStatus(200);
        $privacyResponse->assertSee('+1 813-999-8877');
        $privacyResponse->assertSee('custom.support@surebound.com');
    }

    public function test_non_admin_cannot_update_contact_info(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $response = $this->actingAs($user)->post(route('admin.contact-info.update'), [
            'primary_phone' => '+1 999-999-9999',
            'support_email' => 'hacker@example.com',
            'claims_phone' => '+1 999-999-9999',
            'hq_title' => 'Hacked',
            'hq_address' => 'Unknown',
            'underwriter_name' => 'Fake',
        ]);

        // Regular user should be forbidden (403 or redirect)
        $this->assertTrue(in_array($response->status(), [403, 302]));
    }
}
