<?php

namespace Database\Factories;

use App\Models\Pelicula;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\alquileres>
 */
class AlquilerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fechaAlquiler' => fake()->dateTime(),
            'fechaDevolucion' => fake()->dateTime(),
            'pelicula_id' => Pelicula::all()->random()->id,
            'sucursal_id' => Sucursal::all()->random()->id,
            'user_id' => User::all()->random()->id,
        ];
    }
}
