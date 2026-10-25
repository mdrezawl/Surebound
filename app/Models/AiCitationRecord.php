<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiCitationRecord extends Model
{
    use HasFactory;

    protected $table = 'ai_citation_records';

    protected $fillable = [
        'platform',
        'query_tested',
        'test_date',
        'brand_mentioned',
        'citation_found',
        'cited_url',
        'evidence_text',
        'evidence_url',
        'verification_status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'test_date' => 'date',
            'brand_mentioned' => 'boolean',
            'citation_found' => 'boolean',
        ];
    }
}
