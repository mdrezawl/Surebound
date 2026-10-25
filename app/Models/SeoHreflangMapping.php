<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoHreflangMapping extends Model
{
    use HasFactory;

    protected $table = 'seo_hreflang_mappings';

    protected $fillable = [
        'source_url',
        'locale',
        'alternate_url',
        'is_reciprocal',
    ];

    protected function casts(): array
    {
        return [
            'is_reciprocal' => 'boolean',
        ];
    }
}
