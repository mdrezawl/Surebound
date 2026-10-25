<?php

namespace App\Console\Commands;

use App\Services\PageSpeedService;
use Illuminate\Console\Command;

class SeoCheckPerformanceCommand extends Command
{
    protected $signature = 'seo:check-performance {url? : Target URL to test (defaults to homepage)} {--strategy=mobile : Device strategy: mobile or desktop}';

    protected $description = 'Run Google PageSpeed Insights test and Core Web Vitals audit';

    public function handle(PageSpeedService $pageSpeedService): int
    {
        $url = $this->argument('url') ?: url('/');
        $strategy = (string) $this->option('strategy');

        $this->info("Analyzing Core Web Vitals for [{$url}] ({$strategy})...");

        $result = $pageSpeedService->runTest($url, $strategy, true);
        $report = $result['report'];

        $this->table(
            ['Metric', 'Measured Value', 'Assessment'],
            [
                ['Lighthouse Performance Score', "{$report->performance_score} / 100", $report->performance_score >= 90 ? '<info>Good</info>' : '<comment>Needs Work</comment>'],
                ['Largest Contentful Paint (LCP)', "{$report->lcp_seconds}s", $report->lcp_seconds <= 2.5 ? '<info>Good (<= 2.5s)</info>' : '<comment>Slow</comment>'],
                ['Interaction to Next Paint / TBT', "{$report->inp_ms}ms", $report->inp_ms <= 200 ? '<info>Good (<= 200ms)</info>' : '<comment>High</comment>'],
                ['Cumulative Layout Shift (CLS)', $report->cls_score, $report->cls_score <= 0.1 ? '<info>Good (<= 0.1)</info>' : '<comment>Shift Detected</comment>'],
                ['First Contentful Paint (FCP)', "{$report->fcp_seconds}s", $report->fcp_seconds <= 1.8 ? '<info>Good</info>' : '<comment>Slow</comment>'],
                ['Speed Index', "{$report->speed_index}s", 'Lab Diagnostic'],
            ]
        );

        return self::SUCCESS;
    }
}
