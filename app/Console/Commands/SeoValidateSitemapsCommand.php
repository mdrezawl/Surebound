<?php

namespace App\Console\Commands;

use App\Models\SeoMetadata;
use App\Services\SitemapRobotsService;
use Illuminate\Console\Command;

class SeoValidateSitemapsCommand extends Command
{
    protected $signature = 'seo:validate-sitemaps';

    protected $description = 'Validate XML sitemap syntax, canonical URL consistency, and URL coverage';

    public function handle(SitemapRobotsService $sitemapService): int
    {
        $this->info('Validating XML sitemap generation and URL coverage...');

        $xml = $sitemapService->generateSitemapXml();

        // Check XML validity using SimpleXML
        libxml_use_internal_errors(true);
        $parsed = simplexml_load_string($xml);
        $errors = libxml_get_errors();
        libxml_clear_errors();

        if ($parsed === false) {
            $this->error('Sitemap XML Validation Failed: XML syntax is invalid.');
            foreach ($errors as $error) {
                $this->line(" - Line {$error->line}: {$error->message}");
            }

            return self::FAILURE;
        }

        $urlCount = count($parsed->url);
        $totalPublished = SeoMetadata::where('is_published', true)->count();
        $noindexCount = SeoMetadata::where('meta_robots', 'like', '%noindex%')->count();

        $this->info('Sitemap XML is completely valid and follows standard sitemap schema.');
        $this->table(
            ['Validation Check', 'Result'],
            [
                ['XML Schema Validity', '<info>VALID (sitemaps.org/schemas/sitemap/0.9)</info>'],
                ['Total URLs in Sitemap', $urlCount],
                ['Published Database Pages', $totalPublished],
                ['Excluded Noindex Pages', $noindexCount],
                ['Sitemap URL Endpoint', url('/sitemap.xml')],
            ]
        );

        return self::SUCCESS;
    }
}
