<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'classes_per_month',
        'duration_days',
        'is_featured',
        'is_active',
    ];

    /**
     * Un plan puede tener muchos pagos
     */
    public function payments(): HasMany
    {
        return $this->hasMany(
            Payment::class,
            'plan_id'
        );
    }
}