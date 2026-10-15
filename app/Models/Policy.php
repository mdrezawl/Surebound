<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'policy_number',
        'holder_name',
        'holder_email',
        'holder_phone',
        'type',
        'type_label',
        'carrier',
        'insured_item',
        'coverage_limit',
        'deductible',
        'annual_premium',
        'billing_frequency',
        'effective_date',
        'renewal_date',
        'status',
        'coverage_details',
        'policy_document',
        'notes',
    ];

    protected $casts = [
        'coverage_details' => 'array',
        'effective_date' => 'date',
        'renewal_date' => 'date',
    ];

    /**
     * Associated customer/user account
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Numeric coverage amount for aggregations
     */
    public function getNumericLimitAttribute(): float
    {
        return (float) preg_replace('/[^0-9.]/', '', $this->coverage_limit ?? '0');
    }

    /**
     * Numeric annual premium amount for calculations
     */
    public function getNumericPremiumAttribute(): float
    {
        return (float) preg_replace('/[^0-9.]/', '', $this->annual_premium ?? '0');
    }

    /**
     * Check if policy is active
     */
    public function isActive(): bool
    {
        return strtolower($this->status) === 'active';
    }
}
