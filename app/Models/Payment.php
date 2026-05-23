<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'amount',
        'payment_method',
        'status',
        'transaction_id',
        'starts_at',
        'expires_at',
    ];

    /**
     * Un pago pertenece a un usuario
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    /**
     * Un pago pertenece a un plan
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(
            Plan::class,
            'plan_id'
        );
    }
}