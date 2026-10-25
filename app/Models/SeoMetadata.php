<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoMetadata extends Model
{
    use HasFactory;

    protected $table = 'seo_metadata';

    protected $fillable = [
        'url_path',
        'route_name',
        'seo_title',
        'meta_description',
        'canonical_url',
        'meta_robots',
        'og_title',
        'og_description',
        'og_image',
        'og_type',
        'twitter_card',
        'focus_keyword',
        'secondary_keywords',
        'search_intent',
        'target_country',
        'target_language',
        'schema_type',
        'schema_override',
        'is_published',
        'author_name',
        'reviewed_by',
    ];

    protected function casts(): array
    {
        return [
            'secondary_keywords' => 'array',
            'schema_override' => 'array',
            'is_published' => 'boolean',
        ];
    }

    /**
     * Scope to find by exact URL path.
     */
    public function scopeForPath($query, string $path)
    {
        $normalized = '/'.ltrim(parse_url($path, PHP_URL_PATH) ?: '/', '/');

        return $query->where('url_path', $normalized);
    }
}
