<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RecordedClass extends Model
{
    protected $fillable = [
        'class_id',
        'title',
        'description',
        'video_url',
        'thumbnail',
        'duration',
        'level',
        'featured',
        'is_active',
    ];

    /**
     * Una clase grabada pertenece a una clase
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(
            ClassModel::class,
            'class_id'
        );
    }

    /**
     * Una clase grabada puede estar en muchos favoritos
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(
            Favorite::class,
            'recorded_class_id'
        );
    }
}