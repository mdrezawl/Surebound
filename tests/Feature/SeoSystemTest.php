<?php

namespace Tests\Feature;

use App\Models\SeoAudit;
use App\Models\SeoMetadata;
use App\Models\SeoRecommendation;
use App\Models\SeoRedirect;
use App\Models\User;
use App\Services\SeoAuditService;
use App\Services\SeoCrawlerService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SeoSystemTest extends TestCase
{
    use RefreshDatabase;

    protected function createAdminUser(): User
    {
        return User::factory()->create([
            'name' => 'SEO Director',
            'email' => 'seo.director@surebound.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_super_admin' => true,
        ]);
    }

    protected function createStandardUser(): User
    {
        return User::factory()->create([
            'name' => 'Regular User',
            'email' => 'regular.user@example.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'is_super_admin' => false,
        ]);
    }

    public function test_unauthenticated_user_cannot_access_seo_admin(): void
    {
        $response = $this->get('/admin/seo');
        $response->assertRedirect('/login');
    }

    public function test_non_admin_user_is_forbidden_from_seo_admin(): void
    {
        $user = $this->createStandardUser();
        $response = $this->actingAs($user)->get('/admin/seo');
        // Admin middleware redirects or returns 403
        $this->assertTrue(in_array($response->getStatusCode(), [302, 403]));
    }

    public function test_admin_can_access_seo_admin_hub_and_all_tabs(): void
    {
        $admin = $this->createAdminUser();

        $response = $this->actingAs($admin)->get('/admin/seo');
        $response->assertStatus(200);
        $response->assertSee('Surebound');
        $response->assertSee('1. Overview Dashboard');
        $response->assertSee('2. SEO Audit Center');
        $response->assertSee('3. Pages & On-Page SEO');
        $response->assertSee('8. Technical SEO');
        $response->assertSee('9. Sitemap & Robots Manager');
        $response->assertSee('10. Structured Data / Schema');
        $response->assertSee('11. Google Search Console');
        $response->assertSee('12. Google Analytics 4');
        $response->assertSee('13. PageSpeed & Core Web Vitals');
        $response->assertSee('14. AI Search Visibility');
        $response->assertSee('15. AI Crawler Management');
        $response->assertSee('16. International SEO');
        $response->assertSee('21. Redirect & Broken Links');
        $response->assertSee('22. Lead & Conversion Tracking');
        $response->assertSee('26. Settings & Audit Logs');
    }

    public function test_public_homepage_renders_seo_head_metadata_canonical_and_schema(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // Check canonical URL is rendered
        $response->assertSee('<link rel="canonical"', false);

        // Check robots directive
        $response->assertSee('<meta name="robots"', false);

        // Check hreflang tags
        $response->assertSee('hreflang="en-US"', false);
        $response->assertSee('hreflang="en-GB"', false);
        $response->assertSee('hreflang="en-CA"', false);
        $response->assertSee('hreflang="x-default"', false);

        // Check JSON-LD schema is present and valid JSON
        $content = $response->getContent();
        $this->assertStringContainsString('application/ld+json', $content);

        preg_match('/<script type="application\/ld\+json">(.*?)<\/script>/s', $content, $matches);
        $this->assertNotEmpty($matches, 'JSON-LD script block should be present.');

        $decodedSchema = json_decode($matches[1], true);
        $this->assertIsArray($decodedSchema, 'JSON-LD schema should be valid JSON.');
        $this->assertEquals('https://schema.org', $decodedSchema['@context']);
        $type = $decodedSchema['@type'] ?? ($decodedSchema['@graph'][0]['@type'] ?? null);
        $this->assertEquals('InsuranceAgency', $type);
    }

    public function test_sitemap_xml_returns_valid_xml_with_all_public_canonical_routes(): void
    {
        $response = $this->get('/sitemap.xml');
        $response->assertStatus(200);
        $this->assertStringContainsString('xml', $response->headers->get('Content-Type'));

        $content = $response->getContent();
        $this->assertStringContainsString('<?xml version="1.0" encoding="UTF-8"?>', $content);
        $this->assertStringContainsString('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', $content);

        // Should include homepage, services, and public pages
        $this->assertStringContainsString('/business-insurance</loc>', $content);
        $this->assertStringContainsString('/commercial-auto-insurance</loc>', $content);
        $this->assertStringContainsString('/surety-bond</loc>', $content);
        $this->assertStringContainsString('/contact</loc>', $content);

        // Should NOT contain private admin routes
        $this->assertStringNotContainsString('/admin', $content);
    }

    public function test_robots_txt_returns_text_plain_with_ai_crawlers_and_sitemap(): void
    {
        $response = $this->get('/robots.txt');
        $response->assertStatus(200);
        $this->assertStringContainsString('text/plain', $response->headers->get('Content-Type'));

        $content = $response->getContent();
        $this->assertStringContainsString('User-agent: *', $content);
        $this->assertStringContainsString('User-agent: Googlebot', $content);
        $this->assertStringContainsString('User-agent: OAI-SearchBot', $content);
        $this->assertStringContainsString('User-agent: PerplexityBot', $content);
        $this->assertStringContainsString('Disallow: /admin/', $content);
        $this->assertStringContainsString('Sitemap:', $content);
    }

    public function test_admin_can_update_on_page_seo_metadata(): void
    {
        $admin = $this->createAdminUser();

        // Create initial metadata
        $meta = SeoMetadata::create([
            'url_path' => '/surety-bond',
            'title' => 'Surety Bonds',
            'seo_title' => 'Initial Title | Surebound',
            'meta_description' => 'Initial description that is somewhat short.',
            'meta_robots' => 'index, follow',
            'focus_keyword' => 'surety bonds',
            'search_intent' => 'commercial',
            'target_country' => 'US',
            'target_language' => 'en',
            'schema_type' => 'FinancialProduct',
            'is_published' => true,
        ]);

        $response = $this->actingAs($admin)->put("/admin/seo/pages/{$meta->id}", [
            'seo_title' => 'Commercial Surety Bonds & Contract Guarantees | Surebound',
            'meta_description' => 'Fast, verified commercial and contract surety bond underwriting with nationwide coverage and instant contractor qualification across the USA, UK, and Canada.',
            'focus_keyword' => 'commercial surety bonds',
            'secondary_keywords' => 'contractor bonds, bid bonds, performance bonds',
            'search_intent' => 'commercial',
            'meta_robots' => 'index, follow',
            'target_country' => 'US',
            'target_language' => 'en',
            'schema_type' => 'FinancialProduct',
            'is_published' => '1',
        ]);

        $response->assertRedirect('/admin/seo?tab=pages');
        $response->assertSessionHas('success');

        $meta->refresh();
        $this->assertEquals('Commercial Surety Bonds & Contract Guarantees | Surebound', $meta->seo_title);
        $this->assertEquals('commercial surety bonds', $meta->focus_keyword);
        $this->assertContains('contractor bonds', $meta->secondary_keywords);
    }

    public function test_redirect_manager_creates_and_prevents_redirect_loops(): void
    {
        $admin = $this->createAdminUser();

        // 1. Create a valid redirect
        $response = $this->actingAs($admin)->post('/admin/seo/redirects', [
            'source_path' => '/old-surety-bonds',
            'destination_url' => '/surety-bond',
            'status_code' => 301,
            'reason' => 'Legacy URL cleanup',
        ]);

        $response->assertRedirect('/admin/seo?tab=redirects');
        $this->assertDatabaseHas('seo_redirects', [
            'source_path' => '/old-surety-bonds',
            'destination_url' => '/surety-bond',
            'status_code' => 301,
        ]);

        // 2. Test loop detection
        $this->assertTrue(SeoRedirect::wouldFormLoop('/surety-bond', '/old-surety-bonds'));

        // 3. Attempting to create a loop redirect should be rejected
        $loopResponse = $this->actingAs($admin)->post('/admin/seo/redirects', [
            'source_path' => '/surety-bond',
            'destination_url' => '/old-surety-bonds',
            'status_code' => 301,
        ]);

        $loopResponse->assertRedirect('/admin/seo?tab=redirects');
        $loopResponse->assertSessionHas('error');
    }

    public function test_redirect_middleware_intercepts_and_executes_301_redirect(): void
    {
        SeoRedirect::create([
            'source_path' => '/legacy-commercial-auto',
            'destination_url' => '/commercial-auto-insurance',
            'status_code' => 301,
            'is_active' => true,
        ]);

        $response = $this->get('/legacy-commercial-auto');
        $response->assertStatus(301);
        $response->assertRedirect('/commercial-auto-insurance');

        // Check hit count incremented
        $this->assertDatabaseHas('seo_redirects', [
            'source_path' => '/legacy-commercial-auto',
            'hit_count' => 1,
        ]);
    }

    public function test_crawler_service_ssrf_protection_rejects_private_and_cloud_ips(): void
    {
        $crawler = app(SeoCrawlerService::class);

        // Private / Loopback IPs should be rejected
        $this->assertFalse($crawler->isSafeUrl('http://127.0.0.1'));
        $this->assertFalse($crawler->isSafeUrl('http://localhost/admin'));
        $this->assertFalse($crawler->isSafeUrl('http://10.0.0.1/secrets'));
        $this->assertFalse($crawler->isSafeUrl('http://172.16.0.5/api'));
        $this->assertFalse($crawler->isSafeUrl('http://192.168.1.1/router'));
        $this->assertFalse($crawler->isSafeUrl('http://169.254.169.254/latest/meta-data'));
        $this->assertFalse($crawler->isSafeUrl('file:///etc/passwd'));
        $this->assertFalse($crawler->isSafeUrl('ftp://example.com'));

        // Public Web URLs should be accepted
        $this->assertTrue($crawler->isSafeUrl('https://surebound.com'));
        $this->assertTrue($crawler->isSafeUrl('https://example.com/page'));
    }

    public function test_seo_audit_engine_executes_and_generates_findings_and_recommendations(): void
    {
        $admin = $this->createAdminUser();
        $auditService = app(SeoAuditService::class);
        $audit = $auditService->runFullAudit($admin->id);

        $this->assertInstanceOf(SeoAudit::class, $audit);
        $this->assertGreaterThan(0, $audit->pages_scanned);
        $this->assertGreaterThan(0, $audit->health_score);

        // Check audit findings and recommendations were persisted
        $this->assertDatabaseHas('seo_audits', ['id' => $audit->id]);
        $this->assertGreaterThan(0, $audit->findings()->count());
        $this->assertGreaterThan(0, SeoRecommendation::count());
    }

    public function test_seo_scheduled_commands_run_successfully(): void
    {
        $this->artisan('seo:check-crawlers')->assertSuccessful();
        $this->artisan('seo:validate-sitemaps')->assertSuccessful();
        $this->artisan('seo:process-alerts')->assertSuccessful();
    }
}
