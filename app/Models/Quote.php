<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote_ref',
        'name',
        'first_name',
        'last_name',
        'business_name',
        'email',
        'phone',
        'type',
        'type_label',
        'coverages',
        'business_type',
        'business_type_other',
        'business_description',
        'employees',
        'years_in_business',
        'annual_revenue',
        'business_address',
        'location_ownership',
        'modular_data',
        'renewal_timeline',
        'current_carrier',
        'claims_history',
        'bundle_preference',
        'tags',
        'raw_answers',
        'coverage',
        'premium',
        'location',
        'zip_code',
        'status',
        'notes',
    ];

    protected $casts = [
        'coverages' => 'array',
        'modular_data' => 'array',
        'tags' => 'array',
        'raw_answers' => 'array',
    ];
}
