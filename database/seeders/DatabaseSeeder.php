<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RegionSeeder::class,
            BureauSeeder::class,
            UserSeeder::class,
            ClientSeeder::class,
            VehiculeSeeder::class,
            ColisSeeder::class,
            LivraisonSeeder::class,
        ]);
    }
}
