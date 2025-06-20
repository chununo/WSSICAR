<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Store;
use App\Models\Turno;

class TurnoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Turno::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'tur_id' => fake()->numberBetween(-10000, 10000),
            'nombre' => fake()->regexify('[A-Za-z0-9]{45}'),
            'nocturno' => fake()->boolean(),
            'semana' => fake()->boolean(),
            'horaEnt' => fake()->time(),
            'horaSal' => fake()->time(),
            'lunes' => fake()->boolean(),
            'entLun' => fake()->time(),
            'salLun' => fake()->time(),
            'martes' => fake()->boolean(),
            'entMar' => fake()->time(),
            'salMar' => fake()->time(),
            'miercoles' => fake()->boolean(),
            'entMie' => fake()->time(),
            'salMie' => fake()->time(),
            'jueves' => fake()->boolean(),
            'entJue' => fake()->time(),
            'salJue' => fake()->time(),
            'viernes' => fake()->boolean(),
            'entVie' => fake()->time(),
            'salVie' => fake()->time(),
            'sabado' => fake()->boolean(),
            'entSab' => fake()->time(),
            'salSab' => fake()->time(),
            'domingo' => fake()->boolean(),
            'entDom' => fake()->time(),
            'salDom' => fake()->time(),
            'tipo' => fake()->numberBetween(-10000, 10000),
            'status' => fake()->numberBetween(-10000, 10000),
        ];
    }
}
