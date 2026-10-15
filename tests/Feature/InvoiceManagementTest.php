<?php

namespace Tests\Feature;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class InvoiceManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function createAdmin(): User
    {
        return User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@surebound.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_super_admin' => true,
        ]);
    }

    public function test_admin_can_store_invoice_with_manual_policy_number_and_itemized_lines(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->postJson(route('admin.invoices.store'), [
            'customer_name' => 'Alex Johnson',
            'customer_email' => 'alex@gmail.com',
            'customer_phone' => '01771600778',
            'customer_address' => 'Dhaka, Bangladesh',
            'policy_number' => 'SB-POL-MANUAL-778',
            'issue_date' => '2026-10-14',
            'due_date' => '2026-11-13',
            'item_desc' => ['General Liability Endorsement', 'Cyber Risk Floater'],
            'item_qty' => [1, 2],
            'item_price' => [500.00, 250.00],
            'subtotal' => 1000.00,
            'tax' => 50.00,
            'discount' => 100.00,
            'total_amount' => 950.00,
            'notes' => 'Remit within 30 days',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('invoices', [
            'customer_name' => 'Alex Johnson',
            'customer_email' => 'alex@gmail.com',
            'policy_number' => 'SB-POL-MANUAL-778',
            'total_amount' => 950.00,
            'status' => 'pending',
        ]);
    }

    public function test_admin_can_render_printable_and_pdf_invoice_view(): void
    {
        $admin = $this->createAdmin();

        $invoice = Invoice::create([
            'invoice_number' => 'INV-2026-999',
            'policy_number' => 'SB-POL-MANUAL-778',
            'customer_name' => 'Alex Johnson',
            'customer_email' => 'alex@gmail.com',
            'customer_phone' => '01771600778',
            'customer_address' => 'Dhaka, Bangladesh',
            'subtotal' => 1000.00,
            'tax' => 50.00,
            'discount' => 100.00,
            'total_amount' => 950.00,
            'status' => 'pending',
            'issue_date' => '2026-10-14',
            'due_date' => '2026-11-13',
            'line_items' => [
                ['desc' => 'General Liability Endorsement', 'qty' => 1, 'price' => 500.00, 'total' => 500.00],
                ['desc' => 'Cyber Risk Floater', 'qty' => 2, 'price' => 250.00, 'total' => 500.00],
            ],
            'notes' => 'Official Underwriting Notice',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.invoices.pdf', $invoice->id).'?download=1');

        $response->assertStatus(200);
        $response->assertSee('INV-2026-999');
        $response->assertSee('Alex Johnson');
        $response->assertSee('SB-POL-MANUAL-778');
        $response->assertSee('General Liability Endorsement');
        $response->assertSee('Surebound Insurance Agency LLC');
        $response->assertSee('triggerPdfDownload');
    }

    public function test_admin_can_process_live_payment_for_invoice(): void
    {
        $admin = $this->createAdmin();

        $invoice = Invoice::create([
            'invoice_number' => 'INV-2026-888',
            'customer_name' => 'Sara Connor',
            'customer_email' => 'sara@example.com',
            'subtotal' => 1200.00,
            'total_amount' => 1200.00,
            'status' => 'pending',
            'issue_date' => '2026-10-14',
            'due_date' => '2026-11-13',
        ]);

        $response = $this->actingAs($admin)->postJson("/admin/invoices/{$invoice->id}/pay", [
            'payment_method' => 'ACH Direct Debit (US Bank)',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $invoice->refresh();
        $this->assertEquals('paid', $invoice->status);
        $this->assertEquals('ACH Direct Debit (US Bank)', $invoice->payment_method);
        $this->assertNotNull($invoice->paid_at);
    }

    public function test_admin_can_save_agency_master_signature(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->postJson(route('admin.invoices.agency-signature'), [
            'signatory_name' => 'Md Rezawl',
            'signatory_title' => 'Chief Underwriting Officer',
            'signature_image' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('api_settings', [
            'key' => 'agency_signature',
        ]);
    }

    public function test_admin_can_store_invoice_with_signature_and_save_as_default(): void
    {
        $admin = $this->createAdmin();

        $sigData = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==';

        $response = $this->actingAs($admin)->postJson(route('admin.invoices.store'), [
            'customer_name' => 'Premium Client Corp',
            'customer_email' => 'client@premium.com',
            'issue_date' => '2026-10-14',
            'due_date' => '2026-11-14',
            'subtotal' => 1500.00,
            'total_amount' => 1500.00,
            'signatory_name' => 'Md Rezawl',
            'signatory_title' => 'Managing Director & Authorized Representative',
            'signature_image' => $sigData,
            'save_as_agency_default' => 1,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('invoices', [
            'customer_name' => 'Premium Client Corp',
            'signatory_name' => 'Md Rezawl',
            'total_amount' => 1500.00,
        ]);

        $this->assertDatabaseHas('api_settings', [
            'key' => 'agency_signature',
        ]);
    }
}
