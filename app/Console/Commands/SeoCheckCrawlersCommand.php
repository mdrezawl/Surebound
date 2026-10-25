<?php

namespace App\Console\Commands;

use App\Services\AiSearchService;
use Illuminate\Console\Command;

class SeoCheckCrawlersCommand extends Command
{
    protected $signature = 'seo:check-crawlers';

    protected $description = 'Audit robots.txt directives and accessibility for Googlebot and AI Search crawlers';

    public function handle(AiSearchService $aiService): int
    {
        $this->info('Evaluating robots.txt accessibility for search discovery & model training crawlers...');

        $results = $aiService->checkCrawlerPermissions();

        $rows = [];
        foreach ($results as $item) {
            $crawler = $item['crawler'];
            $rows[] = [
                $crawler['name'],
                $crawler['operator'],
                ucwords(str_replace('_', ' ', $crawler['type'])),
                $item['is_allowed'] ? '<info>Allowed (Accessible)</info>' : '<comment>Blocked (Disallow)</comment>',
                $crawler['recommended_policy'],
            ];
        }

        $this->table(
            ['Crawler User-Agent', 'Operator', 'Category', 'Directives Status', 'Recommended Policy'],
            $rows
        );

        return self::SUCCESS;
    }
}
