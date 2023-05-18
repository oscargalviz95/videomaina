<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\peliculas>
 */
class PeliculaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigoInventario' => fake()->unique()->randomNumber(6),
            'titulo' => fake()->sentence,
            'formato' => fake()->randomElement(['DVD', 'Blu-ray', 'VHS', 'Digital', '4K Ultra HD', 'Streaming']),
            'precio' => fake()->randomFloat(2, 1000, 1000000) * 100,
            'cantidad' => fake()->numberBetween(1, 100),
        ];
    }
}
