<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Store;
use App\Models\Vacacion;
use App\Models\Vacacione;

class VacacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vacacion::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'vac_id' => fake()->numberBetween(-10000, 10000),
            'nombre' => fake()->regexify('[A-Za-z0-9]{255}'),
            'minimo' => fake()->numberBetween(-10000, 10000),
            'a1' => fake()->numberBetween(-10000, 10000),
            'a2' => fake()->numberBetween(-10000, 10000),
            'a3' => fake()->numberBetween(-10000, 10000),
            'a4' => fake()->numberBetween(-10000, 10000),
            'a5' => fake()->numberBetween(-10000, 10000),
            'a6' => fake()->numberBetween(-10000, 10000),
            'a7' => fake()->numberBetween(-10000, 10000),
            'a8' => fake()->numberBetween(-10000, 10000),
            'a9' => fake()->numberBetween(-10000, 10000),
            'a10' => fake()->numberBetween(-10000, 10000),
            'a11' => fake()->numberBetween(-10000, 10000),
            'a12' => fake()->numberBetween(-10000, 10000),
            'a13' => fake()->numberBetween(-10000, 10000),
            'a14' => fake()->numberBetween(-10000, 10000),
            'a15' => fake()->numberBetween(-10000, 10000),
            'a16' => fake()->numberBetween(-10000, 10000),
            'a17' => fake()->numberBetween(-10000, 10000),
            'a18' => fake()->numberBetween(-10000, 10000),
            'a19' => fake()->numberBetween(-10000, 10000),
            'a20' => fake()->numberBetween(-10000, 10000),
            'a21' => fake()->numberBetween(-10000, 10000),
            'a22' => fake()->numberBetween(-10000, 10000),
            'a23' => fake()->numberBetween(-10000, 10000),
            'a24' => fake()->numberBetween(-10000, 10000),
            'a25' => fake()->numberBetween(-10000, 10000),
            'a26' => fake()->numberBetween(-10000, 10000),
            'a27' => fake()->numberBetween(-10000, 10000),
            'a28' => fake()->numberBetween(-10000, 10000),
            'a29' => fake()->numberBetween(-10000, 10000),
            'a30' => fake()->numberBetween(-10000, 10000),
            'a31' => fake()->numberBetween(-10000, 10000),
            'a32' => fake()->numberBetween(-10000, 10000),
            'a33' => fake()->numberBetween(-10000, 10000),
            'a34' => fake()->numberBetween(-10000, 10000),
            'a35' => fake()->numberBetween(-10000, 10000),
            'a36' => fake()->numberBetween(-10000, 10000),
            'a37' => fake()->numberBetween(-10000, 10000),
            'a38' => fake()->numberBetween(-10000, 10000),
            'a39' => fake()->numberBetween(-10000, 10000),
            'a40' => fake()->numberBetween(-10000, 10000),
            'fechaVigorReemplazo' => fake()->date(),
            'vacacionReemplazo' => fake()->numberBetween(-10000, 10000),
            'vacacionreemplazo_id' => Vacacione::factory(),
            'validation_status' => fake()->randomElement(["valid","partial","invalid"]),
            'validation_errors' => '{}',
        ];
    }
}
