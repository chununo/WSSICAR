<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Impuesto;
use App\Models\Store;

class ImpuestoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Impuesto::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'imp_id' => fake()->numberBetween(-100000, 100000),
            'nombre' => fake()->word(),
            'impuesto' => fake()->randomFloat(6, 0, 99999999999999.999999),
            'impreso' => fake()->boolean(),
            'tras' => fake()->boolean(),
            'local' => fake()->boolean(),
            'aplicarIVA' => fake()->boolean(),
            'orden' => fake()->numberBetween(-10000, 10000),
            'status' => fake()->numberBetween(-10000, 10000),
            'tipoFactor' => fake()->word(),
            'cco_id' => fake()->numberBetween(-10000, 10000),
            'compraPagada' => fake()->numberBetween(-10000, 10000),
            'compraCredito' => fake()->numberBetween(-10000, 10000),
            'gastoPagado' => fake()->numberBetween(-10000, 10000),
            'gastoCredito' => fake()->numberBetween(-10000, 10000),
            'anticipoCliente' => fake()->numberBetween(-10000, 10000),
        ];
    }
}
