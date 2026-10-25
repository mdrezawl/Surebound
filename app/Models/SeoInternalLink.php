<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoInternalLink extends Model
{
    use HasFactory;

    protected $table = 'seo_internal_links';

    protected $fillable = [
        'source_url',
        'target_url',
        'anchor_text',
        'is_nofollow',
        'http_status',
        'is_broken',
    ];

    protected function casts(): array
    {
        return [
            'is_nofollow' => 'boolean',
            'http_status' => 'integer',
            'is_broken' => 'boolean',
        ];
    }
}
