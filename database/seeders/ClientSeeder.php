<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        // Client 1 : Ahmed
        $user1 = User::create([
            'name' => 'Ahmed',
            'email' => 'ahmed@example.com',
            'password' => Hash::make('password'),
            'role' => 'client',
        ]);

        Client::create([
            'nom' => 'Ahmed',
            'user_id' => $user1->id,
            'telephone' => '0551122233',
            'adresse' => 'Alger',
        ]);

        // Client 2 : Sara
        $user2 = User::create([
            'name' => 'Sara',
            'email' => 'sara@example.com',
            'password' => Hash::make('password'),
            'role' => 'client',
        ]);

        Client::create([
            'nom' => 'Sara',
            'user_id' => $user2->id,
            'telephone' => '0661445566',
            'adresse' => 'Oran',
        ]);
    }
}
