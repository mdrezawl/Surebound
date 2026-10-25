<?php

namespace App\Services;

use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\Http;

class SeoCrawlerService
{
    protected array $visitedUrls = [];

    protected array $crawledPages = [];

    /**
     * Validate whether a URL is safe to crawl (Strict SSRF protection).
     */
    public function isSafeUrl(string $url): bool
    {
        $parts = parse_url($url);
        if (! isset($parts['scheme'], $parts['host'])) {
            return false;
        }

        $scheme = strtolower($parts['scheme']);
        if (! in_array($scheme, ['http', 'https'])) {
            return false;
        }

        $host = strtolower($parts['host']);

        // Check for cloud metadata IP explicitly
        if ($host === '169.254.169.254' || str_contains($host, 'metadata.google.internal')) {
            return false;
        }

        // Explicitly reject localhost and loopback
        if ($host === 'localhost' || $host === '127.0.0.1' || str_ends_with($host, '.local') || str_ends_with($host, '.internal')) {
            return false;
        }

        // Resolve IP and check against private ranges
        $ip = gethostbyname($host);
        if (! filter_var($ip, FILTER_VALIDATE_IP)) {
            return false;
        }

        // Check if IP is in private or reserved ranges
        if (! filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            return false;
        }

        return true;
    }

