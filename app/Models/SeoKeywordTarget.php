<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoKeywordTarget extends Model
{
    use HasFactory;

    protected $table = 'seo_keyword_targets';

    protected $fillable = [
        'keyword',
        'target_url',
        'target_country',
        'target_language',
        'search_intent',
        'topic_cluster',
        'search_volume',
        'difficulty',
        'current_position',
        'provider_source',
        'cannibalization_warning',
        'last_checked_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'search_volume' => 'integer',
            'difficulty' => 'integer',
            'current_position' => 'float',
            'last_checked_at' => 'datetime',
        ];
    }
}
