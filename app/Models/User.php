<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'region_id',
        'bureau_id',
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
        ];
    }

    // 🔹 Relation : un utilisateur peut être lié à une région
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    // 🔹 Relation : un utilisateur peut être lié à un bureau
    public function bureau()
    {
        return $this->belongsTo(Bureau::class);
    }

    // 🔹 Si l’utilisateur est client → relation avec ses colis
    public function colis()
    {
        return $this->hasMany(Colis::class, 'client_id');
    }

    /**
     * Vérifie si l'utilisateur a un rôle spécifique.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
}
