<?php

namespace App\Services;

use App\Models\SeoAlert;
use App\Models\SeoAudit;
use App\Models\SeoAuditFinding;
use App\Models\SeoAuditLog;
use App\Models\SeoAutomationSetting;
use App\Models\SeoMetadata;
use App\Models\SeoRecommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeoAuditService
{
    public function __construct(
        protected SeoCrawlerService $crawler,
        protected SeoService $seoService
    ) {}

    /**
     * Run a comprehensive technical SEO audit across all eligible website routes.
     */
    public function runFullAudit(?int $triggeredBy = null): SeoAudit
    {
        $startTime = microtime(true);

        $audit = SeoAudit::create([
            'audit_type' => $triggeredBy ? 'manual' : 'scheduled',
            'status' => 'running',
            'pages_scanned' => 0,
            'critical_count' => 0,
            'high_count' => 0,
            'medium_count' => 0,
            'low_count' => 0,
            'info_count' => 0,
            'health_score' => 100,
            'triggered_by' => $triggeredBy,
        ]);

        $settings = SeoAutomationSetting::getGlobal();
        $limit = $settings->crawl_limit_pages ?: 100;

        // Ensure default metadata exists in database first
        $this->seoService->ensureDefaultMetadata();

        $routesToAudit = SeoService::getDefaultPages();
        $scannedCount = 0;
        $criticalCount = 0;
        $highCount = 0;
        $mediumCount = 0;
        $lowCount = 0;
        $infoCount = 0;

        foreach ($routesToAudit as $pageInfo) {
            if ($scannedCount >= $limit) {
                break;
            }

            $path = $pageInfo['url_path'];
            $fullUrl = url($path);

            $pageStart = microtime(true);
            try {
                // Internal sub-request dispatch for high performance and reliability
                $req = Request::create($path, 'GET');
                $response = app()->handle($req);
                $html = $response->getContent() ?: '';
                $statusCode = $response->getStatusCode();
                $latencyMs = round((microtime(true) - $pageStart) * 1000, 2);
            } catch (\Throwable $e) {
                $html = '';
                $statusCode = 500;
                $latencyMs = round((microtime(true) - $pageStart) * 1000, 2);
            }

            $auditResult = $this->crawler->auditPage($fullUrl, $html, $statusCode, $latencyMs);
            $scannedCount++;

            foreach ($auditResult['findings'] as $item) {
                $finding = SeoAuditFinding::create([
                    'audit_id' => $audit->id,
                    'url' => $item['url'] ?? $fullUrl,
                    'category' => $item['category'],
                    'severity' => $item['severity'],
                    'issue_code' => $item['issue_code'],
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'evidence' => $item['evidence'] ?? null,
                    'recommended_fix' => $item['recommended_fix'],
                    'status' => 'open',
                ]);

                // Generate actionable recommendation
                $this->createRecommendationForFinding($finding, $pageInfo);

                // Increment severity counts
                match ($item['severity']) {
                    'critical' => $criticalCount++,
                    'high' => $highCount++,
                    'medium' => $mediumCount++,
                    'low' => $lowCount++,
                    default => $infoCount++,
                };
            }
        }

        // Calculate dynamic health score
        // Base 100 with weighted deductions
        $deductions = ($criticalCount * 12) + ($highCount * 5) + ($mediumCount * 2) + ($lowCount * 0.5);
        $healthScore = (int) max(10, min(100, round(100 - $deductions)));
        $durationSeconds = round(microtime(true) - $startTime, 2);

        $summary = "Audited {$scannedCount} pages in {$durationSeconds}s. Found {$criticalCount} critical, {$highCount} high, {$mediumCount} medium, {$lowCount} low issues. Health score: {$healthScore}/100.";

        $audit->update([
            'status' => 'completed',
            'pages_scanned' => $scannedCount,
            'critical_count' => $criticalCount,
            'high_count' => $highCount,
            'medium_count' => $mediumCount,
            'low_count' => $lowCount,
            'info_count' => $infoCount,
            'health_score' => $healthScore,
            'duration_seconds' => $durationSeconds,
            'summary' => $summary,
        ]);

        // Create alert if critical issues discovered
        if ($criticalCount > 0) {
            SeoAlert::create([
                'severity' => 'critical',
                'title' => "Technical SEO Alert: {$criticalCount} Critical Issues Detected",
                'message' => "The latest audit on {$scannedCount} pages identified {$criticalCount} critical issues requiring attention.",
                'category' => 'audit',
            ]);
        }

        SeoAuditLog::log('audit_completed', 'seo_audits', $audit->id, null, [
            'pages_scanned' => $scannedCount,
            'health_score' => $healthScore,
            'critical' => $criticalCount,
        ]);

        return $audit;
    }

    /**
     * Generate deterministic recommendations based on audit findings.
     */
    protected function createRecommendationForFinding(SeoAuditFinding $finding, array $pageInfo): void
    {
        $requiresApproval = true;
        $suggestedValue = null;
        $currentValue = null;
        $impact = 'medium';
        $effort = 'quick';
        $confidence = 90;

        switch ($finding->issue_code) {
            case 'missing_title':
                $suggestedValue = $pageInfo['seo_title'] ?? 'Surebound Insurance – Quality Protection';
                $impact = 'high';
                $requiresApproval = false; // Safe template fill
                break;
            case 'missing_meta_description':
                $suggestedValue = $pageInfo['meta_description'] ?? 'Dependable insurance coverage built around you with dedicated 24/7 support.';
                $impact = 'high';
                $requiresApproval = false; // Safe template fill
                break;
            case 'missing_canonical':
                $suggestedValue = url($pageInfo['url_path']);
                $impact = 'medium';
                $requiresApproval = true;
                break;
            case 'images_missing_alt':
                $suggestedValue = 'Contextual description: "Surebound Insurance underwriting and client support team"';
                $impact = 'medium';
                $effort = 'moderate';
                break;
            case 'multiple_h1':
                $suggestedValue = 'Consolidate section headers into <h2> elements and keep single <h1>';
                $impact = 'medium';
                $effort = 'moderate';
                break;
            default:
                $suggestedValue = $finding->recommended_fix;
        }

        SeoRecommendation::create([
            'finding_id' => $finding->id,
            'url' => $finding->url,
            'title' => 'Resolve: '.$finding->title,
            'category' => $finding->category,
            'impact' => $impact,
            'confidence' => $confidence,
            'estimated_effort' => $effort,
            'requires_human_approval' => $requiresApproval,
            'status' => 'pending',
            'current_value' => $currentValue,
            'suggested_value' => $suggestedValue,
        ]);
    }

    /**
     * Apply a safe automated fix for a recommendation.
     */
    public function applyFix(int $recommendationId): array
    {
        $rec = SeoRecommendation::findOrFail($recommendationId);

        if ($rec->status === 'applied') {
            return ['success' => false, 'message' => 'Recommendation has already been applied.'];
        }

        $urlPath = '/'.ltrim(parse_url($rec->url, PHP_URL_PATH) ?: '/', '/');
        $meta = SeoMetadata::where('url_path', $urlPath)->first();

        return DB::transaction(function () use ($rec, $meta, $urlPath) {
            $oldValues = $meta ? $meta->toArray() : null;

            if ($rec->category === 'metadata') {
                if (str_contains($rec->title, 'Title')) {
                    if ($meta) {
                        $meta->update(['seo_title' => $rec->suggested_value]);
                    }
                } elseif (str_contains($rec->title, 'Description')) {
                    if ($meta) {
                        $meta->update(['meta_description' => $rec->suggested_value]);
                    }
                } elseif (str_contains($rec->title, 'Canonical')) {
                    if ($meta) {
                        $meta->update(['canonical_url' => $rec->suggested_value]);
                    }
                }
            }

            $rec->update([
                'status' => 'applied',
                'applied_at' => now(),
            ]);

            if ($rec->finding) {
                $rec->finding->update([
                    'status' => 'auto_fixed',
                    'resolved_at' => now(),
                ]);
            }

            SeoAuditLog::log('recommendation_applied', 'seo_recommendations', $rec->id, $oldValues, [
                'applied_value' => $rec->suggested_value,
                'url' => $urlPath,
            ]);

            return ['success' => true, 'message' => "Recommendation #{$rec->id} applied successfully."];
        });
    }

    /**
     * Roll back an applied fix.
     */
    public function rollbackFix(int $recommendationId): array
    {
        $rec = SeoRecommendation::findOrFail($recommendationId);

        if ($rec->status !== 'applied') {
            return ['success' => false, 'message' => 'Only applied recommendations can be rolled back.'];
        }

        $urlPath = '/'.ltrim(parse_url($rec->url, PHP_URL_PATH) ?: '/', '/');
        $meta = SeoMetadata::where('url_path', $urlPath)->first();

        return DB::transaction(function () use ($rec, $meta) {
            if ($meta && $rec->current_value !== null) {
                if (str_contains($rec->title, 'Title')) {
                    $meta->update(['seo_title' => $rec->current_value]);
                } elseif (str_contains($rec->title, 'Description')) {
                    $meta->update(['meta_description' => $rec->current_value]);
                }
            }

            $rec->update([
                'status' => 'rolled_back',
            ]);

            if ($rec->finding) {
                $rec->finding->update([
                    'status' => 'open',
                    'resolved_at' => null,
                ]);
            }

            SeoAuditLog::log('recommendation_rolled_back', 'seo_recommendations', $rec->id, [
                'rolled_back_from' => $rec->suggested_value,
            ], [
                'status' => 'rolled_back',
            ]);

            return ['success' => true, 'message' => "Recommendation #{$rec->id} rolled back successfully."];
        });
    }
}
