<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\Bureau;

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
        'prix', // Ajouté pour permettre la modification et la création
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

    /**
     * Génération automatique du code de suivi lors de la création
     * Format: CmmYY-DDDD-ssss (ex: C1025-1316-0001)
     */
    protected static function booted()
    {
        static::creating(function ($colis) {
            // Si un code_suivi a déjà été fourni, ne rien faire
            if (!empty($colis->code_suivi)) {
                return;
            }

            $createdAt = $colis->created_at ? Carbon::parse($colis->created_at) : Carbon::now();
            $month = $createdAt->format('m');
            $yearShort = $createdAt->format('y');

            // wilaya départ
            $wilayaDepart = '00';
            if (!empty($colis->bureau_id)) {
                $bureau = Bureau::find($colis->bureau_id);
                if ($bureau && $bureau->wilaya_number) {
                    $wilayaDepart = str_pad((int)$bureau->wilaya_number, 2, '0', STR_PAD_LEFT);
                }
            }

            // wilaya arrivée
            $wilayaArrivee = '00';
            if (!empty($colis->bureau_destination_id)) {
                $bureauDest = Bureau::find($colis->bureau_destination_id);
                if ($bureauDest && $bureauDest->wilaya_number) {
                    $wilayaArrivee = str_pad((int)$bureauDest->wilaya_number, 2, '0', STR_PAD_LEFT);
                }
            }

            // compteur mensuel : compter les colis déjà créés ce mois-ci
            $count = self::whereYear('created_at', $createdAt->year)
                ->whereMonth('created_at', $createdAt->month)
                ->count() + 1;

            $counter = str_pad($count, 4, '0', STR_PAD_LEFT);

            $code = sprintf('C%s%s-%s%s-%s', $month, $yearShort, $wilayaDepart, $wilayaArrivee, $counter);

            $colis->code_suivi = $code;
        });
    }
}
