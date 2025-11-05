<?php

namespace Database\Factories;

use App\Models\Colis;
use App\Models\Client;
use App\Models\Bureau;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Colis>
 */
class ColisFactory extends Factory
{
    protected $model = Colis::class;

    public function definition(): array
    {
        return [
            'code_suivi' => strtoupper($this->faker->bothify('??###')),
            'description' => $this->faker->sentence(6),
            'statut' => 'en_attente',
            'poids' => $this->faker->randomFloat(2, 0.1, 10),
            'prix' => $this->faker->randomFloat(2, 100, 1000),
            'client_id' => Client::factory(),
            'bureau_id' => Bureau::factory(),
            'bureau_destination_id' => Bureau::factory(),
            'saisi_par' => 1,
            'heure_saisie' => now()->toTimeString(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
