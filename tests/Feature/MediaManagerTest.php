<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class MediaManagerTest extends TestCase
{
    use RefreshDatabase;

    protected function createAdmin(array $attributes = []): User
    {
        return User::factory()->create(array_merge([
            'role' => 'admin',
            'is_super_admin' => true,
        ], $attributes));
    }

    public function test_admin_dashboard_renders_files_photos_tab_and_sidebar_link(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('data-tab="files-photos"', false);
        $response->assertSee('id="tab-files-photos"', false);
        $response->assertSee('Files &amp; Photos Manager', false);
    }

    public function test_admin_can_retrieve_media_list_json(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->getJson(route('admin.media.list'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'files',
                'total_count',
                'image_count',
                'doc_count',
                'total_size',
            ],
        ]);
        $this->assertTrue($response->json('success'));
        $this->assertGreaterThan(0, $response->json('data.total_count'));
    }

    public function test_admin_can_upload_and_delete_media_file(): void
    {
        $admin = $this->createAdmin();

        $file = UploadedFile::fake()->image('test-signature-photo.jpg', 400, 400);

        $uploadResponse = $this->actingAs($admin)->postJson(route('admin.media.upload'), [
            'files' => [$file],
            'folder' => 'images',
        ]);

        $uploadResponse->assertStatus(200);
        $uploadResponse->assertJson(['success' => true]);

        $uploadedPath = $uploadResponse->json('files.0.path');
        $this->assertNotNull($uploadedPath);
        $this->assertFileExists(public_path($uploadedPath));

        // Delete the uploaded file
        $deleteResponse = $this->actingAs($admin)->deleteJson(route('admin.media.delete'), [
            'path' => $uploadedPath,
        ]);

        $deleteResponse->assertStatus(200);
        $deleteResponse->assertJson(['success' => true]);
        $this->assertFileDoesNotExist(public_path($uploadedPath));
    }

    public function test_protected_system_assets_cannot_be_deleted(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->deleteJson(route('admin.media.delete'), [
            'path' => 'images/logo.png',
        ]);

        $response->assertStatus(403);
        $response->assertJson(['success' => false]);
    }

    public function test_path_traversal_attempts_are_blocked(): void
    {
        $admin = $this->createAdmin();

        $response = $this->actingAs($admin)->deleteJson(route('admin.media.delete'), [
            'path' => 'images/../../.env',
        ]);

        $response->assertStatus(400);
        $response->assertJson(['success' => false]);
    }

    public function test_non_admin_cannot_access_media_manager_endpoints(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $responseList = $this->actingAs($user)->get(route('admin.media.list'));
        $this->assertTrue(in_array($responseList->status(), [403, 302], true));

        $file = UploadedFile::fake()->image('unauthorized.jpg');
        $responseUpload = $this->actingAs($user)->post(route('admin.media.upload'), [
            'files' => [$file],
        ]);
        $this->assertTrue(in_array($responseUpload->status(), [403, 302], true));
    }
}
