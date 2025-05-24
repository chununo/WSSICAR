<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Store;
use App\Models\Unidad;

class ArticuloFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Articulo::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'store_id' => Store::factory(),
            'art_id' => fake()->numberBetween(-10000, 10000),
            'clave' => fake()->regexify('[A-Za-z0-9]{45}'),
            'claveAlterna' => fake()->regexify('[A-Za-z0-9]{45}'),
            'descripcion' => fake()->regexify('[A-Za-z0-9]{1000}'),
            'servicio' => fake()->boolean(),
            'localizacion' => fake()->regexify('[A-Za-z0-9]{10}'),
            'invMin' => fake()->numberBetween(-10000, 10000),
            'invMax' => fake()->numberBetween(-10000, 10000),
            'factor' => fake()->randomFloat(3, 0, 99999999999999999.999),
            'precioCompra' => fake()->randomFloat(3, 0, 99999999999999999.999),
            'preCompraProm' => fake()->randomFloat(3, 0, 99999999999999999.999),
            'margen1' => fake()->randomFloat(6, 0, 99999999999999.999999),
            'margen2' => fake()->randomFloat(6, 0, 99999999999999.999999),
            'margen3' => fake()->randomFloat(6, 0, 99999999999999.999999),
            'margen4' => fake()->randomFloat(6, 0, 99999999999999.999999),
            'precio1' => fake()->randomFloat(6, 0, 99999999999999.999999),
            'precio2' => fake()->randomFloat(6, 0, 99999999999999.999999),
            'precio3' => fake()->randomFloat(6, 0, 99999999999999.999999),
            'precio4' => fake()->randomFloat(6, 0, 99999999999999.999999),
            'mayoreo1' => fake()->randomFloat(3, 0, 99999999999999999.999),
            'mayoreo2' => fake()->randomFloat(3, 0, 99999999999999999.999),
            'mayoreo3' => fake()->randomFloat(3, 0, 99999999999999999.999),
            'mayoreo4' => fake()->randomFloat(3, 0, 99999999999999999.999),
            'existencia' => fake()->randomFloat(4, 0, 9999999999999999.9999),
            'aislado' => fake()->randomFloat(4, 0, 9999999999999999.9999),
            'disponible' => fake()->randomFloat(4, 0, 9999999999999999.9999),
            'caracteristicas' => fake()->text(),
            'iepsActivo' => fake()->boolean(),
            'cuotaIeps' => fake()->randomFloat(4, 0, 9999999999999999.9999),
            'cuentaPredial' => fake()->regexify('[A-Za-z0-9]{45}'),
            'lote' => fake()->boolean(),
            'receta' => fake()->boolean(),
            'granel' => fake()->boolean(),
            'tipo' => fake()->numberBetween(-10000, 10000),
            'peso' => fake()->randomFloat(4, 0, 9999999999999999.9999),
            'insumo' => fake()->boolean(),
            'platillo' => fake()->boolean(),
            'favorito' => fake()->boolean(),
            'requerirPreparacion' => fake()->boolean(),
            'presentacion' => fake()->boolean(),
            'presentacionPrecio' => fake()->boolean(),
            'pesoAut' => fake()->boolean(),
            'claveProdServ' => fake()->regexify('[A-Za-z0-9]{15}'),
            'status' => fake()->numberBetween(-10000, 10000),
            'unidadCompra' => fake()->numberBetween(-10000, 10000),
            'unidadCompra_id' => Unidad::factory(),
            'unidadVenta' => fake()->numberBetween(-10000, 10000),
            'unidadVenta_id' => Unidad::factory(),
            'cat_id' => fake()->numberBetween(-10000, 10000),
            'categoria_id' => Categoria::factory(),
            'srp_id' => fake()->numberBetween(-10000, 10000),
            'mem_id' => fake()->numberBetween(-10000, 10000),
            'diasVigencia' => fake()->numberBetween(-10000, 10000),
            'prp_id' => fake()->numberBetween(-10000, 10000),
            'merma' => fake()->randomFloat(4, 0, 9999999999999999.9999),
            'rpl_id' => fake()->numberBetween(-10000, 10000),
            'imp_id' => fake()->numberBetween(-10000, 10000),
            'tipoLote' => fake()->numberBetween(-10000, 10000),
            'nombreAduana' => fake()->regexify('[A-Za-z0-9]{512}'),
            'fechaDocAduanero' => fake()->date(),
            'pedimento' => fake()->regexify('[A-Za-z0-9]{128}'),
            'oculto' => fake()->numberBetween(-10000, 10000),
            'horarioPromo' => fake()->numberBetween(-10000, 10000),
            'existenciaActivo' => fake()->randomFloat(4, 0, 9999999999999999.9999),
            'preCompraPromGas' => fake()->randomFloat(3, 0, 99999999999999999.999),
            'showEco' => fake()->boolean(),
            'etiquetaVenta' => fake()->numberBetween(-10000, 10000),
            'validation_status' => fake()->randomElement(["valid","partial","invalid"]),
            'validation_errors' => '{}',
        ];
    }
}
