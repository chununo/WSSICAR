<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Departamento;
use App\Models\Store;

class DepartamentoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Departamento::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'dep_id' => fake()->numberBetween(-100000, 100000),
            'nombre' => fake()->word(),
            'restringido' => fake()->boolean(),
            'porcentaje' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'system' => fake()->boolean(),
            'status' => fake()->numberBetween(-10000, 10000),
            'imagen' => fake()->sha256(),
            'comision' => fake()->randomFloat(4, 0, 9999999999999999.9999),
        ];
    }
}
