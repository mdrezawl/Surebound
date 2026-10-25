<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Core On-Page SEO Metadata
        Schema::create('seo_metadata', function (Blueprint $table) {
            $table->id();
            $table->string('url_path')->unique()->index();
            $table->string('route_name')->nullable()->index();
            $table->string('seo_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('meta_robots')->default('index, follow');
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_type')->default('website');
            $table->string('twitter_card')->default('summary_large_image');
            $table->string('focus_keyword')->nullable()->index();
            $table->json('secondary_keywords')->nullable();
            $table->string('search_intent')->default('commercial');
            $table->string('target_country', 10)->default('US');
            $table->string('target_language', 10)->default('en');
            $table->string('schema_type')->nullable();
            $table->json('schema_override')->nullable();
            $table->boolean('is_published')->default(true);
            $table->string('author_name')->nullable();
            $table->string('reviewed_by')->nullable();
            $table->timestamps();
        });

        // 2. SEO Redirects with hit count and status
        Schema::create('seo_redirects', function (Blueprint $table) {
            $table->id();
            $table->string('source_path')->unique()->index();
            $table->string('destination_url');
            $table->unsignedSmallInteger('status_code')->default(301);
            $table->boolean('is_active')->default(true)->index();
            $table->string('reason')->nullable();
            $table->unsignedBigInteger('hit_count')->default(0);
            $table->timestamp('last_hit_at')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // 3. Technical SEO Audits
        Schema::create('seo_audits', function (Blueprint $table) {
            $table->id();
            $table->string('audit_type')->default('manual'); // manual, scheduled, api
            $table->string('status')->default('completed')->index(); // running, completed, failed
            $table->unsignedInteger('pages_scanned')->default(0);
            $table->unsignedInteger('critical_count')->default(0);
            $table->unsignedInteger('high_count')->default(0);
            $table->unsignedInteger('medium_count')->default(0);
            $table->unsignedInteger('low_count')->default(0);
            $table->unsignedInteger('info_count')->default(0);
            $table->unsignedTinyInteger('health_score')->default(100);
            $table->text('summary')->nullable();
            $table->decimal('duration_seconds', 8, 2)->default(0);
            $table->foreignId('triggered_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        // 4. Audit Findings
        Schema::create('seo_audit_findings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('audit_id')->constrained('seo_audits')->cascadeOnDelete();
            $table->string('url')->index();
            $table->string('category')->index(); // metadata, indexability, headings, images, performance, security, links, schema
            $table->string('severity')->index(); // critical, high, medium, low, info
            $table->string('issue_code')->index();
            $table->string('title');
            $table->text('description');
            $table->text('evidence')->nullable();
            $table->text('recommended_fix');
            $table->string('status')->default('open')->index(); // open, resolved, ignored, auto_fixed
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });

        // 5. Automated Recommendations & Safe Fixes
        Schema::create('seo_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('finding_id')->nullable()->constrained('seo_audit_findings')->nullOnDelete();
            $table->string('url')->index();
            $table->string('title');
            $table->string('category')->index();
            $table->string('impact')->default('medium'); // high, medium, low
            $table->unsignedTinyInteger('confidence')->default(85); // 1-100%
            $table->string('estimated_effort')->default('quick'); // quick, moderate, involved
            $table->boolean('requires_human_approval')->default(true);
            $table->string('status')->default('pending')->index(); // pending, approved, applied, rejected, rolled_back
            $table->text('current_value')->nullable();
            $table->text('suggested_value')->nullable();
            $table->timestamp('applied_at')->nullable();
            $table->timestamps();
        });

        // 6. Keywords & Topic Clusters
        Schema::create('seo_keyword_targets', function (Blueprint $table) {
            $table->id();
            $table->string('keyword')->index();
            $table->string('target_url')->index();
            $table->string('target_country', 10)->default('US');
            $table->string('target_language', 10)->default('en');
            $table->string('search_intent')->default('commercial'); // commercial, transactional, informational, navigational
            $table->string('topic_cluster')->nullable()->index();
            $table->unsignedInteger('search_volume')->nullable();
            $table->unsignedTinyInteger('difficulty')->nullable();
            $table->decimal('current_position', 5, 1)->nullable();
            $table->string('provider_source')->default('manual');
            $table->string('cannibalization_warning')->nullable();
            $table->timestamp('last_checked_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 7. Internal Links
        Schema::create('seo_internal_links', function (Blueprint $table) {
            $table->id();
            $table->string('source_url')->index();
            $table->string('target_url')->index();
            $table->string('anchor_text');
            $table->boolean('is_nofollow')->default(false);
            $table->unsignedSmallInteger('http_status')->default(200);
            $table->boolean('is_broken')->default(false)->index();
            $table->timestamps();
        });

        // 8. Schema Records (JSON-LD)
        Schema::create('seo_schema_records', function (Blueprint $table) {
            $table->id();
            $table->string('url_path')->index();
            $table->string('schema_type')->index(); // Organization, WebSite, Service, Article, LocalBusiness, BreadcrumbList
            $table->json('schema_json');
            $table->boolean('is_active')->default(true);
            $table->string('validation_status')->default('valid');
            $table->timestamps();
        });

        // 9. Hreflang & International SEO Mappings
        Schema::create('seo_hreflang_mappings', function (Blueprint $table) {
            $table->id();
            $table->string('source_url')->index();
            $table->string('locale', 20)->index(); // en-US, en-GB, en-CA, x-default
            $table->string('alternate_url');
            $table->boolean('is_reciprocal')->default(true);
            $table->timestamps();
        });

        // 10. Integrations & Credentials
        Schema::create('seo_integrations', function (Blueprint $table) {
            $table->id();
            $table->string('service_key')->unique()->index(); // gsc, ga4, pagespeed, google_business, openai
            $table->string('name');
            $table->boolean('is_connected')->default(false);
            $table->text('credentials')->nullable(); // encrypted JSON
            $table->string('property_id')->nullable();
            $table->timestamp('last_sync_at')->nullable();
            $table->text('last_error')->nullable();
            $table->json('settings')->nullable();
            $table->timestamps();
        });

        // 11. Search Metrics (Search Console)
        Schema::create('seo_search_metrics', function (Blueprint $table) {
            $table->id();
            $table->date('metric_date')->index();
            $table->string('query')->nullable()->index();
            $table->string('page_url')->nullable()->index();
            $table->string('country', 10)->nullable()->index();
            $table->string('device', 20)->nullable()->index();
            $table->unsignedInteger('clicks')->default(0);
            $table->unsignedInteger('impressions')->default(0);
            $table->decimal('ctr', 6, 4)->default(0);
            $table->decimal('average_position', 6, 2)->default(0);
            $table->timestamps();
        });

        // 12. Analytics Metrics (GA4)
        Schema::create('seo_analytics_metrics', function (Blueprint $table) {
            $table->id();
            $table->date('metric_date')->index();
            $table->string('landing_page')->index();
            $table->string('channel_group')->default('Organic Search')->index();
            $table->unsignedInteger('sessions')->default(0);
            $table->unsignedInteger('engaged_sessions')->default(0);
            $table->unsignedInteger('conversions')->default(0);
            $table->unsignedInteger('leads_generated')->default(0);
            $table->timestamps();
        });

        // 13. PageSpeed & Core Web Vitals
        Schema::create('seo_performance_reports', function (Blueprint $table) {
            $table->id();
            $table->string('url')->index();
            $table->string('device', 20)->default('mobile')->index(); // mobile, desktop
            $table->unsignedTinyInteger('performance_score');
            $table->decimal('lcp_seconds', 5, 2)->nullable();
            $table->unsignedInteger('inp_ms')->nullable();
            $table->decimal('cls_score', 6, 4)->nullable();
            $table->decimal('fcp_seconds', 5, 2)->nullable();
            $table->decimal('speed_index', 6, 2)->nullable();
            $table->json('field_data')->nullable();
            $table->json('opportunities')->nullable();
            $table->json('diagnostics')->nullable();
            $table->timestamp('tested_at');
            $table->timestamps();
        });

        // 14. AI Crawler Access Checks
        Schema::create('ai_crawler_checks', function (Blueprint $table) {
            $table->id();
            $table->string('crawler_name')->index(); // OAI-SearchBot, PerplexityBot, Google-Extended, GPTBot, CCBot, ClaudeBot, Applebot-Extended
            $table->string('crawler_type')->index(); // search_discovery, model_training
            $table->string('url_checked');
            $table->boolean('is_allowed_in_robots')->default(true);
            $table->unsignedSmallInteger('http_status')->default(200);
            $table->unsignedInteger('latency_ms')->default(0);
            $table->text('notes')->nullable();
            $table->timestamp('checked_at');
            $table->timestamps();
        });

        // 15. AI Citation Records
        Schema::create('ai_citation_records', function (Blueprint $table) {
            $table->id();
            $table->string('platform')->index(); // ChatGPT Search, Google AI Overviews, Gemini, Perplexity
            $table->string('query_tested');
            $table->date('test_date')->index();
            $table->boolean('brand_mentioned')->default(false);
            $table->boolean('citation_found')->default(false);
            $table->string('cited_url')->nullable();
            $table->text('evidence_text')->nullable();
            $table->string('evidence_url')->nullable();
            $table->string('verification_status')->default('unverified')->index(); // verified, unverified, rejected
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // 16. AI Referral Traffic Metrics
        Schema::create('ai_referral_metrics', function (Blueprint $table) {
            $table->id();
            $table->date('metric_date')->index();
            $table->string('ai_source')->index(); // chatgpt.com, perplexity.ai, claude.ai, gemini.google.com, copilot.microsoft.com
            $table->string('landing_page')->index();
            $table->unsignedInteger('referral_visits')->default(0);
            $table->unsignedInteger('leads_generated')->default(0);
            $table->timestamps();
        });

        // 17. SEO System Alerts
        Schema::create('seo_alerts', function (Blueprint $table) {
            $table->id();
            $table->string('severity')->index(); // critical, warning, info
            $table->string('title');
            $table->text('message');
            $table->string('category')->index();
            $table->boolean('is_read')->default(false)->index();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
        });

        // 18. Audit Logs for SEO Changes
        Schema::create('seo_audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('user_name');
            $table->string('action')->index();
            $table->string('entity_type')->index();
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });

        // 19. Automation Settings
        Schema::create('seo_automation_settings', function (Blueprint $table) {
            $table->id();
            $table->string('mode')->default('suggest_and_approve'); // audit_only, suggest_and_approve, safe_auto_fix
            $table->unsignedInteger('crawl_limit_pages')->default(100);
            $table->unsignedInteger('crawl_throttle_delay_ms')->default(200);
            $table->json('excluded_paths')->nullable();
            $table->string('alert_email')->nullable();
            $table->boolean('alert_on_critical')->default(true);
            $table->boolean('auto_sitemap_sync')->default(true);
            $table->timestamps();
        });

        // 20. Content Editorial Review Workflow
        Schema::create('content_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('content_type')->default('page'); // page, service, article, case_study
            $table->string('content_id');
            $table->string('title');
            $table->string('url_path')->index();
            $table->string('workflow_status')->default('published')->index(); // draft, review, approved, published, update_required
            $table->text('notes')->nullable();
            $table->string('submitted_by')->nullable();
            $table->string('reviewed_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_reviews');
        Schema::dropIfExists('seo_automation_settings');
        Schema::dropIfExists('seo_audit_logs');
        Schema::dropIfExists('seo_alerts');
        Schema::dropIfExists('ai_referral_metrics');
        Schema::dropIfExists('ai_citation_records');
        Schema::dropIfExists('ai_crawler_checks');
        Schema::dropIfExists('seo_performance_reports');
        Schema::dropIfExists('seo_analytics_metrics');
        Schema::dropIfExists('seo_search_metrics');
        Schema::dropIfExists('seo_integrations');
        Schema::dropIfExists('seo_hreflang_mappings');
        Schema::dropIfExists('seo_schema_records');
        Schema::dropIfExists('seo_internal_links');
        Schema::dropIfExists('seo_keyword_targets');
        Schema::dropIfExists('seo_recommendations');
        Schema::dropIfExists('seo_audit_findings');
        Schema::dropIfExists('seo_audits');
        Schema::dropIfExists('seo_redirects');
        Schema::dropIfExists('seo_metadata');
    }
};
