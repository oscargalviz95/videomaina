<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\sucursales>
 */
class SucursalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nit = fake()->unique()->numberBetween(100000000, 999999999);
        $verificador = fake()->numberBetween(0, 9);
        $nitCompleto = $nit . '-' . $verificador;


        return [
            'id' => $nitCompleto,
            'direccion' => fake()->address,
            'telefono' => fake()->phoneNumber,
            'nombreAdministrador' => fake()->name,
            'cedulaAdministrador' => fake()->unique()->randomNumber(9),
        ];
    }
}
