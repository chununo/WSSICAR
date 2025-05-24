<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Caja;
use App\Models\Cortecaja;
use App\Models\Store;

class CortecajaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cortecaja::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'cor_id' => fake()->numberBetween(-100000, 100000),
            'fecha' => fake()->dateTime(),
            'contado' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'calculado' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'diferencia' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'retiro' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'caj_id' => fake()->numberBetween(-10000, 10000),
            'caja_id' => Caja::factory(),
            'validation_status' => fake()->randomElement(["valid","partial","invalid"]),
            'validation_errors' => '{}',
        ];
    }
}
