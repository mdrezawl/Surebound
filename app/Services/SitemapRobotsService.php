<?php

namespace App\Services;

use App\Models\ApiSetting;
use App\Models\SeoAuditLog;
use App\Models\SeoMetadata;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class SitemapRobotsService
{
    /**
     * Generate standard XML Sitemap string.
     */
    public function generateSitemapXml(): string
    {
        $urls = [];

        try {
            if (Schema::hasTable('seo_metadata')) {
                $pages = SeoMetadata::where('is_published', true)
                    ->where(function ($q) {
                        $q->whereNull('meta_robots')
                            ->orWhere('meta_robots', 'not like', '%noindex%');
                    })
                    ->get();

                foreach ($pages as $page) {
                    $loc = $page->canonical_url ?: url($page->url_path);
                    $priority = '0.8';
                    if ($page->url_path === '/') {
                        $priority = '1.0';
                    } elseif (in_array($page->url_path, ['/home-insurance', '/auto-insurance', '/commercial-auto-insurance', '/business-insurance', '/surety-bond'])) {
                        $priority = '0.9';
                    } elseif (in_array($page->url_path, ['/privacy', '/terms'])) {
                        $priority = '0.3';
                    }

                    $urls[] = [
                        'loc' => $loc,
                        'lastmod' => $page->updated_at ? $page->updated_at->format('Y-m-d') : date('Y-m-d'),
                        'changefreq' => $page->url_path === '/' ? 'daily' : 'weekly',
                        'priority' => $priority,
                    ];
                }
            }
        } catch (\Throwable) {
            // fallback if db error
        }

        // If no database pages, fallback to default public routes
        if (empty($urls)) {
            $defaultPages = SeoService::getDefaultPages();
            foreach ($defaultPages as $page) {
                $urls[] = [
                    'loc' => url($page['url_path']),
                    'lastmod' => date('Y-m-d'),
                    'changefreq' => $page['url_path'] === '/' ? 'daily' : 'weekly',
                    'priority' => $page['url_path'] === '/' ? '1.0' : '0.8',
                ];
            }
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.PHP_EOL;

        foreach ($urls as $item) {
            $xml .= '  <url>'.PHP_EOL;
            $xml .= '    <loc>'.htmlspecialchars($item['loc'], ENT_XML1, 'UTF-8').'</loc>'.PHP_EOL;
            $xml .= '    <lastmod>'.$item['lastmod'].'</lastmod>'.PHP_EOL;
            $xml .= '    <changefreq>'.$item['changefreq'].'</changefreq>'.PHP_EOL;
            $xml .= '    <priority>'.$item['priority'].'</priority>'.PHP_EOL;
            $xml .= '  </url>'.PHP_EOL;
        }

        $xml .= '</urlset>';

        return $xml;
    }

    /**
     * Get active robots.txt content.
     */
    public function getRobotsTxtContent(): string
    {
        $setting = ApiSetting::where('key', 'seo_robots_txt')->first();
        if ($setting && ! empty($setting->value['content'])) {
            return $setting->value['content'];
        }

        $publicFile = public_path('robots.txt');
        if (File::exists($publicFile) && filesize($publicFile) > 25) {
            return File::get($publicFile);
        }

        return $this->getDefaultRobotsTxt();
    }

    /**
     * Default recommended robots.txt content with search discovery and crawler policies.
     */
    public function getDefaultRobotsTxt(): string
    {
        $sitemapUrl = url('/sitemap.xml');

        return <<<TXT
# Surebound Insurance – Advanced Robots Directives
# Preserves search discovery while protecting private administrative routes

User-agent: *
Disallow: /admin/
Disallow: /dashboard/
Disallow: /login
Disallow: /register
Disallow: /setup/
Disallow: /api/
Allow: /

# Googlebot Search Discovery
User-agent: Googlebot
Disallow: /admin/
Disallow: /dashboard/
Allow: /

# AI Search Engine Discovery (Allowed for ChatGPT Search & Perplexity)
User-agent: OAI-SearchBot
Disallow: /admin/
Disallow: /dashboard/
Allow: /

User-agent: PerplexityBot
Disallow: /admin/
Disallow: /dashboard/
Allow: /

# Model Training Crawlers (Configured separately from Search Discovery)
User-agent: GPTBot
Disallow: /admin/
Disallow: /dashboard/
Allow: /

# Sitemaps
Sitemap: {$sitemapUrl}
TXT;
    }

    /**
     * Validate and save robots.txt.
     */
    public function saveRobotsTxt(string $content, ?string $changeNote = null): array
    {
        // Safety validation: prevent blocking all search discovery unintentionally
        if (preg_match('/User-agent:\s*\*\s*\nDisallow:\s*\/\s*(\n|$)/i', $content) &&
            ! preg_match('/Allow:\s*\//i', $content)) {
            return [
                'success' => false,
                'message' => 'Safety Warning: The submitted robots.txt blocks all search crawlers from the root directory. To protect organic visibility, root Disallow is rejected.',
            ];
        }

        // Store history before update
        $oldSetting = ApiSetting::where('key', 'seo_robots_txt')->first();
        $history = $oldSetting?->value['history'] ?? [];
        if ($oldSetting && ! empty($oldSetting->value['content'])) {
            array_unshift($history, [
                'content' => $oldSetting->value['content'],
                'saved_at' => now()->toIso8601String(),
                'saved_by' => auth()->user()?->name ?? 'System',
                'note' => $changeNote ?: 'Updated robots directives',
            ]);
            $history = array_slice($history, 0, 10); // Keep last 10 revisions
        }

        ApiSetting::updateOrCreate(
            ['key' => 'seo_robots_txt'],
            [
                'value' => [
                    'content' => $content,
                    'updated_at' => now()->toIso8601String(),
                    'updated_by' => auth()->user()?->name ?? 'System',
                    'history' => $history,
                ],
            ]
        );

        // Sync to public/robots.txt file as well
        try {
            File::put(public_path('robots.txt'), $content);
        } catch (\Throwable) {
            // Non-fatal if filesystem is read-only in certain serverless environments
        }

        SeoAuditLog::log('robots_txt_updated', 'robots_txt', null, [
            'previous' => $oldSetting?->value['content'] ?? null,
        ], [
            'new' => $content,
            'note' => $changeNote,
        ]);

        return [
            'success' => true,
            'message' => 'Robots.txt updated successfully and synced to server.',
        ];
    }
}
