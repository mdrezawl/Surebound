<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    use HasFactory;

    protected $fillable = [
        'claim_number',
        'policy_number',
        'claimant_name',
        'claimant_email',
        'claimant_phone',
        'incident_date',
        'incident_type',
        'incident_location',
        'incident_description',
        'estimated_loss',
        'assigned_adjuster',
        'priority',
        'status',
        'adjuster_notes',
    ];

    protected $casts = [
        'incident_date' => 'date',
    ];

    /**
     * Associated policy if matched by policy_number
     */
    public function policy()
    {
        return $this->belongsTo(Policy::class, 'policy_number', 'policy_number');
    }
}
