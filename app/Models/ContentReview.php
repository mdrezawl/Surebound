<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentReview extends Model
{
    use HasFactory;

    protected $table = 'content_reviews';

    protected $fillable = [
        'content_type',
        'content_id',
        'title',
        'url_path',
        'workflow_status',
        'notes',
        'submitted_by',
        'reviewed_by',
        'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
        ];
    }
}
