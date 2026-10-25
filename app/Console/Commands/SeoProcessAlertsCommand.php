<?php

namespace App\Console\Commands;

use App\Models\SeoAlert;
use App\Models\SeoAuditFinding;
use App\Models\SeoAutomationSetting;
use Illuminate\Console\Command;

class SeoProcessAlertsCommand extends Command
{
    protected $signature = 'seo:process-alerts';

    protected $description = 'Process outstanding SEO alerts, detect new regressions, and dispatch notifications';

    public function handle(): int
    {
        $this->info('Scanning for critical SEO issues and unacknowledged alerts...');

        $criticalCount = SeoAuditFinding::where('severity', 'critical')
            ->where('status', 'open')
            ->count();

        $unreadAlerts = SeoAlert::where('is_read', false)->get();
        $settings = SeoAutomationSetting::getGlobal();

        $this->table(
            ['Alert Check', 'Status / Count'],
            [
                ['Open Critical Findings', $criticalCount],
                ['Unacknowledged Alerts', $unreadAlerts->count()],
                ['Configured Alert Email', $settings->alert_email ?: 'Not set'],
                ['Auto Notification Mode', $settings->mode],
            ]
        );

        if ($unreadAlerts->isNotEmpty()) {
            $this->warn("There are {$unreadAlerts->count()} unread alerts in the SEO Audit Center.");
            foreach ($unreadAlerts->take(5) as $alert) {
                $this->line(" - [{$alert->severity}] {$alert->title}");
            }
        } else {
            $this->info('No unacknowledged alerts found.');
        }

        return self::SUCCESS;
    }
}
