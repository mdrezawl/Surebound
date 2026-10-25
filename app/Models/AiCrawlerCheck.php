<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiCrawlerCheck extends Model
{
    use HasFactory;

    protected $table = 'ai_crawler_checks';

    protected $fillable = [
        'crawler_name',
        'crawler_type',
        'url_checked',
        'is_allowed_in_robots',
        'http_status',
        'latency_ms',
        'notes',
        'checked_at',
    ];

    protected function casts(): array
    {
        return [
            'is_allowed_in_robots' => 'boolean',
            'http_status' => 'integer',
            'latency_ms' => 'integer',
            'checked_at' => 'datetime',
        ];
    }
}
