<?php

namespace Tests\Feature;

use App\Models\ApiSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MarketingIntegrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_or_regular_user_cannot_update_marketing_settings(): void
    {
        // 1. Guest
        $guestResponse = $this->postJson('/admin/marketing', [
            'google_enabled' => '1',
            'google_gtm_id' => 'GTM-HACKED1',
        ]);
        $guestResponse->assertStatus(401);

        // 2. Regular user
        $regularUser = User::factory()->create([
            'role' => 'user',
        ]);
        $userResponse = $this->actingAs($regularUser)->post('/admin/marketing', [
            'google_enabled' => '1',
            'google_gtm_id' => 'GTM-HACKED1',
        ]);
        $userResponse->assertRedirect('/dashboard');
    }

    public function test_admin_can_view_marketing_hub_on_admin_dashboard(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Marketing, Tracking &amp; Pixels Hub', false);
        $response->assertSee('marketing-pill-nav');
        $response->assertSee('marketingPaneOverview');
        $response->assertSee('marketingPaneGoogle');
        $response->assertSee('marketingPaneMeta');
        $response->assertSee('marketingPaneLinkedin');
        $response->assertSee('marketingPaneTwitter');
        $response->assertSee('marketingPaneTiktok');
        $response->assertSee('marketingPaneSocial');
        $response->assertSee('marketingPaneScripts');
        $response->assertSee('sidebar-sublink');
        $response->assertSee('switchMarketingSubTab');
        $response->assertSee('Google Marketing Suite');
        $response->assertSee('Meta (Facebook &amp; Instagram) Marketing Suite', false);
        $response->assertSee('LinkedIn Campaign Manager (Insight Tag)');
        $response->assertSee('Twitter (X) Ads Universal Website Tag');
        $response->assertSee('TikTok For Business (TikTok Pixel &amp; Events API)', false);
        $response->assertSee('Live Social Feed Preview');
    }

    public function test_admin_can_save_marketing_settings(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $payload = [
            'google_enabled' => '1',
            'google_gtm_id' => 'GTM-TEST999',
            'google_gtm_enabled' => '1',
            'google_ga4_id' => 'G-TEST8888',
            'google_ga4_enabled' => '1',
            'google_ads_id' => 'AW-77777777',
            'google_ads_label' => 'test_label_lead',
            'google_ads_enabled' => '1',
            'google_site_verification' => 'google_verify_code_123',

            'meta_enabled' => '1',
            'meta_pixel_id' => '999888777666555',
            'meta_pixel_enabled' => '1',
            'meta_capi_token' => 'EAAK_test_token_live',
            'meta_test_event_code' => 'TEST999',
            'meta_domain_verification' => 'meta_domain_verify_456',

            'linkedin_enabled' => '1',
            'linkedin_partner_id' => '5554443',
            'linkedin_conversion_id' => '112233',

            'twitter_enabled' => '1',
            'twitter_pixel_id' => 'tw-test-pixel',
            'twitter_site_handle' => '@SureboundTest',

            'tiktok_enabled' => '1',
            'tiktok_pixel_id' => 'C999888777TEST',
            'tiktok_events_api_token' => 'tt_test_events_token',

            'social_default_title' => 'Custom Social Share Title',
            'social_default_description' => 'Custom Social Share Description',
            'social_default_image' => 'images/custom-og.jpg',
            'social_og_type' => 'website',
            'social_twitter_card_type' => 'summary_large_image',
            'social_canonical_url' => 'https://surebound.com',

            'custom_scripts_enabled' => '1',
            'custom_header_scripts' => '<script>console.log("Custom Head Script");</script>',
            'custom_body_scripts' => '<script>console.log("Custom Body Script");</script>',
        ];

        $response = $this->actingAs($admin)->postJson('/admin/marketing', $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Marketing & Tracking Pixel configurations saved successfully!',
        ]);

        $this->assertDatabaseHas('api_settings', [
            'key' => 'marketing_settings',
        ]);

        $saved = ApiSetting::where('key', 'marketing_settings')->first()->value;
        $this->assertEquals('GTM-TEST999', $saved['google']['gtm_id']);
        $this->assertEquals('999888777666555', $saved['meta']['pixel_id']);
        $this->assertEquals('5554443', $saved['linkedin']['partner_id']);
        $this->assertEquals('tw-test-pixel', $saved['twitter']['pixel_id']);
        $this->assertEquals('C999888777TEST', $saved['tiktok']['pixel_id']);
        $this->assertEquals('Custom Social Share Title', $saved['social_meta']['default_title']);
    }

    public function test_admin_can_ping_and_test_marketing_platforms(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $platforms = ['google', 'meta', 'linkedin', 'twitter', 'tiktok', 'all'];

        foreach ($platforms as $platform) {
            $response = $this->actingAs($admin)->postJson('/admin/marketing/test', [
                'platform' => $platform,
            ]);

            $response->assertStatus(200);
            $response->assertJson([
                'success' => true,
                'status' => 'verified',
            ]);
            $this->assertArrayHasKey('latency_ms', $response->json());
        }
    }

    public function test_public_pages_render_configured_marketing_tags(): void
    {
        // Seed marketing settings
        ApiSetting::updateOrCreate(
            ['key' => 'marketing_settings'],
            ['value' => [
                'google' => [
                    'enabled' => true,
                    'gtm_id' => 'GTM-TESTPUB1',
                    'gtm_enabled' => true,
                    'ga4_id' => 'G-TESTPUB2',
                    'ga4_enabled' => true,
                    'google_ads_id' => 'AW-9999999',
                    'google_ads_enabled' => true,
                    'site_verification' => 'google_verify_public_token',
                ],
                'meta' => [
                    'enabled' => true,
                    'pixel_id' => '111222333444555',
                    'pixel_enabled' => true,
                    'domain_verification' => 'facebook_verify_public_token',
                ],
                'linkedin' => [
                    'enabled' => true,
                    'partner_id' => '7776665',
                ],
                'twitter' => [
                    'enabled' => true,
                    'pixel_id' => 'tw-pub-test',
                    'site_handle' => '@SureboundPublic',
                ],
                'tiktok' => [
                    'enabled' => true,
                    'pixel_id' => 'C987654321PUB',
                ],
                'social_meta' => [
                    'default_title' => 'Public Meta Title Test',
                    'default_description' => 'Public Meta Description Test',
                    'default_image' => 'images/logo.png',
                    'og_type' => 'website',
                    'twitter_card_type' => 'summary_large_image',
                ],
                'custom_scripts' => [
                    'enabled' => true,
                    'header_scripts' => '<script id="custom-head-tracking">console.log("head");</script>',
                    'body_scripts' => '<div id="custom-body-tracking">body</div>',
                ],
            ]]
        );

        $response = $this->get('/home-insurance');

        $response->assertStatus(200);
        // Meta tags
        $response->assertSee('name="google-site-verification" content="google_verify_public_token"', false);
        $response->assertSee('name="facebook-domain-verification" content="facebook_verify_public_token"', false);
        $response->assertSee('property="og:title" content="Public Meta Title Test"', false);
        $response->assertSee('name="twitter:site" content="@SureboundPublic"', false);

        // Scripts
        $response->assertSee('GTM-TESTPUB1');
        $response->assertSee('G-TESTPUB2');
        $response->assertSee('111222333444555');
        $response->assertSee('7776665');
        $response->assertSee('tw-pub-test');
        $response->assertSee('C987654321PUB');
        $response->assertSee('custom-head-tracking');
        $response->assertSee('custom-body-tracking');
    }
}
