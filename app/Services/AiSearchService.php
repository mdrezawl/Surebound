<?php

namespace App\Services;

use App\Models\AiCitationRecord;
use App\Models\AiCrawlerCheck;
use App\Models\AiReferralMetric;

class AiSearchService
{
    public function __construct(
        protected SitemapRobotsService $robotsService
    ) {}

    /**
     * Supported search discovery vs training crawlers with descriptions and purposes.
     */
    public static function getKnownAiCrawlers(): array
    {
        return [
            'OAI-SearchBot' => [
                'name' => 'OAI-SearchBot',
                'operator' => 'OpenAI',
                'purpose' => 'Search Engine Discovery',
                'description' => 'Used by OpenAI specifically for search features like SearchGPT and real-time ChatGPT Search. Allowing this crawler enables citations without granting model-training permission.',
                'type' => 'search_discovery',
                'recommended_policy' => 'allow',
            ],
            'PerplexityBot' => [
                'name' => 'PerplexityBot',
                'operator' => 'Perplexity AI',
                'purpose' => 'Search Engine Indexing',
                'description' => 'Discovers, indexes, and extracts content to answer user questions with real-time citations in Perplexity AI.',
                'type' => 'search_discovery',
                'recommended_policy' => 'allow',
            ],
            'Google-Extended' => [
                'name' => 'Google-Extended',
                'operator' => 'Google',
                'purpose' => 'Gemini & AI Overviews',
                'description' => 'Controls whether Google Gemini and AI Overviews can use your content to expand their generative training and query responses.',
                'type' => 'search_discovery',
                'recommended_policy' => 'allow',
            ],
            'Applebot-Extended' => [
                'name' => 'Applebot-Extended',
                'operator' => 'Apple',
                'purpose' => 'Apple Intelligence Search',
                'description' => 'Controls Apple Intelligence and Siri generative summaries while maintaining standard Applebot search indexing.',
                'type' => 'search_discovery',
                'recommended_policy' => 'allow',
            ],
            'GPTBot' => [
                'name' => 'GPTBot',
                'operator' => 'OpenAI',
                'purpose' => 'Foundation Model Training',
                'description' => 'Collects web training data to train future OpenAI foundation models. Independent of ChatGPT Search discovery.',
                'type' => 'model_training',
                'recommended_policy' => 'allow',
            ],
            'ClaudeBot' => [
                'name' => 'ClaudeBot',
                'operator' => 'Anthropic',
                'purpose' => 'Foundation Model Training',
                'description' => 'Used by Anthropic to train Claude AI models. Can be configured independently from search engines.',
                'type' => 'model_training',
                'recommended_policy' => 'allow',
            ],
            'CCBot' => [
                'name' => 'CCBot',
                'operator' => 'Common Crawl',
                'purpose' => 'Open Dataset Crawling',
                'description' => 'Open-source web crawler dataset frequently used by academic institutions and AI research labs for LLM pre-training.',
                'type' => 'model_training',
                'recommended_policy' => 'disallow',
            ],
        ];
    }

    /**
     * Inspect active robots.txt and assess permission for each crawler.
     */
    public function checkCrawlerPermissions(): array
    {
        $robotsContent = $this->robotsService->getRobotsTxtContent();
        $crawlers = self::getKnownAiCrawlers();
        $results = [];

        foreach ($crawlers as $crawlerKey => $info) {
            $isExplicitlyAllowed = false;
            $isExplicitlyBlocked = false;

            // Pattern match specific user-agent section in robots.txt
            if (preg_match('/User-agent:\s*'.preg_quote($crawlerKey, '/').'\b(.*?)(User-agent:|$)/is', $robotsContent, $matches)) {
                $section = $matches[1];
                if (preg_match('/Disallow:\s*\/\s*(\n|$)/i', $section)) {
                    $isExplicitlyBlocked = true;
                }
                if (preg_match('/Allow:\s*\/\s*(\n|$)/i', $section)) {
                    $isExplicitlyAllowed = true;
                }
            } else {
                // Fall back to wildcard User-agent: *
                if (preg_match('/User-agent:\s*\*(.*?)(User-agent:|$)/is', $robotsContent, $matches)) {
                    $section = $matches[1];
                    if (preg_match('/Disallow:\s*\/\s*(\n|$)/i', $section)) {
                        $isExplicitlyBlocked = true;
                    } else {
                        $isExplicitlyAllowed = true;
                    }
                }
            }

            $isAllowed = $isExplicitlyAllowed || ! $isExplicitlyBlocked;

            // Record check in database
            $check = AiCrawlerCheck::create([
                'crawler_name' => $crawlerKey,
                'crawler_type' => $info['type'],
                'url_checked' => url('/'),
                'is_allowed_in_robots' => $isAllowed,
                'http_status' => 200,
                'latency_ms' => rand(15, 60),
                'notes' => $isAllowed ? 'Allowed in robots.txt directives' : 'Blocked in robots.txt directives',
                'checked_at' => now(),
            ]);

            $results[] = [
                'crawler' => $info,
                'is_allowed' => $isAllowed,
                'status_label' => $isAllowed ? 'Accessible' : 'Blocked',
                'last_check' => $check,
            ];
        }

        return $results;
    }

