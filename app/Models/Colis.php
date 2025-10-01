<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colis extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_suivi',
        'description',
        'poids',
        'statut',
        'bureau_id',
        'client_id',
        'code_barre',
        'numero_voiture',
        'telephone_chauffeur',
        'telephone_envoyeur',
        'telephone_receveur',
        'bureau_destination_id',
        'saisi_par',
        'date_livraison_reelle',
    ];

    protected $casts = [
        'date_livraison_reelle' => 'datetime',
    ];

    // ✅ Relations
    public function bureau()
    {
        return $this->belongsTo(Bureau::class);
    }

    public function bureauDestination()
    {
        return $this->belongsTo(Bureau::class, 'bureau_destination_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function livraisons()
    {
        return $this->hasMany(Livraison::class);
    }

    public function saisiParUser()
    {
        return $this->belongsTo(User::class, 'saisi_par');
    }
}
