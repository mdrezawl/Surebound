<?php

namespace Tests\Feature;

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

    public function test_standard_admin_cannot_create_admin_account(): void
    {
        $admin = $this->createStandardAdmin();

        $response = $this->actingAs($admin)->post('/admin/users', [
            'name' => 'Hacker Admin',
            'email' => 'hacker@surebound.com',
            'password' => 'secretPassword123',
            'role' => 'admin',
            'title' => 'Admin Attempt',
        ]);

        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('users', [
            'email' => 'hacker@surebound.com',
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

    public function test_super_admin_sees_create_admin_button_while_standard_admin_does_not(): void
    {
        $superAdmin = $this->createSuperAdmin();
        $standardAdmin = $this->createStandardAdmin();

        $responseSuper = $this->actingAs($superAdmin)->get('/admin');
        $responseSuper->assertStatus(200);
        $responseSuper->assertSee('Create New Admin');

        $responseStandard = $this->actingAs($standardAdmin)->get('/admin');
        $responseStandard->assertStatus(200);
        $responseStandard->assertDontSee('Create New Admin');
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
}
