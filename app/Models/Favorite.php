<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    protected $fillable = [
        'user_id',
        'recorded_class_id',
    ];

    /**
     * El favorito pertenece a un usuario
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    /**
     * El favorito pertenece a una clase grabada
     */
    public function recordedClass(): BelongsTo
    {
        return $this->belongsTo(
            RecordedClass::class,
            'recorded_class_id'
        );
    }
}