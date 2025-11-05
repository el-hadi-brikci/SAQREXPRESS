<?php

namespace Database\Factories;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegionFactory extends Factory
{
    protected $model = Region::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->state(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
