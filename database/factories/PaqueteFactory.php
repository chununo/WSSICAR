<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Articulo;
use App\Models\Paquete;
use App\Models\Store;

class PaqueteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Paquete::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'paquete' => fake()->numberBetween(-10000, 10000),
            'articulo' => fake()->numberBetween(-10000, 10000),
            'paquete_id' => Articulo::factory(),
            'articulo_id' => Articulo::factory(),
            'cantidad' => fake()->randomFloat(5, 0, 999999999999999.99999),
            'opcional' => fake()->boolean(),
            'incluido' => fake()->boolean(),
            'costoExtra' => fake()->boolean(),
            'porcion' => fake()->randomFloat(3, 0, 99999999999999999.999),
            'grupo' => fake()->numberBetween(-10000, 10000),
            'maximo' => fake()->numberBetween(-10000, 10000),
            'minimo' => fake()->numberBetween(-10000, 10000),
            'multiplicador' => fake()->numberBetween(-10000, 10000),
            'validation_status' => fake()->randomElement(["valid","partial","invalid"]),
            'validation_errors' => '{}',
        ];
    }
}
