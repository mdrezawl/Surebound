<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoAnalyticsMetric extends Model
{
    use HasFactory;

    protected $table = 'seo_analytics_metrics';

    protected $fillable = [
        'metric_date',
        'landing_page',
        'channel_group',
        'sessions',
        'engaged_sessions',
        'conversions',
        'leads_generated',
    ];

    protected function casts(): array
    {
        return [
            'metric_date' => 'date',
            'sessions' => 'integer',
            'engaged_sessions' => 'integer',
            'conversions' => 'integer',
            'leads_generated' => 'integer',
        ];
    }
}
