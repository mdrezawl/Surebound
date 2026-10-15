<?php

namespace Tests\Feature;

use App\Models\Policy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PolicyManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function createAdmin(): User
    {
        return User::factory()->create([
            'name' => 'Admin Underwriter',
            'email' => 'admin@surebound.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_super_admin' => true,
        ]);
    }

    protected function createCustomer(): User
    {
        return User::factory()->create([
            'name' => 'John Policyholder',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
    }

    public function test_user_can_view_policies_page_with_data_and_kpis(): void
    {
        $customer = $this->createCustomer();

        Policy::create([
            'user_id' => $customer->id,
            'policy_number' => 'SB-HOM-990011',
            'holder_name' => $customer->name,
            'holder_email' => $customer->email,
            'type' => 'home',
            'type_label' => 'Homeowners Comprehensive (HO-5)',
            'carrier' => 'Surebound Syndicate',
            'insured_item' => '123 Ocean Drive, Miami, FL',
            'coverage_limit' => '$1,200,000',
            'deductible' => '$1,000',
            'annual_premium' => '$2,400.00',
            'billing_frequency' => 'annual',
            'effective_date' => '2026-01-01',
            'renewal_date' => '2027-01-01',
            'status' => 'active',
            'coverage_details' => ['Dwelling' => '$1,200,000'],
        ]);

        $response = $this->actingAs($customer)->get(route('user.policies'));

        $response->assertStatus(200);
        $response->assertSee('SB-HOM-990011');
        $response->assertSee('Homeowners Comprehensive (HO-5)');
        $response->assertSee('$1,200,000');
        $response->assertSee('Surebound Syndicate');
    }

    public function test_user_can_view_digital_id_card(): void
    {
        $customer = $this->createCustomer();

        $policy = Policy::create([
            'user_id' => $customer->id,
            'policy_number' => 'SB-AUT-881122',
            'holder_name' => $customer->name,
            'holder_email' => $customer->email,
            'type' => 'auto',
            'type_label' => 'Executive Auto Protection',
            'carrier' => 'Progressive Syndicate',
            'insured_item' => '2024 Tesla Model S',
            'coverage_limit' => '$500,000 CSL',
            'deductible' => '$500',
            'annual_premium' => '$1,800.00',
            'billing_frequency' => 'semi-annual',
            'effective_date' => '2026-02-01',
            'renewal_date' => '2027-02-01',
            'status' => 'active',
        ]);

        $response = $this->actingAs($customer)->get(route('user.policies.id-card', $policy->id));

        $response->assertStatus(200);
        $response->assertSee('SB-AUT-881122');
        $response->assertSee('2024 Tesla Model S');
        $response->assertSee('Official Insurance Card');
    }

    public function test_admin_can_create_and_bind_new_policy(): void
    {
        $admin = $this->createAdmin();
        $customer = $this->createCustomer();

        $response = $this->actingAs($admin)->postJson(route('admin.policies.store'), [
            'holder_name' => 'Sarah Connor',
            'holder_email' => 'sarah@example.com',
            'holder_phone' => '(512) 555-9012',
            'user_id' => $customer->id,
            'type' => 'business',
            'type_label' => 'Commercial Business Owners Policy (BOP)',
            'policy_number' => 'SB-BUS-554433',
            'carrier' => 'The Hartford & Surebound',
            'insured_item' => 'Tech Center Suite 500, Austin, TX',
            'coverage_limit' => '$2,500,000',
            'deductible' => '$2,500',
            'annual_premium' => '$4,200.00',
            'billing_frequency' => 'quarterly',
            'effective_date' => '2026-03-01',
            'renewal_date' => '2027-03-01',
            'status' => 'active',
            'notes' => 'Inspected and certified clean risk.',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('policies', [
            'policy_number' => 'SB-BUS-554433',
            'holder_name' => 'Sarah Connor',
            'type' => 'business',
            'coverage_limit' => '$2,500,000',
            'status' => 'active',
        ]);
    }

    public function test_admin_can_retrieve_policy_json(): void
    {
        $admin = $this->createAdmin();

        $policy = Policy::create([
            'policy_number' => 'SB-UMB-332211',
            'holder_name' => 'Marcus Aurelius',
            'holder_email' => 'marcus@rome.com',
            'type' => 'umbrella',
            'type_label' => 'Excess Umbrella Liability',
            'carrier' => 'Chubb Premier',
            'insured_item' => 'Worldwide Excess Liability',
            'coverage_limit' => '$5,000,000',
            'deductible' => '$0 SIR',
            'annual_premium' => '$1,100.00',
            'billing_frequency' => 'annual',
            'status' => 'active',
        ]);

        $response = $this->actingAs($admin)->getJson(route('admin.policies.show', $policy->id));

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'policy' => [
                'id' => $policy->id,
                'policy_number' => 'SB-UMB-332211',
                'holder_name' => 'Marcus Aurelius',
            ],
        ]);
    }

    public function test_admin_can_update_existing_policy(): void
    {
        $admin = $this->createAdmin();

        $policy = Policy::create([
            'policy_number' => 'SB-AUT-112233',
            'holder_name' => 'Initial Holder',
            'holder_email' => 'holder@example.com',
            'type' => 'auto',
            'type_label' => 'Standard Auto',
            'carrier' => 'Surebound Syndicate',
            'coverage_limit' => '$300,000',
            'annual_premium' => '$1,200.00',
            'status' => 'active',
        ]);

        $response = $this->actingAs($admin)->putJson(route('admin.policies.update', $policy->id), [
            'holder_name' => 'Updated Holder Name',
            'holder_email' => 'updated@example.com',
            'type' => 'auto',
            'type_label' => 'Executive Auto High-Limit',
            'policy_number' => 'SB-AUT-112233',
            'carrier' => 'Travelers Elite',
            'insured_item' => '2025 Porsche Taycan Turbo',
            'coverage_limit' => '$1,000,000 CSL',
            'deductible' => '$250 Comp / $500 Coll',
            'annual_premium' => '$2,500.00',
            'billing_frequency' => 'annual',
            'status' => 'active',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('policies', [
            'id' => $policy->id,
            'holder_name' => 'Updated Holder Name',
            'coverage_limit' => '$1,000,000 CSL',
            'carrier' => 'Travelers Elite',
        ]);
    }

    public function test_admin_can_update_policy_status(): void
    {
        $admin = $this->createAdmin();

        $policy = Policy::create([
            'policy_number' => 'SB-HOM-776655',
            'holder_name' => 'Jane Doe',
            'type' => 'home',
            'coverage_limit' => '$800,000',
            'annual_premium' => '$1,900.00',
            'status' => 'active',
        ]);

        $response = $this->actingAs($admin)->patchJson(route('admin.policies.status', $policy->id), [
            'status' => 'cancelled',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'status' => 'cancelled',
        ]);

        $this->assertDatabaseHas('policies', [
            'id' => $policy->id,
            'status' => 'cancelled',
        ]);
    }

    public function test_admin_can_delete_policy(): void
    {
        $admin = $this->createAdmin();

        $policy = Policy::create([
            'policy_number' => 'SB-HOM-DEL-001',
            'holder_name' => 'To Be Deleted',
            'type' => 'home',
            'coverage_limit' => '$500,000',
            'annual_premium' => '$1,000.00',
            'status' => 'pending',
        ]);

        $response = $this->actingAs($admin)->deleteJson(route('admin.policies.delete', $policy->id));

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseMissing('policies', [
            'id' => $policy->id,
        ]);
    }

    public function test_non_admin_cannot_manage_policies(): void
    {
        $customer = $this->createCustomer();

        $response = $this->actingAs($customer)->postJson(route('admin.policies.store'), [
            'holder_name' => 'Hacker Attempt',
            'type' => 'home',
            'coverage_limit' => '$1,000,000',
            'annual_premium' => '$1,000.00',
            'status' => 'active',
        ]);

        $response->assertStatus(403);
    }
}
