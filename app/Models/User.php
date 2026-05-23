<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'password',
        'role',
        'status',
        'must_change_password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'must_change_password' => 'boolean',
        ];
    }

    /**
     * Un usuario puede tener muchas reservas
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(
            Reservation::class,
            'user_id'
        );
    }

    /**
     * Un usuario puede tener muchos favoritos
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(
            Favorite::class,
            'user_id'
        );
    }

    /**
     * Un usuario puede tener muchos pagos
     */
    public function payments(): HasMany
    {
        return $this->hasMany(
            Payment::class,
            'user_id'
        );
    }
}