<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    public function run(): void
    {
        Region::firstOrCreate(['nom' => 'Alger']);
        Region::firstOrCreate(['nom' => 'Oran']);
        Region::firstOrCreate(['nom' => 'Constantine']);
    }
}
