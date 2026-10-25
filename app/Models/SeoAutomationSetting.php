<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoAutomationSetting extends Model
{
    use HasFactory;

    protected $table = 'seo_automation_settings';

    protected $fillable = [
        'mode',
        'crawl_limit_pages',
        'crawl_throttle_delay_ms',
        'excluded_paths',
        'alert_email',
        'alert_on_critical',
        'auto_sitemap_sync',
    ];

    protected function casts(): array
    {
        return [
            'crawl_limit_pages' => 'integer',
            'crawl_throttle_delay_ms' => 'integer',
            'excluded_paths' => 'array',
            'alert_on_critical' => 'boolean',
            'auto_sitemap_sync' => 'boolean',
        ];
    }

    /**
     * Get or create global settings singleton.
     */
    public static function getGlobal(): self
    {
        return static::firstOrCreate([], [
            'mode' => 'suggest_and_approve',
            'crawl_limit_pages' => 100,
            'crawl_throttle_delay_ms' => 200,
            'excluded_paths' => ['/admin*', '/dashboard*', '/login', '/register', '/setup*'],
            'alert_email' => 'admin@surebound.com',
            'alert_on_critical' => true,
            'auto_sitemap_sync' => true,
        ]);
    }
}
