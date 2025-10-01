<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicule;

class VehiculeSeeder extends Seeder
{
    public function run(): void
    {
        Vehicule::firstOrCreate([
            'matricule' => '123-456-16'
        ], [
            'type' => 'taxi',
            'ligne' => 'Alger - Oran',
        ]);

        Vehicule::firstOrCreate([
            'matricule' => '789-321-25'
        ], [
            'type' => 'bus',
            'ligne' => 'Oran - Constantine',
        ]);

        Vehicule::firstOrCreate([
            'matricule' => '456-789-10'
        ], [
            'type' => 'bus',
            'ligne' => 'Alger - Constantine',
        ]);
    }
}
