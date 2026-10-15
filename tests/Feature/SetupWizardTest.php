<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class SetupWizardTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        // Always ensure setup wizard files are present after tests run
        if (! File::exists(app_path('Http/Controllers/SetupController.php'))) {
            $this->artisan('setup:restore');
        }

        // Clean up test installed file if created during tests
        if (File::exists(storage_path('installed'))) {
            File::delete(storage_path('installed'));
        }

        parent::tearDown();
    }

    public function test_setup_welcome_page_is_accessible_when_not_installed(): void
    {
        if (File::exists(storage_path('installed'))) {
            File::delete(storage_path('installed'));
        }

        $response = $this->get('/setup');
        $response->assertStatus(200);
        $response->assertSee('Server Compatibility Checks');
    }

    public function test_setup_database_page_is_accessible(): void
    {
        if (File::exists(storage_path('installed'))) {
            File::delete(storage_path('installed'));
        }

        $response = $this->get('/setup/database');
        $response->assertStatus(200);
        $response->assertSee('Database Configuration');
    }

    public function test_setup_admin_page_is_accessible(): void
    {
        if (File::exists(storage_path('installed'))) {
            File::delete(storage_path('installed'));
        }

        $response = $this->get('/setup/admin');
        $response->assertStatus(200);
        $response->assertSee('Create Super Administrator Account');
    }

    public function test_setup_admin_save_creates_user_and_installed_lock(): void
    {
        if (File::exists(storage_path('installed'))) {
            File::delete(storage_path('installed'));
        }

        $response = $this->post('/setup/admin', [
            'name' => 'Test Super Admin',
            'email' => 'testadmin@surebound.com',
            'password' => 'secretPassword123!',
            'password_confirmation' => 'secretPassword123!',
        ]);

        $response->assertRedirect(route('setup.complete'));
        $this->assertTrue(File::exists(storage_path('installed')));
        $this->assertDatabaseHas('users', [
            'email' => 'testadmin@surebound.com',
            'role' => 'admin',
        ]);
    }

    public function test_when_installed_visiting_setup_redirects_to_login(): void
    {
        File::put(storage_path('installed'), 'Installed test');

        $response = $this->get('/setup');
        $response->assertRedirect(route('login'));
    }

    public function test_setup_complete_renders_success_and_purges_files(): void
    {
        File::put(storage_path('installed'), 'Installed test');

        $response = $this->get('/setup/complete');
        $response->assertStatus(200);
        $response->assertSee('Setup & Installation Complete!', false);
        $response->assertSee('Automatic Security Clean-up Executed');

        // Verify that installer files were automatically purged from disk
        $this->assertFalse(File::exists(app_path('Http/Controllers/SetupController.php')));
        $this->assertFalse(File::exists(resource_path('views/setup.blade.php')));
        $this->assertFalse(File::exists(base_path('routes/setup.php')));

        // Verify that subsequent access to /setup redirects safely to login
        $followUpResponse = $this->get('/setup');
        $followUpResponse->assertRedirect(route('login'));

        // Restore files using artisan command
        $this->artisan('setup:restore')->assertSuccessful();
        $this->assertTrue(File::exists(app_path('Http/Controllers/SetupController.php')));
        $this->assertTrue(File::exists(resource_path('views/setup.blade.php')));
        $this->assertTrue(File::exists(base_path('routes/setup.php')));
    }
}
