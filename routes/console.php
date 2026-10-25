<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Technical SEO Scheduled Background Tasks
Schedule::command('seo:audit')->dailyAt('02:00');
Schedule::command('seo:validate-sitemaps')->dailyAt('03:00');
Schedule::command('seo:check-crawlers')->dailyAt('04:00');
Schedule::command('seo:process-alerts')->hourly();
Schedule::command('seo:check-performance')->weeklyOn(1, '05:00');
