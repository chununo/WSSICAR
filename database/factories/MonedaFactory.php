<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Moneda;
use App\Models\Store;

class MonedaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Moneda::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'mon_id' => fake()->numberBetween(-10000, 10000),
            'moneda' => fake()->regexify('[A-Za-z0-9]{45}'),
            'abr' => fake()->regexify('[A-Za-z0-9]{5}'),
            'tipoCambio' => fake()->randomFloat(6, 0, 99999999999999.999999),
            'singPlur' => fake()->regexify('[A-Za-z0-9]{90}'),
            'caracter' => fake()->regexify('[A-Za-z0-9]{5}'),
            'mn' => fake()->boolean(),
            'img16' => fake()->sha256(),
            'img24' => fake()->sha256(),
            'img32' => fake()->sha256(),
            'status' => fake()->numberBetween(-10000, 10000),
        ];
    }
}
