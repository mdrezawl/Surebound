<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SeoAudit extends Model
{
    use HasFactory;

    protected $table = 'seo_audits';

    protected $fillable = [
        'audit_type',
        'status',
        'pages_scanned',
        'critical_count',
        'high_count',
        'medium_count',
        'low_count',
        'info_count',
        'health_score',
        'summary',
        'duration_seconds',
        'triggered_by',
    ];

    protected function casts(): array
    {
        return [
            'pages_scanned' => 'integer',
            'critical_count' => 'integer',
            'high_count' => 'integer',
            'medium_count' => 'integer',
            'low_count' => 'integer',
            'info_count' => 'integer',
            'health_score' => 'integer',
            'duration_seconds' => 'decimal:2',
        ];
    }

    public function findings(): HasMany
    {
        return $this->hasMany(SeoAuditFinding::class, 'audit_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'triggered_by');
    }
}
