<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Livraison;
use App\Models\Vehicule;
use App\Models\Bureau;
use App\Models\Colis;

class LivraisonSeeder extends Seeder
{
    public function run(): void
    {
        $vehicule = Vehicule::first(); // ex: premier véhicule dispo
        $bureau = Bureau::where('nom', 'Bureau Alger Centre')->first();
        $colis = Colis::where('code_suivi', 'C12345')->first();

        if ($vehicule && $bureau && $colis) {
            Livraison::create([
                'expediteur_nom' => 'Ahmed',
                'expediteur_tel' => '0551122233',
                'destinataire_nom' => 'Sara',
                'destinataire_tel' => '0661445566',
                'etat' => 'en_cours',
                'vehicule_id' => $vehicule->id,
                'bureau_id' => $bureau->id,
                'colis_id' => $colis->id,
            ]);
        }
    }
}
