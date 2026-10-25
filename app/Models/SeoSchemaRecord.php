<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSchemaRecord extends Model
{
    use HasFactory;

    protected $table = 'seo_schema_records';

    protected $fillable = [
        'url_path',
        'schema_type',
        'schema_json',
        'is_active',
        'validation_status',
    ];

    protected function casts(): array
    {
        return [
            'schema_json' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
