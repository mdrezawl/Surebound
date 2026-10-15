<?php

namespace Tests\Feature;

use App\Models\Claim;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ClaimManagementTest extends TestCase
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
            'name' => 'John Claimant',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
    }

    public function test_admin_can_view_claims_center_in_dashboard(): void
    {
        $admin = $this->createAdmin();

        $claim = Claim::create([
            'claim_number' => 'CLM-2026-99001',
            'policy_number' => 'SB-HOM-123456',
            'claimant_name' => 'Jonathan Harris',
            'claimant_email' => 'jonathan@example.com',
            'incident_date' => '2026-10-01',
            'incident_type' => 'Water Damage & Plumbing Rupture',
            'incident_location' => '742 Evergreen Terrace, Austin, TX',
            'incident_description' => 'Upstairs pipe burst flooding ground floor living room.',
            'estimated_loss' => '$14,500.00',
            'assigned_adjuster' => 'David Miller',
            'priority' => 'urgent',
            'status' => 'reviewing',
            'adjuster_notes' => 'Contractor mitigation active.',
        ]);

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Claims Center &amp; FNOL Operations', false);
        $response->assertSee('CLM-2026-99001');
        $response->assertSee('Jonathan Harris');
        $response->assertSee('$14,500.00');
        $response->assertSee('David Miller');
        $response->assertSee('Water Damage &amp; Plumbing Rupture', false);
    }

    public function test_admin_can_store_fnol_claim_record(): void
    {
        $admin = $this->createAdmin();

        $claimData = [
            'claim_number' => 'CLM-2026-77889',
            'policy_number' => 'SB-AUT-889900',
            'claimant_name' => 'Alice Walker',
            'claimant_email' => 'alice@example.com',
            'claimant_phone' => '(512) 555-0188',
            'incident_date' => '2026-10-10',
            'incident_type' => 'Vehicle Collision / Physical Damage',
            'incident_location' => 'Downtown Austin Intersection',
            'incident_description' => 'Rear end collision at stop light, bumper crushed.',
            'estimated_loss' => '6500',
            'assigned_adjuster' => 'Sarah Jenkins',
            'priority' => 'high',
            'status' => 'submitted',
            'adjuster_notes' => 'Awaiting police crash report.',
        ];

        $response = $this->actingAs($admin)->postJson(route('admin.claims-center.store'), $claimData);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('claims', [
            'claim_number' => 'CLM-2026-77889',
            'claimant_name' => 'Alice Walker',
            'policy_number' => 'SB-AUT-889900',
            'estimated_loss' => '$6,500.00',
            'priority' => 'high',
            'status' => 'submitted',
        ]);
    }

    public function test_admin_can_update_claim_record(): void
    {
        $admin = $this->createAdmin();

        $claim = Claim::create([
            'claim_number' => 'CLM-2026-11223',
            'policy_number' => 'SB-HOM-554433',
            'claimant_name' => 'Robert Finch',
            'incident_date' => '2026-09-15',
            'incident_type' => 'Severe Windstorm & Hail',
            'incident_description' => 'Hail damage on roof shingles.',
            'estimated_loss' => '$9,000.00',
            'assigned_adjuster' => 'Michael Vance',
            'priority' => 'normal',
            'status' => 'reviewing',
        ]);

        $updateData = [
            'claim_number' => 'CLM-2026-11223',
            'policy_number' => 'SB-HOM-554433',
            'claimant_name' => 'Robert Finch',
            'incident_date' => '2026-09-15',
            'incident_type' => 'Severe Windstorm & Hail',
            'incident_location' => 'Austin, TX',
            'incident_description' => 'Hail damage on roof shingles verified by drone inspection.',
            'estimated_loss' => '$11,200.00',
            'assigned_adjuster' => 'Michael Vance (Senior Adjuster)',
            'priority' => 'high',
            'status' => 'approved',
            'adjuster_notes' => 'Drone imagery confirmed 42 broken architectural shingles.',
        ];

        $response = $this->actingAs($admin)->putJson(route('admin.claims-center.update', $claim->id), $updateData);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertDatabaseHas('claims', [
            'id' => $claim->id,
            'estimated_loss' => '$11,200.00',
            'status' => 'approved',
            'priority' => 'high',
        ]);
    }

    public function test_admin_can_quick_update_claim_status(): void
    {
        $admin = $this->createAdmin();

        $claim = Claim::create([
            'claim_number' => 'CLM-2026-33445',
            'policy_number' => 'SB-BUS-998877',
            'claimant_name' => 'Acme Corporation',
            'incident_date' => '2026-10-05',
            'incident_description' => 'Water intrusion in server room.',
            'estimated_loss' => '$25,000.00',
            'priority' => 'urgent',
            'status' => 'reviewing',
        ]);

        $response = $this->actingAs($admin)->patchJson(route('admin.claims-center.status', $claim->id), [
            'status' => 'paid',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'status' => 'paid',
        ]);

        $this->assertEquals('paid', $claim->fresh()->status);
    }

    public function test_admin_can_delete_claim_record(): void
    {
        $admin = $this->createAdmin();

        $claim = Claim::create([
            'claim_number' => 'CLM-2026-55667',
            'policy_number' => 'SB-LIF-123789',
            'claimant_name' => 'Test User',
            'incident_date' => '2026-10-01',
            'incident_description' => 'Accidental test submission.',
            'estimated_loss' => '$1,000.00',
            'priority' => 'low',
            'status' => 'submitted',
        ]);

        $response = $this->actingAs($admin)->deleteJson(route('admin.claims-center.delete', $claim->id));

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $this->assertDatabaseMissing('claims', [
            'id' => $claim->id,
        ]);
    }

    public function test_regular_customer_cannot_access_claims_center(): void
    {
        $customer = $this->createCustomer();

        $response = $this->actingAs($customer)->get('/admin');
        $response->assertRedirect(route('dashboard'));

        $claimData = [
            'policy_number' => 'SB-AUT-111111',
            'claimant_name' => 'Hacker',
            'incident_description' => 'Unauthorized breach attempt',
            'estimated_loss' => '1000',
            'priority' => 'low',
            'status' => 'submitted',
        ];

        $postResponse = $this->actingAs($customer)->postJson(route('admin.claims-center.store'), $claimData);
        $postResponse->assertStatus(403);
    }
}
