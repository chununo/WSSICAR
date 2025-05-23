<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Horariopromo;
use App\Models\Promocion;
use App\Models\Store;

class PromocionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Promocion::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'pro_id' => fake()->numberBetween(-10000, 10000),
            'nombre' => fake()->regexify('[A-Za-z0-9]{255}'),
            'fechaIni' => fake()->date(),
            'fechaFin' => fake()->date(),
            'descuento' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'pago' => fake()->numberBetween(-10000, 10000),
            'salida' => fake()->numberBetween(-10000, 10000),
            'precio' => fake()->numberBetween(-10000, 10000),
            'condicion' => fake()->boolean(),
            'totalMin' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'piezasMin' => fake()->numberBetween(-10000, 10000),
            'piezasReq' => fake()->numberBetween(-10000, 10000),
            'piezasPromo' => fake()->numberBetween(-10000, 10000),
            'cascada' => fake()->boolean(),
            'status' => fake()->numberBetween(-10000, 10000),
            'sincronizar' => fake()->boolean(),
            'mixto' => fake()->boolean(),
            'mostrarComensal' => fake()->boolean(),
            'artReq' => fake()->boolean(),
            'artReqMixto' => fake()->boolean(),
            'clientes' => fake()->boolean(),
            'hor_id' => fake()->numberBetween(-10000, 10000),
            'horariopromo_id' => Horariopromo::factory(),
            'validation_status' => fake()->randomElement(["valid","partial","invalid"]),
            'validation_errors' => '{}',
        ];
    }
}
