<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassModel extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'title',
        'description',
        'category',
        'level',
        'duration',
        'max_capacity',
        'image',
        'is_active',
        'instructor_name',
    ];

    /**
     * Una clase tiene muchos horarios
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(
            Schedule::class,
            'class_id'
        );
    }

    /**
     * Una clase tiene muchas clases grabadas
     */
    public function recordedClasses(): HasMany
    {
        return $this->hasMany(
            RecordedClass::class,
            'class_id'
        );
    }
}