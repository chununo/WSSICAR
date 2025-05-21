<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Articulo;
use App\Models\Combo;
use App\Models\Grupo;
use App\Models\Store;

class ComboFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Combo::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'combo' => fake()->numberBetween(-10000, 10000),
            'grupo' => fake()->numberBetween(-10000, 10000),
            'combo_id' => Articulo::factory(),
            'grupo_id' => Grupo::factory(),
            'cantidad' => fake()->numberBetween(-10000, 10000),
            'opcional' => fake()->boolean(),
            'orden' => fake()->numberBetween(-10000, 10000),
            'incluido' => fake()->boolean(),
            'status' => fake()->numberBetween(-10000, 10000),
            'validation_status' => fake()->randomElement(["valid","partial","invalid"]),
            'validation_errors' => '{}',
        ];
    }
}
