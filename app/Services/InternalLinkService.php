<?php

namespace App\Services;

use App\Models\SeoInternalLink;
use App\Models\SeoMetadata;
use DOMDocument;
use DOMXPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InternalLinkService
{
    /**
     * Scan and build internal link map across all published pages.
     */
    public function scanAndMapLinks(): array
    {
        $pages = SeoMetadata::where('is_published', true)->get();
        SeoInternalLink::truncate();

        $discoveredCount = 0;
        $brokenCount = 0;

        foreach ($pages as $page) {
            $path = $page->url_path;
            try {
                $req = Request::create($path, 'GET');
                $response = app()->handle($req);
                $html = $response->getContent() ?: '';
            } catch (\Throwable) {
                continue;
            }

            if (empty($html)) {
                continue;
            }

            libxml_use_internal_errors(true);
            $doc = new DOMDocument;
            $doc->loadHTML('<?xml encoding="utf-8" ?>'.$html, LIBXML_NOERROR | LIBXML_NOWARNING);
            $xpath = new DOMXPath($doc);
            libxml_clear_errors();

            $anchorNodes = $xpath->query('//a[@href]');
            foreach ($anchorNodes as $a) {
                $href = trim($a->getAttribute('href'));
                $text = trim($a->textContent);
                $rel = strtolower($a->getAttribute('rel'));
                $isNofollow = str_contains($rel, 'nofollow');

                if (empty($href) || str_starts_with($href, '#') || str_starts_with($href, 'javascript:') || str_starts_with($href, 'mailto:') || str_starts_with($href, 'tel:')) {
                    continue;
                }

                $targetPath = null;
                if (str_starts_with($href, '/')) {
                    $targetPath = $href;
                } elseif (str_starts_with($href, url('/'))) {
                    $targetPath = parse_url($href, PHP_URL_PATH) ?: '/';
                }

                if ($targetPath) {
                    $normalizedTarget = '/'.ltrim($targetPath, '/');

                    // Check if target is a valid known route or 404
                    $isBroken = false;
                    $targetMeta = SeoMetadata::where('url_path', $normalizedTarget)->first();
                    if (! $targetMeta && ! in_array($normalizedTarget, ['/login', '/register', '/dashboard', '/admin'])) {
                        $isBroken = true;
                        $brokenCount++;
                    }

                    SeoInternalLink::create([
                        'source_url' => $path,
                        'target_url' => $normalizedTarget,
                        'anchor_text' => mb_substr($text ?: '(Image or Icon Link)', 0, 190),
                        'is_nofollow' => $isNofollow,
                        'http_status' => $isBroken ? 404 : 200,
                        'is_broken' => $isBroken,
                    ]);

                    $discoveredCount++;
                }
            }
        }

        return [
            'total_links_found' => $discoveredCount,
            'broken_links_found' => $brokenCount,
        ];
    }

    /**
     * Identify orphan pages (published pages with 0 internal incoming links).
     */
    public function getOrphanPages(): array
    {
        $incomingTargets = SeoInternalLink::pluck('target_url')->unique()->toArray();

        return SeoMetadata::where('is_published', true)
            ->whereNotIn('url_path', ['/', ...$incomingTargets])
            ->get()
            ->toArray();
    }

    /**
     * Get anchor text distribution.
     */
    public function getAnchorTextDistribution(): array
    {
        return SeoInternalLink::select('anchor_text', DB::raw('count(*) as count'))
            ->groupBy('anchor_text')
            ->orderByDesc('count')
            ->take(15)
            ->pluck('count', 'anchor_text')
            ->toArray();
    }
}
