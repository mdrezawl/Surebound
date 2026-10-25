<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoPerformanceReport extends Model
{
    use HasFactory;

    protected $table = 'seo_performance_reports';

    protected $fillable = [
        'url',
        'device',
        'performance_score',
        'lcp_seconds',
        'inp_ms',
        'cls_score',
        'fcp_seconds',
        'speed_index',
        'field_data',
        'opportunities',
        'diagnostics',
        'tested_at',
    ];

    protected function casts(): array
    {
        return [
            'performance_score' => 'integer',
            'lcp_seconds' => 'float',
            'inp_ms' => 'integer',
            'cls_score' => 'float',
            'fcp_seconds' => 'float',
            'speed_index' => 'float',
            'field_data' => 'array',
            'opportunities' => 'array',
            'diagnostics' => 'array',
            'tested_at' => 'datetime',
        ];
    }
}
