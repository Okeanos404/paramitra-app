<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentTransaction extends Model
{
    protected $table = 'payment_transactions';

    protected $fillable = [
        'pesanan_id',
        'payment_method_id',
        'transaction_id',
        'amount',
        'status',
        'metadata',
        'paid_at',
        'gateway_reference',
        'notes',
    ];

    protected $casts = [
        'metadata' => 'json',
        'paid_at' => 'datetime',
    ];

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
