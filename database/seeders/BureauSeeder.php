<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\Bureau;

class BureauSeeder extends Seeder
{
    public function run(): void
    {
        // On suppose que RegionSeeder a déjà créé ces régions
        $alger = Region::where('nom', 'Alger')->first();
        $oran = Region::where('nom', 'Oran')->first();
        $constantine = Region::where('nom', 'Constantine')->first();

        Bureau::create([
            'nom' => 'Bureau Alger Centre',
            'adresse' => 'Rue Didouche Mourad, Alger',
            'region_id' => $alger->id,
        ]);

        Bureau::create([
            'nom' => 'Bureau Oran Centre',
            'adresse' => 'Place d’Armes, Oran',
            'region_id' => $oran->id,
        ]);

        Bureau::create([
            'nom' => 'Bureau Constantine Est',
            'adresse' => 'Boulevard Aouati Mostefa, Constantine',
            'region_id' => $constantine->id,
        ]);
    }
}