    /**
     * Audit a single URL's HTML content and headers.
     */
    public function auditPage(string $url, string $html, int $statusCode, float $latencyMs = 0): array
    {
        $findings = [];

        // 1. HTTP Status Code Checks
        if ($statusCode >= 500) {
            $findings[] = [
                'category' => 'indexability',
                'severity' => 'critical',
                'issue_code' => 'server_error_'.$statusCode,
                'title' => "Server Error {$statusCode} on {$url}",
                'description' => "The server returned HTTP status {$statusCode}. Search engines cannot crawl or index pages with 5xx errors.",
                'evidence' => "HTTP status {$statusCode} detected.",
                'recommended_fix' => 'Check server application logs, database connections, and exception stack traces to resolve this fatal error.',
            ];
        } elseif ($statusCode === 404) {
            $findings[] = [
                'category' => 'indexability',
                'severity' => 'high',
                'issue_code' => 'not_found_404',
                'title' => "Broken Page (404 Not Found): {$url}",
                'description' => 'This URL returned a 404 Not Found response. Broken internal links degrade search engine indexability and bounce visitors.',
                'evidence' => 'HTTP 404 status.',
                'recommended_fix' => 'Restore the missing page, update referring links, or create a 301 permanent redirect in the Redirect Manager.',
            ];
        }

        if (empty($html) || $statusCode >= 400) {
            return [
                'url' => $url,
                'status_code' => $statusCode,
                'latency_ms' => $latencyMs,
                'findings' => $findings,
                'internal_links' => [],
            ];
        }

        // Parse DOM
        libxml_use_internal_errors(true);
        $doc = new DOMDocument;
        $doc->loadHTML('<?xml encoding="utf-8" ?>'.$html, LIBXML_NOERROR | LIBXML_NOWARNING);
        $xpath = new DOMXPath($doc);
        libxml_clear_errors();

        // 2. Title Checks
        $titleNodes = $xpath->query('//title');
        $title = $titleNodes->length > 0 ? trim($titleNodes->item(0)->textContent) : '';
        if (empty($title)) {
            $findings[] = [
                'category' => 'metadata',
                'severity' => 'critical',
                'issue_code' => 'missing_title',
                'title' => 'Missing Page Title Tag',
                'description' => 'The HTML document has no <title> tag. The title tag is one of the most critical on-page ranking signals.',
                'evidence' => 'No <title> found.',
                'recommended_fix' => 'Define a unique, compelling SEO title between 40 and 65 characters incorporating the target keyword.',
            ];
        } elseif (mb_strlen($title) < 20) {
            $findings[] = [
                'category' => 'metadata',
                'severity' => 'medium',
                'issue_code' => 'title_too_short',
                'title' => 'Title Tag is Too Short ('.mb_strlen($title).' chars)',
                'description' => 'Very short titles fail to fully describe the page content and miss opportunities for search queries.',
                'evidence' => "Current title: \"{$title}\"",
                'recommended_fix' => 'Expand the title to 40–60 characters with relevant brand and service keywords.',
            ];
        } elseif (mb_strlen($title) > 75) {
            $findings[] = [
                'category' => 'metadata',
                'severity' => 'low',
                'issue_code' => 'title_too_long',
                'title' => 'Title Tag Truncation Risk ('.mb_strlen($title).' chars)',
                'description' => 'Titles exceeding ~65 characters are often truncated in Google search result snippets.',
                'evidence' => "Current title: \"{$title}\"",
                'recommended_fix' => 'Shorten the title to under 65 characters to prevent truncation.',
            ];
        }

        // 3. Meta Description Checks
        $descNodes = $xpath->query('//meta[translate(@name, "DESCRIPTION", "description")="description"]/@content');
        $description = $descNodes->length > 0 ? trim($descNodes->item(0)->textContent) : '';
        if (empty($description)) {
            $findings[] = [
                'category' => 'metadata',
                'severity' => 'high',
                'issue_code' => 'missing_meta_description',
                'title' => 'Missing Meta Description',
                'description' => 'No meta description found. Search engines will generate arbitrary snippet text, potentially lowering click-through rates (CTR).',
                'evidence' => 'No description tag present.',
                'recommended_fix' => 'Provide a concise, persuasive meta description (120–160 characters) summarizing page benefits.',
            ];
        } elseif (mb_strlen($description) < 50) {
            $findings[] = [
                'category' => 'metadata',
                'severity' => 'low',
                'issue_code' => 'meta_description_too_short',
                'title' => 'Meta Description is Too Short ('.mb_strlen($description).' chars)',
                'description' => 'Short meta descriptions under 50 characters underutilize snippet space on Google search results.',
                'evidence' => "Current description: \"{$description}\"",
                'recommended_fix' => 'Elaborate on the value proposition up to 120–155 characters.',
            ];
        } elseif (mb_strlen($description) > 170) {
            $findings[] = [
                'category' => 'metadata',
                'severity' => 'low',
                'issue_code' => 'meta_description_too_long',
                'title' => 'Meta Description Truncation Risk ('.mb_strlen($description).' chars)',
                'description' => 'Descriptions longer than 160 characters are typically truncated by search engines.',
                'evidence' => 'Length: '.mb_strlen($description).' characters.',
                'recommended_fix' => 'Refine and trim the description to between 120 and 160 characters.',
            ];
        }

        // 4. Heading Structure (H1)
        $h1Nodes = $xpath->query('//h1');
        if ($h1Nodes->length === 0) {
            $findings[] = [
                'category' => 'headings',
                'severity' => 'high',
                'issue_code' => 'missing_h1',
                'title' => 'Missing Primary H1 Heading',
                'description' => 'The page lacks a main <h1> heading tag. H1 headings communicate the page primary topic to crawlers and screen readers.',
                'evidence' => '0 <h1> elements found.',
                'recommended_fix' => 'Add exactly one descriptive <h1> heading at the top of the main content.',
            ];
        } elseif ($h1Nodes->length > 1) {
            $findings[] = [
                'category' => 'headings',
                'severity' => 'medium',
                'issue_code' => 'multiple_h1',
                'title' => "Multiple H1 Headings Found ({$h1Nodes->length})",
                'description' => 'Having multiple <h1> elements dilutes topic authority and can confuse accessibility tree parsers.',
                'evidence' => "{$h1Nodes->length} <h1> tags detected.",
                'recommended_fix' => 'Maintain a single primary <h1> per page and structure subordinate sections with <h2> through <h4> tags.',
            ];
        }

        // 5. Image Alt Attributes
        $images = $xpath->query('//img');
        $missingAltCount = 0;
        foreach ($images as $img) {
            if (! $img->hasAttribute('alt') || trim($img->getAttribute('alt')) === '') {
                $missingAltCount++;
            }
        }
        if ($missingAltCount > 0) {
            $findings[] = [
                'category' => 'images',
                'severity' => 'medium',
                'issue_code' => 'images_missing_alt',
                'title' => "{$missingAltCount} Images Missing Alt Text",
                'description' => 'Images without descriptive alt text harm web accessibility (a11y) and forfeit Google Image Search discovery.',
                'evidence' => "{$missingAltCount} of {$images->length} images have missing or empty alt tags.",
                'recommended_fix' => 'Add meaningful, contextual alt descriptions to all non-decorative images.',
            ];
        }

        // 6. Meta Robots Directives
        $robotsNodes = $xpath->query('//meta[translate(@name, "ROBOTS", "robots")="robots"]/@content');
        if ($robotsNodes->length > 0) {
            $robotsVal = strtolower($robotsNodes->item(0)->textContent);
            if (str_contains($robotsVal, 'noindex')) {
                $findings[] = [
                    'category' => 'indexability',
                    'severity' => 'high',
                    'issue_code' => 'noindex_directive_present',
                    'title' => 'Page Contains Noindex Directive',
                    'description' => 'A meta robots "noindex" tag instructs search engines NOT to show this page in organic search results.',
                    'evidence' => "meta robots=\"{$robotsVal}\"",
                    'recommended_fix' => 'Remove the "noindex" directive if this page is intended for public organic search visibility.',
                ];
            }
        }

        // 7. Canonical URL
        $canonicalNodes = $xpath->query('//link[translate(@rel, "CANONICAL", "canonical")="canonical"]/@href');
        if ($canonicalNodes->length === 0) {
            $findings[] = [
                'category' => 'metadata',
                'severity' => 'medium',
                'issue_code' => 'missing_canonical',
                'title' => 'Missing Canonical URL Link',
                'description' => 'The page does not specify a canonical link tag, risking duplicate content confusion across parameter variations.',
                'evidence' => 'No <link rel="canonical"> found.',
                'recommended_fix' => 'Add a self-referencing canonical URL tag to consolidate ranking signals.',
            ];
        }

        // 8. Structured Data JSON-LD
        $schemaNodes = $xpath->query('//script[@type="application/ld+json"]');
        if ($schemaNodes->length === 0) {
            $findings[] = [
                'category' => 'schema',
                'severity' => 'medium',
                'issue_code' => 'missing_schema',
                'title' => 'No Structured Data (JSON-LD) Detected',
                'description' => 'Structured schema markup enables rich results in Google and aids entity comprehension for AI Search engines.',
                'evidence' => '0 application/ld+json blocks.',
                'recommended_fix' => 'Add appropriate Organization, Service, WebSite, or Article JSON-LD markup.',
            ];
        }

        // 9. Discover Internal Links
        $links = $xpath->query('//a/@href');
        $internalLinks = [];
        foreach ($links as $link) {
            $href = trim($link->textContent);
            if (empty($href) || str_starts_with($href, '#') || str_starts_with($href, 'javascript:') || str_starts_with($href, 'mailto:') || str_starts_with($href, 'tel:')) {
                continue;
            }
            if (str_starts_with($href, '/') || str_starts_with($href, url('/'))) {
                $path = '/'.ltrim(parse_url($href, PHP_URL_PATH) ?: '/', '/');
                if (! in_array($path, $internalLinks)) {
                    $internalLinks[] = $path;
                }
            }
        }

        return [
            'url' => $url,
            'title' => $title,
            'meta_description' => $description,
            'status_code' => $statusCode,
            'latency_ms' => $latencyMs,
            'findings' => $findings,
            'internal_links' => $internalLinks,
        ];
    }
}
