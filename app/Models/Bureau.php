<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bureau extends Model
{
    use HasFactory;

    protected $table = 'bureaux';

    protected $fillable = ['nom', 'adresse', 'region_id'];

    // Un bureau appartient à une région
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    // Un bureau a plusieurs employés (users avec role=employe)
    public function employes()
    {
        return $this->hasMany(User::class)->where('role', 'employe');
    }

    // Un bureau gère plusieurs colis
    public function colis()
    {
        return $this->hasMany(Colis::class);
    }

    // Un bureau gère plusieurs livraisons
    public function livraisons()
    {
        return $this->hasMany(Livraison::class);
    }
}
