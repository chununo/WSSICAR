<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Cortecaja;
use App\Models\Resumencortecaja;
use App\Models\Store;

class ResumencortecajaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resumencortecaja::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'rcc_id' => fake()->numberBetween(-10000, 10000),
            'cor_id' => fake()->numberBetween(-10000, 10000),
            'cortecaja_id' => Cortecaja::factory(),
            'venCon' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'venCre' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'venConC' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'venCreC' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'comCon' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'comCre' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'comConC' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'comCreC' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'notCre' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'notCreC' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'entVen' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'entCre' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'entComC' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'entNotC' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'entMov' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'salCom' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'salCre' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'salVenC' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'salNot' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'salMov' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'gasCon' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'gasCre' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'gasConC' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'gasCreC' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'notCrePro' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'notCreProC' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'entGasC' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'salNotProC' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'salGas' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'entNotPro' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'validation_status' => fake()->randomElement(["valid","partial","invalid"]),
            'validation_errors' => '{}',
        ];
    }
}
