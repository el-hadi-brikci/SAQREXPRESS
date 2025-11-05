<?php

namespace Database\Factories;

use App\Models\Bureau;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class BureauFactory extends Factory
{
    protected $model = Bureau::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->company(),
            'region_id' => Region::factory(),
            'adresse' => $this->faker->address(),
            'wilaya_number' => $this->faker->numberBetween(1, 58),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
