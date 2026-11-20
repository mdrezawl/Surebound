<?php

namespace Tests\Feature;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminRolePermissionsTest extends TestCase
{
    use RefreshDatabase;

    protected function createSuperAdmin(array $attributes = []): User
    {
        return User::factory()->create(array_merge([
            'name' => 'Md Rezawl',
            'email' => 'help.rezawl71@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_super_admin' => true,
            'title' => 'Chief Underwriter & Super Admin',
        ], $attributes));
    }

    protected function createStandardAdmin(array $attributes = []): User
    {
        return User::factory()->create(array_merge([
            'name' => 'Standard Admin',
            'email' => 'standard.admin@surebound.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_super_admin' => false,
            'title' => 'System Administrator',
        ], $attributes));
    }

    public function test_super_admin_can_create_new_admin_account(): void
    {
        $superAdmin = $this->createSuperAdmin();

        $response = $this->actingAs($superAdmin)->post('/admin/users', [
            'name' => 'New Junior Admin',
            'email' => 'junior.admin@surebound.com',
            'password' => 'secretPassword123',
            'role' => 'admin',
            'title' => 'Junior Administrator',
            'phone' => '(206) 555-0199',
            'is_super_admin' => 0,
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('users', [
            'email' => 'junior.admin@surebound.com',
            'role' => 'admin',
            'is_super_admin' => false,
        ]);
    }

    public function test_standard_admin_can_create_admin_account_without_super_privilege(): void
    {
        $admin = $this->createStandardAdmin();

        $response = $this->actingAs($admin)->post('/admin/users', [
            'name' => 'Colleague Admin',
            'email' => 'colleague@surebound.com',
            'password' => 'secretPassword123',
            'role' => 'admin',
            'title' => 'Underwriter Admin',
            'is_super_admin' => 1, // Standard admin attempts to grant super admin
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('users', [
            'email' => 'colleague@surebound.com',
            'role' => 'admin',
            'is_super_admin' => false, // System ensures only super admins can grant super admin
        ]);
    }

    public function test_standard_admin_cannot_edit_or_change_role_of_super_admin(): void
    {
        $superAdmin = $this->createSuperAdmin();
        $admin = $this->createStandardAdmin();

        // Attempt via PATCH role
        $response1 = $this->actingAs($admin)->patch("/admin/users/{$superAdmin->id}/role", [
            'role' => 'user',
        ]);

        $response1->assertSessionHas('error');
        $this->assertEquals('admin', $superAdmin->fresh()->role);
        $this->assertTrue($superAdmin->fresh()->isSuperAdmin());

        // Attempt via PUT update
        $response2 = $this->actingAs($admin)->put("/admin/users/{$superAdmin->id}", [
            'name' => 'Tampered Name',
            'email' => 'tampered@surebound.com',
            'role' => 'user',
        ]);

        $response2->assertSessionHas('error');
        $this->assertEquals('Md Rezawl', $superAdmin->fresh()->name);
    }

    public function test_standard_admin_cannot_delete_super_admin(): void
    {
        $superAdmin = $this->createSuperAdmin();
        $admin = $this->createStandardAdmin();

        $response = $this->actingAs($admin)->delete("/admin/users/{$superAdmin->id}");

        $response->assertSessionHas('error');
        $this->assertDatabaseHas('users', [
            'id' => $superAdmin->id,
        ]);
    }

    public function test_standard_admin_cannot_delete_another_admin(): void
    {
        $admin1 = $this->createStandardAdmin(['email' => 'admin1@surebound.com']);
        $admin2 = $this->createStandardAdmin(['email' => 'admin2@surebound.com']);

        $response = $this->actingAs($admin1)->delete("/admin/users/{$admin2->id}");

        $response->assertSessionHas('error');
        $this->assertDatabaseHas('users', [
            'id' => $admin2->id,
        ]);
    }

    public function test_super_admin_can_delete_standard_admin(): void
    {
        $superAdmin = $this->createSuperAdmin();
        $standardAdmin = $this->createStandardAdmin();

        $response = $this->actingAs($superAdmin)->delete("/admin/users/{$standardAdmin->id}");

        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('users', [
            'id' => $standardAdmin->id,
        ]);
    }

    public function test_primary_super_admin_cannot_be_deleted(): void
    {
        $primarySuper = $this->createSuperAdmin(['email' => 'help.rezawl71@gmail.com']);
        $secondarySuper = $this->createSuperAdmin(['email' => 'super2@surebound.com']);

        $response = $this->actingAs($secondarySuper)->delete("/admin/users/{$primarySuper->id}");

        $response->assertSessionHas('error');
        $this->assertDatabaseHas('users', [
            'id' => $primarySuper->id,
        ]);
    }

    public function test_all_admins_see_create_admin_button(): void
    {
        $superAdmin = $this->createSuperAdmin();
        $standardAdmin = $this->createStandardAdmin();

        $responseSuper = $this->actingAs($superAdmin)->get('/admin');
        $responseSuper->assertStatus(200);
        $responseSuper->assertSee('+ Add Admin');
        $responseSuper->assertSee('Create New Admin');

        $responseStandard = $this->actingAs($standardAdmin)->get('/admin');
        $responseStandard->assertStatus(200);
        $responseStandard->assertSee('+ Add Admin');
        $responseStandard->assertSee('Create New Admin');
    }

    public function test_user_can_be_edited_with_new_password_email_and_phone(): void
    {
        $superAdmin = $this->createSuperAdmin();
        $standardAdmin = $this->createStandardAdmin([
            'email' => 'old.email@surebound.com',
            'phone' => '(206) 555-0101',
            'password' => Hash::make('oldPassword123'),
        ]);

        $response = $this->actingAs($superAdmin)->put("/admin/users/{$standardAdmin->id}", [
            'name' => 'Updated Admin Name',
            'email' => 'new.email@surebound.com',
            'phone' => '(206) 555-9999',
            'title' => 'Executive Vice President',
            'password' => 'brandNewSecurePass456',
            'role' => 'admin',
        ]);

        $response->assertSessionHas('success');

        $standardAdmin->refresh();
        $this->assertEquals('Updated Admin Name', $standardAdmin->name);
        $this->assertEquals('new.email@surebound.com', $standardAdmin->email);
        $this->assertEquals('(206) 555-9999', $standardAdmin->phone);
        $this->assertEquals('Executive Vice President', $standardAdmin->title);
        $this->assertTrue(Hash::check('brandNewSecurePass456', $standardAdmin->password));
    }

    public function test_user_password_is_retained_when_password_field_left_empty(): void
    {
        $superAdmin = $this->createSuperAdmin();
        $standardAdmin = $this->createStandardAdmin([
            'password' => Hash::make('keepThisPassword'),
        ]);

        $response = $this->actingAs($superAdmin)->put("/admin/users/{$standardAdmin->id}", [
            'name' => 'Name Changed Only',
            'email' => $standardAdmin->email,
            'phone' => '(206) 555-4444',
            'password' => '',
            'role' => 'admin',
        ]);

        $response->assertSessionHas('success');

        $standardAdmin->refresh();
        $this->assertEquals('Name Changed Only', $standardAdmin->name);
        $this->assertEquals('(206) 555-4444', $standardAdmin->phone);
        $this->assertTrue(Hash::check('keepThisPassword', $standardAdmin->password));
    }

    public function test_standard_admin_cannot_update_super_admin_details(): void
    {
        $superAdmin = $this->createSuperAdmin();
        $standardAdmin = $this->createStandardAdmin();

        $response = $this->actingAs($standardAdmin)->put("/admin/users/{$superAdmin->id}", [
            'name' => 'Hacked Super Admin',
            'email' => 'hacked@surebound.com',
            'phone' => '(000) 000-0000',
            'password' => 'hackedPass123',
        ]);

        $response->assertSessionHas('error');

        $superAdmin->refresh();
        $this->assertEquals('Md Rezawl', $superAdmin->name);
        $this->assertEquals('help.rezawl71@gmail.com', $superAdmin->email);
        $this->assertTrue(Hash::check('password123', $superAdmin->password));
    }

    public function test_admin_dashboard_shows_edit_buttons_and_edit_modal(): void
    {
        $superAdmin = $this->createSuperAdmin();
        $this->createStandardAdmin();

        $response = $this->actingAs($superAdmin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('modalEditUser');
        $response->assertSee('openEditUserModal');
        $response->assertSee('Edit User Account');
    }

    public function test_user_actions_redirect_to_users_tab_with_hash(): void
    {
        $superAdmin = $this->createSuperAdmin();

        $response = $this->actingAs($superAdmin)->post('/admin/users', [
            'name' => 'Agent John',
            'email' => 'agent.john@surebound.com',
            'password' => 'password123',
            'role' => 'agent',
            'title' => 'Licensed Agent',
        ]);

        $response->assertRedirect(route('admin.dashboard').'#users');

        $created = User::where('email', 'agent.john@surebound.com')->first();
        $this->assertNotNull($created);

        $updateResponse = $this->actingAs($superAdmin)->put('/admin/users/'.$created->id, [
            'name' => 'Agent John Updated',
            'email' => 'agent.john@surebound.com',
            'role' => 'agent',
            'title' => 'Senior Agent',
        ]);

        $updateResponse->assertRedirect(route('admin.dashboard').'#users');

        $deleteResponse = $this->actingAs($superAdmin)->delete('/admin/users/'.$created->id);
        $deleteResponse->assertRedirect(route('admin.dashboard').'#users');
    }

    public function test_admin_dashboard_renders_early_tab_restoration_script(): void
    {
        $superAdmin = $this->createSuperAdmin();

        $response = $this->actingAs($superAdmin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('earlyTabStyle');
        $response->assertSee('sb_admin_active_tab');
        $response->assertSee('js/admin.js');
    }

    public function test_clear_demo_data_command_purges_test_records_and_retains_super_admin(): void
    {
        $superAdmin = $this->createSuperAdmin();

        Invoice::create([
            'invoice_number' => 'INV-DEMO-999',
            'customer_name' => 'Demo User',
            'customer_email' => 'demo@example.com',
            'total_amount' => 5000,
            'status' => 'paid',
            'issue_date' => now()->toDateString(),
            'due_date' => now()->addDays(30)->toDateString(),
        ]);

        User::create([
            'name' => 'Sarah Jenkins',
            'email' => 'admin@surebound.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $this->artisan('app:clear-demo-data', ['--force' => true])
            ->assertSuccessful();

        $this->assertEquals(0, Invoice::count());
        $this->assertDatabaseMissing('users', ['email' => 'admin@surebound.com']);
        $this->assertDatabaseHas('users', ['email' => 'help.rezawl71@gmail.com']);
    }

    public function test_admin_can_trigger_clear_demo_data_endpoint(): void
    {
        $admin = $this->createStandardAdmin();

        $response = $this->actingAs($admin)->post('/admin/system/clear-demo-data');

        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('success');
    }

    public function test_super_admin_can_create_admin_with_specific_allowed_pages(): void
    {
        $superAdmin = $this->createSuperAdmin();

        $response = $this->actingAs($superAdmin)->post('/admin/users', [
            'name' => 'Restricted Admin',
            'email' => 'restricted.admin@surebound.com',
            'password' => 'secretPassword123',
            'role' => 'admin',
            'title' => 'Underwriting Associate',
            'is_super_admin' => 0,
            'allowed_pages' => ['quotes', 'policies'],
        ]);

        $response->assertSessionHas('success');

        $created = User::where('email', 'restricted.admin@surebound.com')->first();
        $this->assertNotNull($created);
        $this->assertEquals(['quotes', 'policies'], $created->allowed_pages);
        $this->assertTrue($created->hasPageAccess('quotes'));
        $this->assertTrue($created->hasPageAccess('policies'));
        $this->assertTrue($created->hasPageAccess('overview'));
        $this->assertFalse($created->hasPageAccess('users'));
        $this->assertFalse($created->hasPageAccess('invoices'));
        $this->assertFalse($created->hasPageAccess('seo'));
        $this->assertFalse($created->hasPageAccess('cms'));
    }

    public function test_has_page_access_handles_cms_and_marketing_groups(): void
    {
        $cmsAdmin = User::factory()->create([
            'role' => 'admin',
            'is_super_admin' => false,
            'allowed_pages' => ['cms'],
        ]);

        $this->assertTrue($cmsAdmin->hasPageAccess('home-cms'));
        $this->assertTrue($cmsAdmin->hasPageAccess('auto-cms'));
        $this->assertTrue($cmsAdmin->hasPageAccess('brand-settings'));
        $this->assertTrue($cmsAdmin->hasPageAccess('contact-info'));
        $this->assertFalse($cmsAdmin->hasPageAccess('invoices'));
        $this->assertFalse($cmsAdmin->hasPageAccess('users'));

        $mktAdmin = User::factory()->create([
            'role' => 'admin',
            'is_super_admin' => false,
            'allowed_pages' => ['marketing'],
        ]);

        $this->assertTrue($mktAdmin->hasPageAccess('marketing'));
        $this->assertTrue($mktAdmin->hasPageAccess('marketing-google'));
        $this->assertFalse($mktAdmin->hasPageAccess('quotes'));
    }

    public function test_admin_without_seo_permission_is_forbidden_from_seo_hub(): void
    {
        $adminWithoutSeo = User::factory()->create([
            'role' => 'admin',
            'is_super_admin' => false,
            'allowed_pages' => ['quotes', 'policies'],
        ]);

        $response = $this->actingAs($adminWithoutSeo)->get('/admin/seo');
        $response->assertStatus(403);
    }

    public function test_admin_with_seo_permission_can_access_seo_hub(): void
    {
        $adminWithSeo = User::factory()->create([
            'role' => 'admin',
            'is_super_admin' => false,
            'allowed_pages' => ['seo', 'quotes'],
        ]);

        $response = $this->actingAs($adminWithSeo)->get('/admin/seo');
        $response->assertStatus(200);
    }

    public function test_super_admin_always_has_all_page_access(): void
    {
        $superAdmin = $this->createSuperAdmin([
            'allowed_pages' => [], // Even if empty array set accidentally
        ]);

        $this->assertTrue($superAdmin->hasPageAccess('quotes'));
        $this->assertTrue($superAdmin->hasPageAccess('users'));
        $this->assertTrue($superAdmin->hasPageAccess('seo'));
        $this->assertTrue($superAdmin->hasPageAccess('invoices'));
        $this->assertTrue($superAdmin->hasPageAccess('home-cms'));
        $this->assertTrue($superAdmin->hasPageAccess('any-arbitrary-page'));
    }

    public function test_super_admin_can_update_admin_allowed_pages(): void
    {
        $superAdmin = $this->createSuperAdmin();
        $targetAdmin = $this->createStandardAdmin([
            'allowed_pages' => ['quotes'],
        ]);

        $response = $this->actingAs($superAdmin)->put('/admin/users/'.$targetAdmin->id, [
            'name' => $targetAdmin->name,
            'email' => $targetAdmin->email,
            'role' => 'admin',
            'title' => $targetAdmin->title,
            'allowed_pages' => ['quotes', 'invoices', 'claims'],
        ]);

        $response->assertSessionHas('success');
        $this->assertEquals(['quotes', 'invoices', 'claims'], $targetAdmin->fresh()->allowed_pages);
    }
}
