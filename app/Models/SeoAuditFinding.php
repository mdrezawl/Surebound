<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SeoAuditFinding extends Model
{
    use HasFactory;

    protected $table = 'seo_audit_findings';

    protected $fillable = [
        'audit_id',
        'url',
        'category',
        'severity',
        'issue_code',
        'title',
        'description',
        'evidence',
        'recommended_fix',
        'status',
        'resolved_at',
    ];

    protected function casts(): array
    {
        return [
            'resolved_at' => 'datetime',
        ];
    }

    public function audit(): BelongsTo
    {
        return $this->belongsTo(SeoAudit::class, 'audit_id');
    }

    public function recommendation(): HasOne
    {
        return $this->hasOne(SeoRecommendation::class, 'finding_id');
    }
}
