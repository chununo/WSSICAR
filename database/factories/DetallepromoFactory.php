<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Departamento;
use App\Models\Detallepromo;
use App\Models\Promocion;
use App\Models\Store;

class DetallepromoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Detallepromo::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'dpr_id' => fake()->numberBetween(-10000, 10000),
            'pro_id' => fake()->numberBetween(-10000, 10000),
            'promocion_id' => Promocion::factory(),
            'art_id' => fake()->numberBetween(-10000, 10000),
            'articulo_id' => Articulo::factory(),
            'cat_id' => fake()->numberBetween(-10000, 10000),
            'categoria_id' => Categoria::factory(),
            'dep_id' => fake()->numberBetween(-10000, 10000),
            'departamento_id' => Departamento::factory(),
            'tipo' => fake()->numberBetween(-10000, 10000),
            'status' => fake()->numberBetween(-10000, 10000),
            'validation_status' => fake()->randomElement(["valid","partial","invalid"]),
            'validation_errors' => '{}',
        ];
    }
}
