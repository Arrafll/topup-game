<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => ucfirst(fake()->word()),
            'game' => ucfirst(fake()->word()),
            'description' => fake()->text(500),
            'unit' => fake()->text(25),
            'category_id' => round(mt_rand(3, 5) / rand(1, 2), 1),
        ];
    }
}
