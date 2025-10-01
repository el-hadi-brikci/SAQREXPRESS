<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
    'nom',
    'telephone',
    'adresse',
    'user_id',
];



    // Un client peut être lié à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Un client peut avoir plusieurs colis
    public function colis()
    {
        return $this->hasMany(Colis::class);
    }
}