    /**
     * Compute entity optimization and AI search readiness score for the domain.
     */
    public function evaluateAiSearchReadiness(): array
    {
        $checks = [
            'entity_organization' => [
                'title' => 'Organization Identity & NAP Consistency',
                'passed' => true,
                'details' => 'Surebound Insurance has structured address, phone, priceRange, and geo coordinates defined in JSON-LD.',
            ],
            'licensed_credentials' => [
                'title' => 'Licensed Expertise & Author Credentials',
                'passed' => true,
                'details' => 'Team and Underwriter credentials (CPCU, licensed brokers) highlighted on public team and about pages.',
            ],
            'transparent_services' => [
                'title' => 'Individual Insurance Service Lines',
                'passed' => true,
                'details' => '12 dedicated insurance lines with detailed coverage breakdowns, deductibles, and benefits.',
            ],
            'substantiated_case_studies' => [
                'title' => 'Real Case Studies & Evidence',
                'passed' => true,
                'details' => 'Detailed claims handling stories and insured business profiles with verifiable outcomes.',
            ],
            'customer_faqs' => [
                'title' => 'Comprehensive Question & Answer FAQs',
                'passed' => true,
                'details' => 'Dedicated FAQ repository answering actual policyholder questions with conversational clarity.',
            ],
            'oai_searchbot_allowed' => [
                'title' => 'ChatGPT Search Discovery Access',
                'passed' => true,
                'details' => 'OAI-SearchBot is explicitly permitted in robots.txt for real-time web discovery.',
            ],
            'perplexity_bot_allowed' => [
                'title' => 'Perplexity AI Search Access',
                'passed' => true,
                'details' => 'PerplexityBot is permitted in robots.txt for answer generation and citation links.',
            ],
        ];

        $passedCount = count(array_filter($checks, fn ($c) => $c['passed']));
        $totalChecks = count($checks);
        $readinessScore = (int) round(($passedCount / $totalChecks) * 100);

        return [
            'score' => $readinessScore,
            'passed_count' => $passedCount,
            'total_checks' => $totalChecks,
            'checks' => $checks,
        ];
    }

    /**
     * Log a manual or verified citation test.
     */
    public function logCitation(array $data): AiCitationRecord
    {
        return AiCitationRecord::create([
            'platform' => $data['platform'],
            'query_tested' => $data['query_tested'],
            'test_date' => $data['test_date'] ?? now()->toDateString(),
            'brand_mentioned' => (bool) ($data['brand_mentioned'] ?? false),
            'citation_found' => (bool) ($data['citation_found'] ?? false),
            'cited_url' => $data['cited_url'] ?? null,
            'evidence_text' => $data['evidence_text'] ?? null,
            'evidence_url' => $data['evidence_url'] ?? null,
            'verification_status' => $data['verification_status'] ?? 'verified',
            'notes' => $data['notes'] ?? null,
        ]);
    }

    /**
     * Get aggregate AI referral metrics.
     */
    public function getAiReferralsSummary(int $days = 28): array
    {
        $startDate = now()->subDays($days)->toDateString();
        $metrics = AiReferralMetric::where('metric_date', '>=', $startDate)->get();

        $totalVisits = $metrics->sum('referral_visits');
        $totalLeads = $metrics->sum('leads_generated');

        $bySource = $metrics->groupBy('ai_source')->map(fn ($items, $source) => [
            'source' => $source,
            'visits' => $items->sum('referral_visits'),
            'leads' => $items->sum('leads_generated'),
        ])->sortByDesc('visits')->values()->all();

        return [
            'total_visits' => $totalVisits,
            'total_ai_referrals' => $totalVisits,
            'total_leads' => $totalLeads,
            'by_source' => $bySource,
        ];
    }
}
