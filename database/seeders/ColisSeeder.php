<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Colis;
use App\Models\Client;
use App\Models\Bureau;

class ColisSeeder extends Seeder
{
    public function run(): void
    {
        $bureauAlger = Bureau::where('nom', 'Bureau Alger Centre')->first();
        $bureauOran = Bureau::where('nom', 'Bureau Oran Centre')->first();

        $clientAhmed = Client::where('nom', 'Ahmed')->first();
        $clientSara = Client::where('nom', 'Sara')->first();

        Colis::create([
            'code_suivi' => 'C12345',
            'description' => 'Documents officiels',
            'poids' => 2.5,
            'statut' => 'en_attente',
            'bureau_id' => $bureauAlger->id,
            'client_id' => $clientAhmed->id,
        ]);

        Colis::create([
            'code_suivi' => 'C67890',
            'description' => 'Colis fragile',
            'poids' => 5.0,
            'statut' => 'en_cours',
            'bureau_id' => $bureauOran->id,
            'client_id' => $clientSara->id,
        ]);
    }
}
