<?php

namespace Database\Factories;

use App\Models\Pelicula;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\multas>
 */
class MultaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fechaMulta' => fake()->dateTime(),
            'valor' => fake()->randomFloat(2, 1000, 1000000) * 100,
            'saldo' => fake()->randomFloat(2, 0, 1000000) * 100,
            'pelicula_id' => Pelicula::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
    }
}
