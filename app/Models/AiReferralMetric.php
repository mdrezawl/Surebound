<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiReferralMetric extends Model
{
    use HasFactory;

    protected $table = 'ai_referral_metrics';

    protected $fillable = [
        'metric_date',
        'ai_source',
        'landing_page',
        'referral_visits',
        'leads_generated',
    ];

    protected function casts(): array
    {
        return [
            'metric_date' => 'date',
            'referral_visits' => 'integer',
            'leads_generated' => 'integer',
        ];
    }
}
