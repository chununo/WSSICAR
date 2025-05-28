<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Cliente;
use App\Models\Grupocliente;
use App\Models\Regimenfiscale;
use App\Models\Store;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'cli_id' => fake()->numberBetween(-10000, 10000),
            'nombre' => fake()->regexify('[A-Za-z0-9]{1000}'),
            'representante' => fake()->regexify('[A-Za-z0-9]{1000}'),
            'domicilio' => fake()->regexify('[A-Za-z0-9]{120}'),
            'noExt' => fake()->regexify('[A-Za-z0-9]{45}'),
            'noInt' => fake()->regexify('[A-Za-z0-9]{45}'),
            'localidad' => fake()->regexify('[A-Za-z0-9]{120}'),
            'ciudad' => fake()->regexify('[A-Za-z0-9]{120}'),
            'estado' => fake()->regexify('[A-Za-z0-9]{45}'),
            'pais' => fake()->regexify('[A-Za-z0-9]{45}'),
            'codigoPostal' => fake()->regexify('[A-Za-z0-9]{10}'),
            'colonia' => fake()->regexify('[A-Za-z0-9]{45}'),
            'rfc' => fake()->regexify('[A-Za-z0-9]{45}'),
            'curp' => fake()->regexify('[A-Za-z0-9]{45}'),
            'telefono' => fake()->regexify('[A-Za-z0-9]{45}'),
            'celular' => fake()->regexify('[A-Za-z0-9]{45}'),
            'mail' => fake()->regexify('[A-Za-z0-9]{255}'),
            'comentario' => fake()->regexify('[A-Za-z0-9]{255}'),
            'status' => fake()->numberBetween(-10000, 10000),
            'limite' => fake()->randomFloat(2, 0, 999999999999999999.99),
            'precio' => fake()->numberBetween(-10000, 10000),
            'diasCredito' => fake()->numberBetween(-10000, 10000),
            'retener' => fake()->boolean(),
            'desglosarIEPS' => fake()->boolean(),
            'notificar' => fake()->boolean(),
            'clave' => fake()->regexify('[A-Za-z0-9]{45}'),
            'foto' => fake()->sha256(),
            'huella' => fake()->sha256(),
            'muestra' => fake()->sha256(),
            'usoCfdi' => fake()->regexify('[A-Za-z0-9]{10}'),
            'idCIF' => fake()->regexify('[A-Za-z0-9]{20}'),
            'sid' => fake()->regexify('[A-Za-z0-9]{15}'),
            'eduNivel' => fake()->regexify('[A-Za-z0-9]{128}'),
            'eduClave' => fake()->regexify('[A-Za-z0-9]{128}'),
            'eduRfc' => fake()->regexify('[A-Za-z0-9]{45}'),
            'eduNombre' => fake()->regexify('[A-Za-z0-9]{120}'),
            'grc_id' => fake()->numberBetween(-10000, 10000),
            'grupocliente_id' => Grupocliente::factory(),
            'rgf_id' => fake()->numberBetween(-10000, 10000),
            'regimenfiscal_id' => Regimenfiscale::factory(),
            'validation_status' => fake()->randomElement(["valid","partial","invalid"]),
            'validation_errors' => '{}',
        ];
    }
}
