<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Store;

class StoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->word(),
            'alias' => fake()->word(),
            'correo_principal' => fake()->word(),
            'correo_secundario' => fake()->word(),
            'telefono_principal' => fake()->word(),
            'telefono_secundario' => fake()->word(),
            'calle' => fake()->word(),
            'numero_externo' => fake()->word(),
            'numero_interno' => fake()->word(),
            'colonia' => fake()->word(),
            'entidad' => fake()->word(),
            'estado' => fake()->word(),
            'cp' => fake()->word(),
            'nota_direccion' => fake()->word(),
        ];
    }
}
