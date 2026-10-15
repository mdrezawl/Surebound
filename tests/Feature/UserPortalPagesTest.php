<?php

namespace Tests\Feature;

use App\Models\Invoice;
use App\Models\Policy;
use App\Models\Quote;
use App\Models\SupportTicket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserPortalPagesTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'role' => 'user',
        ]);

        $this->admin = User::factory()->create([
            'name' => 'Admin Underwriter',
            'email' => 'admin@surebound.com',
            'role' => 'admin',
        ]);
    }

    public function test_user_can_access_quotes_page_with_data(): void
    {
        $quote = Quote::create([
            'quote_ref' => 'SB-Q-TEST1',
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'type' => 'business',
            'type_label' => 'Cyber Security',
            'coverage' => '$1,000,000',
            'premium' => '$1,200.00 / yr',
            'status' => 'quoted',
        ]);

        $response = $this->actingAs($this->user)->get('/dashboard/quote');

        $response->assertStatus(200);
        $response->assertSee('Insurance Rate Proposals');
        $response->assertSee('SB-Q-TEST1');
        $response->assertSee('Cyber Security');
    }

    public function test_user_can_accept_quote_and_bind_policy(): void
    {
        $quote = Quote::create([
            'quote_ref' => 'SB-Q-BIND1',
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'type' => 'home',
            'type_label' => 'Homeowners Elite',
            'coverage' => '$750,000 Dwelling',
            'premium' => '$1,450.00 / yr',
            'status' => 'quoted',
        ]);

        $response = $this->actingAs($this->user)->postJson('/dashboard/quote/'.$quote->id.'/accept');

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('quotes', [
            'id' => $quote->id,
            'status' => 'converted',
        ]);

        $this->assertDatabaseHas('policies', [
            'holder_email' => 'john@example.com',
            'type' => 'home',
            'status' => 'active',
        ]);

        $this->assertDatabaseHas('invoices', [
            'customer_email' => 'john@example.com',
            'total_amount' => 1450.00,
            'status' => 'pending',
        ]);
    }

    public function test_user_can_access_claims_page_and_file_claim(): void
    {
        $policy = Policy::create([
            'policy_number' => 'SB-HOM-999111',
            'user_id' => $this->user->id,
            'holder_name' => 'John Doe',
            'holder_email' => 'john@example.com',
            'type' => 'home',
            'plan_name' => 'Premier Home Protection',
            'coverage_limit' => '$500,000',
            'deductible' => '$1,000',
            'annual_premium' => '$1,200',
            'effective_date' => now()->toDateString(),
            'renewal_date' => now()->addYear()->toDateString(),
            'status' => 'active',
        ]);

        $response = $this->actingAs($this->user)->get('/dashboard/claims');

        $response->assertStatus(200);
        $response->assertSee('Claims Center &amp; FNOL Intake', false);

        $claimResponse = $this->actingAs($this->user)->post('/dashboard/claims', [
            'policy_number' => $policy->policy_number,
            'incident_type' => 'Water Damage',
            'incident_date' => now()->toDateString(),
            'incident_location' => '123 Main St, Austin, TX',
            'incident_description' => 'Pipe ruptured in basement causing localized flooring water damage.',
            'estimated_loss' => '$6,500.00',
            'priority' => 'urgent',
        ]);

        $claimResponse->assertSessionHas('success');
        $this->assertDatabaseHas('claims', [
            'policy_number' => 'SB-HOM-999111',
            'incident_type' => 'Water Damage',
            'estimated_loss' => '$6,500.00',
            'status' => 'submitted',
        ]);
    }

    public function test_user_can_access_documents_locker_and_view_coi(): void
    {
        $policy = Policy::create([
            'policy_number' => 'SB-BUS-888222',
            'user_id' => $this->user->id,
            'holder_name' => 'John Doe',
            'holder_email' => 'john@example.com',
            'type' => 'business',
            'plan_name' => 'Commercial General Liability',
            'coverage_limit' => '$2,000,000',
            'deductible' => '$2,500',
            'annual_premium' => '$2,400',
            'effective_date' => now()->toDateString(),
            'renewal_date' => now()->addYear()->toDateString(),
            'status' => 'active',
        ]);

        $response = $this->actingAs($this->user)->get('/dashboard/documents');

        $response->assertStatus(200);
        $response->assertSee('Digital Insurance Document Locker');
        $response->assertSee('SB-BUS-888222');
        $response->assertSee('Declarations Page (DEC)');
        $response->assertSee('Certificate of Insurance (COI)');

        $coiResponse = $this->actingAs($this->user)->get('/dashboard/documents/certificate/'.$policy->id);
        $coiResponse->assertStatus(200);
        $coiResponse->assertSee('CERTIFICATE OF LIABILITY INSURANCE');
        $coiResponse->assertSee('SB-BUS-888222');
    }

    public function test_user_can_request_custom_coi(): void
    {
        $policy = Policy::create([
            'policy_number' => 'SB-BUS-777333',
            'user_id' => $this->user->id,
            'holder_name' => 'John Doe',
            'holder_email' => 'john@example.com',
            'type' => 'business',
            'plan_name' => 'Commercial Liability',
            'coverage_limit' => '$1,000,000',
            'deductible' => '$1,000',
            'annual_premium' => '$1,500',
            'effective_date' => now()->toDateString(),
            'renewal_date' => now()->addYear()->toDateString(),
            'status' => 'active',
        ]);

        $response = $this->actingAs($this->user)->post('/dashboard/documents/certificate', [
            'policy_number' => $policy->policy_number,
            'holder_name' => 'Apex Landlord LLC',
            'holder_address' => '500 5th Ave, New York, NY',
            'holder_email' => 'management@apex.com',
            'notes' => 'Please add waiver of subrogation',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('support_tickets', [
            'category' => 'certificate',
            'policy_number' => 'SB-BUS-777333',
            'status' => 'in_progress',
        ]);
    }

    public function test_user_can_access_payments_page_and_pay_invoice(): void
    {
        $invoice = Invoice::create([
            'invoice_number' => 'INV-2026-TEST99',
            'policy_number' => 'SB-HOM-999111',
            'customer_name' => 'John Doe',
            'customer_email' => 'john@example.com',
            'subtotal' => 1200.00,
            'total_amount' => 1200.00,
            'status' => 'pending',
            'issue_date' => now(),
            'due_date' => now()->addDays(15),
        ]);

        $response = $this->actingAs($this->user)->get('/dashboard/payments');

        $response->assertStatus(200);
        $response->assertSee('Premium Billing &amp; Payment Gateway', false);
        $response->assertSee('INV-2026-TEST99');
        $response->assertSee('1,200.00');

        $payResponse = $this->actingAs($this->user)->post('/dashboard/invoices/'.$invoice->id.'/pay', [
            'payment_method' => 'Visa ending in 4242',
        ]);

        $payResponse->assertSessionHas('success');
        $this->assertDatabaseHas('invoices', [
            'id' => $invoice->id,
            'status' => 'paid',
            'payment_method' => 'Visa ending in 4242',
        ]);
    }

    public function test_user_can_access_support_page_and_create_ticket(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard/support');

        $response->assertStatus(200);
        $response->assertSee('Underwriting Concierge &amp; Priority Support', false);

        $ticketResponse = $this->actingAs($this->user)->post('/dashboard/support/ticket', [
            'category' => 'policy_change',
            'policy_number' => 'SB-HOM-999111',
            'subject' => 'Add alarm monitoring endorsement',
            'priority' => 'normal',
            'message' => 'Please add central station burglary alarm discount to my policy.',
        ]);

        $ticketResponse->assertSessionHas('success');
        $this->assertDatabaseHas('support_tickets', [
            'category' => 'policy_change',
            'subject' => 'Add alarm monitoring endorsement',
            'status' => 'open',
        ]);
    }

    public function test_admin_can_update_support_ticket_status_and_notes(): void
    {
        $ticket = SupportTicket::create([
            'ticket_number' => 'TCK-2026-99999',
            'user_id' => $this->user->id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'category' => 'policy_change',
            'subject' => 'Discount request',
            'message' => 'Installed smart water shutoff.',
            'priority' => 'normal',
            'status' => 'open',
        ]);

        $response = $this->actingAs($this->admin)->patchJson('/admin/support-tickets/'.$ticket->id.'/status', [
            'status' => 'resolved',
            'admin_notes' => '10% Smart home protective device credit applied to policy.',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('support_tickets', [
            'id' => $ticket->id,
            'status' => 'resolved',
            'admin_notes' => '10% Smart home protective device credit applied to policy.',
        ]);

        // When user views their support page, they see the underwriter response notes!
        $userResponse = $this->actingAs($this->user)->get('/dashboard/support');
        $userResponse->assertStatus(200);
        $userResponse->assertSee('10% Smart home protective device credit applied to policy.');
    }

    public function test_admin_can_read_support_ticket_details_via_json_api(): void
    {
        $ticket = SupportTicket::create([
            'ticket_number' => 'TCK-2026-READER1',
            'user_id' => $this->user->id,
            'name' => 'Alice Underwriting',
            'email' => 'alice@example.com',
            'phone' => '+880 1711 000111',
            'policy_number' => 'SB-POL-555888',
            'category' => 'claims_assistance',
            'subject' => 'Water intrusion immediate assessment',
            'message' => 'Pipe burst under second floor bathroom. Need immediate adjuster inspection.',
            'priority' => 'urgent',
            'status' => 'open',
        ]);

        $response = $this->actingAs($this->admin)->getJson('/admin/support-tickets/'.$ticket->id);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'ticket' => [
                'id' => $ticket->id,
                'ticket_number' => 'TCK-2026-READER1',
                'name' => 'Alice Underwriting',
                'email' => 'alice@example.com',
                'phone' => '+880 1711 000111',
                'policy_number' => 'SB-POL-555888',
                'category' => 'claims_assistance',
                'subject' => 'Water intrusion immediate assessment',
                'message' => 'Pipe burst under second floor bathroom. Need immediate adjuster inspection.',
                'priority' => 'urgent',
                'status' => 'open',
            ],
        ]);
    }

    public function test_admin_can_update_support_page_contact_numbers_and_content(): void
    {
        $payload = [
            'support_title' => 'Custom Concierge Desk',
            'support_subtitle' => 'Live underwriter support and emergency triage.',
            'support_phone' => '+880 9612 999888',
            'support_email' => 'custom-concierge@surebound.com',
            'emergency_phone' => '+880 1800 999111',
            'emergency_subtitle' => 'Priority Rapid Response',
            'roadside_phone' => '+880 1800 888222',
            'cyber_phone' => '+880 1800 777333',
            'underwriter_name' => 'Jonathan Vance, CPCU',
            'underwriter_title' => 'Executive Vice President of Underwriting',
            'underwriter_phone' => '+880 9612 000999',
            'underwriter_email' => 'j.vance@surebound.com',
            'underwriter_hours' => 'Mon – Fri: 9:00 AM – 7:00 PM BST',
            'office_address' => 'Floor 18, Crystal Palace, Gulshan-2, Dhaka 1212',
        ];

        $response = $this->actingAs($this->admin)->postJson('/admin/support/content', $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        // Verify the user support page reflects the newly configured numbers, email, and underwriter
        $supportPageResponse = $this->actingAs($this->user)->get('/dashboard/support');
        $supportPageResponse->assertStatus(200);
        $supportPageResponse->assertSee('Custom Concierge Desk');
        $supportPageResponse->assertSee('+880 9612 999888');
        $supportPageResponse->assertSee('custom-concierge@surebound.com');
        $supportPageResponse->assertSee('+880 1800 999111');
        $supportPageResponse->assertSee('+880 1800 888222');
        $supportPageResponse->assertSee('+880 1800 777333');
        $supportPageResponse->assertSee('Jonathan Vance, CPCU');
        $supportPageResponse->assertSee('Executive Vice President of Underwriting');
        $supportPageResponse->assertSee('+880 9612 000999');
        $supportPageResponse->assertSee('j.vance@surebound.com');
        $supportPageResponse->assertSee('Floor 18, Crystal Palace, Gulshan-2, Dhaka 1212');

        // Verify user dashboard reflects the updated support phone
        $dashboardResponse = $this->actingAs($this->user)->get('/dashboard');
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee('+880 9612 999888');
    }

    public function test_user_can_access_settings_page_with_data(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard/settings');

        $response->assertStatus(200);
        $response->assertSee('Account &amp; Policyholder Profile Settings', false);
        $response->assertSee('Policyholder Identity &amp; Contact', false);
        $response->assertSee($this->user->name);
        $response->assertSee($this->user->email);
    }

    public function test_user_can_update_profile_information(): void
    {
        $response = $this->actingAs($this->user)->post('/dashboard/settings/profile', [
            'name' => 'Johnathan Doe, Esq.',
            'email' => 'john.doe.esq@example.com',
            'phone' => '(512) 555-7890',
            'title' => 'Chief Managing Partner',
            'address' => '800 Congress Ave, Suite 1400',
            'city' => 'Austin',
            'state' => 'TX',
            'zip_code' => '78701',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => 'Johnathan Doe, Esq.',
            'email' => 'john.doe.esq@example.com',
            'city' => 'Austin',
            'state' => 'TX',
            'zip_code' => '78701',
        ]);
    }

    public function test_user_can_update_password(): void
    {
        $response = $this->actingAs($this->user)->post('/dashboard/settings/password', [
            'current_password' => 'password',
            'password' => 'NewSecurePassword123!',
            'password_confirmation' => 'NewSecurePassword123!',
        ]);

        $response->assertSessionHas('success');
        $this->user->refresh();
        $this->assertTrue(Hash::check('NewSecurePassword123!', $this->user->password));
    }

    public function test_user_can_update_notification_preferences_and_paperless_billing(): void
    {
        $response = $this->actingAs($this->user)->post('/dashboard/settings/preferences', [
            'paperless_billing' => '1',
            'policy_renewals_email' => '1',
            'policy_renewals_sms' => '1',
            'claims_updates_email' => '1',
            'claims_updates_sms' => '1',
            'billing_reminders_email' => '1',
            'weather_cat_alerts_sms' => '1',
        ]);

        $response->assertSessionHas('success');
        $this->user->refresh();
        $this->assertTrue($this->user->paperless_billing);
        $this->assertIsArray($this->user->notification_preferences);
        $this->assertTrue($this->user->notification_preferences['weather_cat_alerts_sms']);
    }

    public function test_dashboard_renders_responsive_sidebar_and_toggle_controls(): void
    {
        $response = $this->actingAs($this->user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('sidebar-backdrop', false);
        $response->assertSee('id="sidebarBackdrop"', false);
        $response->assertSee('id="userSidebar"', false);
        $response->assertSee('id="sidebarToggleBtn"', false);
        $response->assertSee('id="sidebarCloseBtn"', false);
        $response->assertSee('images/logo-white.png', false);
        $response->assertSee('sidebar-brand-img', false);
        $response->assertSee('toggleUserSidebar()', false);
        $response->assertSee('closeUserSidebar()', false);
    }
}
