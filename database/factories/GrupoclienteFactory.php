<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Grupocliente;
use App\Models\Store;

class GrupoclienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Grupocliente::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'grc_id' => fake()->numberBetween(-10000, 10000),
            'descripcion' => fake()->regexify('[A-Za-z0-9]{255}'),
            'precio' => fake()->numberBetween(-10000, 10000),
            'precioObligatorio' => fake()->boolean(),
            'status' => fake()->numberBetween(-10000, 10000),
        ];
    }
}
