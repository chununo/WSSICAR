<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Regimenfiscal;
use App\Models\Store;

class RegimenfiscalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Regimenfiscal::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'rgf_id' => fake()->numberBetween(-10000, 10000),
            'clave' => fake()->regexify('[A-Za-z0-9]{5}'),
            'descripcion' => fake()->regexify('[A-Za-z0-9]{255}'),
            'fisica' => fake()->boolean(),
            'moral' => fake()->boolean(),
        ];
    }
}
