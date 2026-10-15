<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'policy_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'subtotal',
        'tax',
        'discount',
        'total_amount',
        'status',
        'issue_date',
        'due_date',
        'payment_method',
        'payment_transaction_id',
        'paid_at',
        'line_items',
        'notes',
        'signatory_name',
        'signatory_title',
        'signature_image',
    ];

    protected $casts = [
        'line_items' => 'array',
        'issue_date' => 'date',
        'due_date' => 'date',
        'paid_at' => 'datetime',
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'discount' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];
}
