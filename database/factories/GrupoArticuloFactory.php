<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Articulo;
use App\Models\Grupo;
use App\Models\GrupoArticulo;
use App\Models\Store;

class GrupoArticuloFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GrupoArticulo::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'gar_id' => fake()->numberBetween(-10000, 10000),
            'art_id' => fake()->numberBetween(-10000, 10000),
            'grupo_id' => Grupo::factory(),
            'articulo_id' => Articulo::factory(),
            'costoExtra' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'status' => fake()->numberBetween(-10000, 10000),
            'cantidad' => fake()->randomFloat(3, 0, 99999999999999999.999),
            'imprimir' => fake()->boolean(),
            'alias' => fake()->regexify('[A-Za-z0-9]{100}'),
            'validation_status' => fake()->randomElement(["valid","partial","invalid"]),
            'validation_errors' => '{}',
        ];
    }
}
