<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSearchMetric extends Model
{
    use HasFactory;

    protected $table = 'seo_search_metrics';

    protected $fillable = [
        'metric_date',
        'query',
        'page_url',
        'country',
        'device',
        'clicks',
        'impressions',
        'ctr',
        'average_position',
    ];

    protected function casts(): array
    {
        return [
            'metric_date' => 'date',
            'clicks' => 'integer',
            'impressions' => 'integer',
            'ctr' => 'float',
            'average_position' => 'float',
        ];
    }
}
