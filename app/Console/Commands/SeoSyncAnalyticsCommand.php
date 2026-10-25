<?php

namespace App\Console\Commands;

use App\Services\GoogleAnalytics4Service;
use Illuminate\Console\Command;

class SeoSyncAnalyticsCommand extends Command
{
    protected $signature = 'seo:sync-analytics {--days=28 : Days of historical analytics to sync}';

    protected $description = 'Synchronize organic sessions and conversion data from Google Analytics 4';

    public function handle(GoogleAnalytics4Service $ga4Service): int
    {
        $days = (int) $this->option('days');
        $this->info("Fetching GA4 organic traffic summary ({$days} days)...");

        $summary = $ga4Service->getAnalyticsSummary($days);

        $this->table(
            ['Metric', 'Value'],
            [
                ['GA4 Status', $summary['is_connected'] ? 'Connected' : 'Disconnected'],
                ['Organic Sessions', number_format($summary['organic_sessions'])],
                ['Engaged Sessions', number_format($summary['engaged_sessions'])],
                ['Engagement Rate', "{$summary['engagement_rate']}%"],
                ['Total Leads Generated', number_format($summary['database_leads'])],
                ['Conversion Rate', "{$summary['conversion_rate']}%"],
            ]
        );

        $this->comment($summary['status_message']);

        return self::SUCCESS;
    }
}
