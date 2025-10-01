<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Region;
use App\Models\Bureau;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ✅ Admin Global
        User::firstOrCreate(
            ['email' => 'admin@saqr.com'],
            [
                'name' => 'Admin Global',
                'password' => Hash::make('password'),
                'role' => 'admin_global',
            ]
        );

        // ✅ Admin Région (ex: Alger)
        $regionAlger = Region::where('nom', 'Alger')->first();
        if ($regionAlger) {
            User::firstOrCreate(
                ['email' => 'admin.alger@saqr.com'],
                [
                    'name' => 'Admin Région Alger',
                    'password' => Hash::make('password'),
                    'role' => 'admin_region',
                    'region_id' => $regionAlger->id,
                ]
            );
        }

        // ✅ Admin Bureau (ex: Bureau Alger Centre)
        $bureauAlger = Bureau::where('nom', 'Bureau Alger Centre')->first();
        if ($bureauAlger) {
            User::firstOrCreate(
                ['email' => 'admin.bureau.alger@saqr.com'],
                [
                    'name' => 'Admin Bureau Alger',
                    'password' => Hash::make('password'),
                    'role' => 'admin_bureau',
                    'bureau_id' => $bureauAlger->id,
                ]
            );

            // ✅ Employé du même bureau
            User::firstOrCreate(
                ['email' => 'employe.alger@saqr.com'],
                [
                    'name' => 'Employé Alger',
                    'password' => Hash::make('password'),
                    'role' => 'employe',
                    'bureau_id' => $bureauAlger->id,
                ]
            );
        }

        // ✅ Client test (sera lié via ClientSeeder)
        User::firstOrCreate(
            ['email' => 'client@saqr.com'],
            [
                'name' => 'Client Test',
                'password' => Hash::make('password'),
                'role' => 'client',
            ]
        );
    }
}
