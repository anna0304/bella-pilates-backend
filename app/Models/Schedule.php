<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    protected $fillable = [
        'class_id',
        'day_of_week',
        'start_time',
        'end_time',
        'instructor_name',
        'room',
        'is_active',
    ];

    /**
     * Un horario pertenece a una clase
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(
            ClassModel::class,
            'class_id'
        );
    }

    /**
     * Un horario tiene muchas reservas
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(
            Reservation::class,
            'schedule_id'
        );
    }
}