<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\HorarioPromo;
use App\Models\Store;

class HorarioPromoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HorarioPromo::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'hor_id' => fake()->numberBetween(-10000, 10000),
            'nombre' => fake()->regexify('[A-Za-z0-9]{45}'),
            'lunes' => fake()->boolean(),
            'iniLun' => fake()->time(),
            'finLun' => fake()->time(),
            'martes' => fake()->boolean(),
            'iniMar' => fake()->time(),
            'finMar' => fake()->time(),
            'miercoles' => fake()->boolean(),
            'iniMie' => fake()->time(),
            'finMie' => fake()->time(),
            'jueves' => fake()->boolean(),
            'iniJue' => fake()->time(),
            'finJue' => fake()->time(),
            'viernes' => fake()->boolean(),
            'iniVie' => fake()->time(),
            'finVie' => fake()->time(),
            'sabado' => fake()->boolean(),
            'iniSab' => fake()->time(),
            'finSab' => fake()->time(),
            'domingo' => fake()->boolean(),
            'iniDom' => fake()->time(),
            'finDom' => fake()->time(),
            'status' => fake()->numberBetween(-10000, 10000),
        ];
    }
}
