<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoAlert extends Model
{
    use HasFactory;

    protected $table = 'seo_alerts';

    protected $fillable = [
        'severity',
        'title',
        'message',
        'category',
        'is_read',
        'resolved_at',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
            'resolved_at' => 'datetime',
        ];
    }
}
