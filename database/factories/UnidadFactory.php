<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Store;
use App\Models\Unidad;

class UnidadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Unidad::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'uni_id' => fake()->numberBetween(-10000, 10000),
            'nombre' => fake()->regexify('[A-Za-z0-9]{5}'),
            'status' => fake()->numberBetween(-10000, 10000),
            'clave' => fake()->regexify('[A-Za-z0-9]{10}'),
        ];
    }
}
