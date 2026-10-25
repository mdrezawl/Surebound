<?php

namespace App\Console\Commands;

use App\Services\GoogleSearchConsoleService;
use Illuminate\Console\Command;

class SeoSyncSearchConsoleCommand extends Command
{
    protected $signature = 'seo:sync-search-console {--days=28 : Days of historical analytics to sync}';

    protected $description = 'Synchronize search analytics performance data from Google Search Console';

    public function handle(GoogleSearchConsoleService $gscService): int
    {
        $days = (string) $this->option('days');
        $this->info("Synchronizing Google Search Console analytics ({$days} days)...");

        $result = $gscService->syncSearchAnalytics($days);

        if ($result['success']) {
            $this->info($result['message']);

            return self::SUCCESS;
        }

        $this->warn($result['message']);

        return self::SUCCESS;
    }
}
