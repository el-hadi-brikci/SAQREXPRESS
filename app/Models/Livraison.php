<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;

    protected $fillable = [
        'expediteur_nom',
        'expediteur_tel',
        'destinataire_nom',
        'destinataire_tel',
        'etat',
        'vehicule_id',
        'bureau_id',
        'colis_id',
    ];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function colis()
    {
        return $this->belongsTo(Colis::class);
    }

    public function bureau()
    {
        return $this->belongsTo(Bureau::class);
    }
}
