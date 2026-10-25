<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoIntegration extends Model
{
    use HasFactory;

    protected $table = 'seo_integrations';

    protected $fillable = [
        'service_key',
        'name',
        'is_connected',
        'credentials',
        'property_id',
        'last_sync_at',
        'last_error',
        'settings',
    ];

    protected function casts(): array
    {
        return [
            'is_connected' => 'boolean',
            'credentials' => 'encrypted:array',
            'settings' => 'array',
            'last_sync_at' => 'datetime',
        ];
    }
}
