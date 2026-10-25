<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeoRecommendation extends Model
{
    use HasFactory;

    protected $table = 'seo_recommendations';

    protected $fillable = [
        'finding_id',
        'url',
        'title',
        'category',
        'impact',
        'confidence',
        'estimated_effort',
        'requires_human_approval',
        'status',
        'current_value',
        'suggested_value',
        'applied_at',
    ];

    protected function casts(): array
    {
        return [
            'confidence' => 'integer',
            'requires_human_approval' => 'boolean',
            'applied_at' => 'datetime',
        ];
    }

    public function finding(): BelongsTo
    {
        return $this->belongsTo(SeoAuditFinding::class, 'finding_id');
    }
}
