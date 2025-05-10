<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Articulo;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ArticuloController
 */
final class ArticuloControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $articulos = Articulo::factory()->count(3)->create();

        $response = $this->get(route('articulos.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ArticuloController::class,
            'store',
            \App\Http\Requests\ArticuloStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $store = Store::factory()->create();
        $art_id = fake()->numberBetween(-10000, 10000);
        $clave = fake()->word();
        $claveAlterna = fake()->word();
        $descripcion = fake()->word();
        $servicio = fake()->boolean();
        $localizacion = fake()->word();
        $invMin = fake()->numberBetween(-10000, 10000);
        $invMax = fake()->numberBetween(-10000, 10000);
        $factor = fake()->randomFloat(/** decimal_attributes **/);
        $precioCompra = fake()->randomFloat(/** decimal_attributes **/);
        $preCompraProm = fake()->randomFloat(/** decimal_attributes **/);
        $margen1 = fake()->randomFloat(/** decimal_attributes **/);
        $margen2 = fake()->randomFloat(/** decimal_attributes **/);
        $margen3 = fake()->randomFloat(/** decimal_attributes **/);
        $margen4 = fake()->randomFloat(/** decimal_attributes **/);
        $precio1 = fake()->randomFloat(/** decimal_attributes **/);
        $precio2 = fake()->randomFloat(/** decimal_attributes **/);
        $precio3 = fake()->randomFloat(/** decimal_attributes **/);
        $precio4 = fake()->randomFloat(/** decimal_attributes **/);
        $mayoreo1 = fake()->randomFloat(/** decimal_attributes **/);
        $mayoreo2 = fake()->randomFloat(/** decimal_attributes **/);
        $mayoreo3 = fake()->randomFloat(/** decimal_attributes **/);
        $mayoreo4 = fake()->randomFloat(/** decimal_attributes **/);
        $existencia = fake()->randomFloat(/** decimal_attributes **/);
        $aislado = fake()->randomFloat(/** decimal_attributes **/);
        $disponible = fake()->randomFloat(/** decimal_attributes **/);
        $caracteristicas = fake()->text();
        $iepsActivo = fake()->boolean();
        $cuotaIeps = fake()->randomFloat(/** decimal_attributes **/);
        $cuentaPredial = fake()->word();
        $lote = fake()->boolean();
        $receta = fake()->boolean();
        $granel = fake()->boolean();
        $tipo = fake()->numberBetween(-10000, 10000);
        $peso = fake()->randomFloat(/** decimal_attributes **/);
        $insumo = fake()->boolean();
        $platillo = fake()->boolean();
        $favorito = fake()->boolean();
        $requerirPreparacion = fake()->boolean();
        $presentacion = fake()->boolean();
        $presentacionPrecio = fake()->boolean();
        $pesoAut = fake()->boolean();
        $status = fake()->numberBetween(-10000, 10000);
        $unidadCompra = fake()->numberBetween(-10000, 10000);
        $unidadVenta = fake()->numberBetween(-10000, 10000);
        $cat_id = fake()->numberBetween(-10000, 10000);
        $showEco = fake()->boolean();
        $etiquetaVenta = fake()->numberBetween(-10000, 10000);
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('articulos.store'), [
            'store_id' => $store->id,
            'art_id' => $art_id,
            'clave' => $clave,
            'claveAlterna' => $claveAlterna,
            'descripcion' => $descripcion,
            'servicio' => $servicio,
            'localizacion' => $localizacion,
            'invMin' => $invMin,
            'invMax' => $invMax,
            'factor' => $factor,
            'precioCompra' => $precioCompra,
            'preCompraProm' => $preCompraProm,
            'margen1' => $margen1,
            'margen2' => $margen2,
            'margen3' => $margen3,
            'margen4' => $margen4,
            'precio1' => $precio1,
            'precio2' => $precio2,
            'precio3' => $precio3,
            'precio4' => $precio4,
            'mayoreo1' => $mayoreo1,
            'mayoreo2' => $mayoreo2,
            'mayoreo3' => $mayoreo3,
            'mayoreo4' => $mayoreo4,
            'existencia' => $existencia,
            'aislado' => $aislado,
            'disponible' => $disponible,
            'caracteristicas' => $caracteristicas,
            'iepsActivo' => $iepsActivo,
            'cuotaIeps' => $cuotaIeps,
            'cuentaPredial' => $cuentaPredial,
            'lote' => $lote,
            'receta' => $receta,
            'granel' => $granel,
            'tipo' => $tipo,
            'peso' => $peso,
            'insumo' => $insumo,
            'platillo' => $platillo,
            'favorito' => $favorito,
            'requerirPreparacion' => $requerirPreparacion,
            'presentacion' => $presentacion,
            'presentacionPrecio' => $presentacionPrecio,
            'pesoAut' => $pesoAut,
            'status' => $status,
            'unidadCompra' => $unidadCompra,
            'unidadVenta' => $unidadVenta,
            'cat_id' => $cat_id,
            'showEco' => $showEco,
            'etiquetaVenta' => $etiquetaVenta,
            'validation_status' => $validation_status,
        ]);

        $articulos = Articulo::query()
            ->where('store_id', $store->id)
            ->where('art_id', $art_id)
            ->where('clave', $clave)
            ->where('claveAlterna', $claveAlterna)
            ->where('descripcion', $descripcion)
            ->where('servicio', $servicio)
            ->where('localizacion', $localizacion)
            ->where('invMin', $invMin)
            ->where('invMax', $invMax)
            ->where('factor', $factor)
            ->where('precioCompra', $precioCompra)
            ->where('preCompraProm', $preCompraProm)
            ->where('margen1', $margen1)
            ->where('margen2', $margen2)
            ->where('margen3', $margen3)
            ->where('margen4', $margen4)
            ->where('precio1', $precio1)
            ->where('precio2', $precio2)
            ->where('precio3', $precio3)
            ->where('precio4', $precio4)
            ->where('mayoreo1', $mayoreo1)
            ->where('mayoreo2', $mayoreo2)
            ->where('mayoreo3', $mayoreo3)
            ->where('mayoreo4', $mayoreo4)
            ->where('existencia', $existencia)
            ->where('aislado', $aislado)
            ->where('disponible', $disponible)
            ->where('caracteristicas', $caracteristicas)
            ->where('iepsActivo', $iepsActivo)
            ->where('cuotaIeps', $cuotaIeps)
            ->where('cuentaPredial', $cuentaPredial)
            ->where('lote', $lote)
            ->where('receta', $receta)
            ->where('granel', $granel)
            ->where('tipo', $tipo)
            ->where('peso', $peso)
            ->where('insumo', $insumo)
            ->where('platillo', $platillo)
            ->where('favorito', $favorito)
            ->where('requerirPreparacion', $requerirPreparacion)
            ->where('presentacion', $presentacion)
            ->where('presentacionPrecio', $presentacionPrecio)
            ->where('pesoAut', $pesoAut)
            ->where('status', $status)
            ->where('unidadCompra', $unidadCompra)
            ->where('unidadVenta', $unidadVenta)
            ->where('cat_id', $cat_id)
            ->where('showEco', $showEco)
            ->where('etiquetaVenta', $etiquetaVenta)
            ->where('validation_status', $validation_status)
            ->get();
        $this->assertCount(1, $articulos);
        $articulo = $articulos->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $articulo = Articulo::factory()->create();

        $response = $this->get(route('articulos.show', $articulo));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ArticuloController::class,
            'update',
            \App\Http\Requests\ArticuloUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $articulo = Articulo::factory()->create();
        $store = Store::factory()->create();
        $art_id = fake()->numberBetween(-10000, 10000);
        $clave = fake()->word();
        $claveAlterna = fake()->word();
        $descripcion = fake()->word();
        $servicio = fake()->boolean();
        $localizacion = fake()->word();
        $invMin = fake()->numberBetween(-10000, 10000);
        $invMax = fake()->numberBetween(-10000, 10000);
        $factor = fake()->randomFloat(/** decimal_attributes **/);
        $precioCompra = fake()->randomFloat(/** decimal_attributes **/);
        $preCompraProm = fake()->randomFloat(/** decimal_attributes **/);
        $margen1 = fake()->randomFloat(/** decimal_attributes **/);
        $margen2 = fake()->randomFloat(/** decimal_attributes **/);
        $margen3 = fake()->randomFloat(/** decimal_attributes **/);
        $margen4 = fake()->randomFloat(/** decimal_attributes **/);
        $precio1 = fake()->randomFloat(/** decimal_attributes **/);
        $precio2 = fake()->randomFloat(/** decimal_attributes **/);
        $precio3 = fake()->randomFloat(/** decimal_attributes **/);
        $precio4 = fake()->randomFloat(/** decimal_attributes **/);
        $mayoreo1 = fake()->randomFloat(/** decimal_attributes **/);
        $mayoreo2 = fake()->randomFloat(/** decimal_attributes **/);
        $mayoreo3 = fake()->randomFloat(/** decimal_attributes **/);
        $mayoreo4 = fake()->randomFloat(/** decimal_attributes **/);
        $existencia = fake()->randomFloat(/** decimal_attributes **/);
        $aislado = fake()->randomFloat(/** decimal_attributes **/);
        $disponible = fake()->randomFloat(/** decimal_attributes **/);
        $caracteristicas = fake()->text();
        $iepsActivo = fake()->boolean();
        $cuotaIeps = fake()->randomFloat(/** decimal_attributes **/);
        $cuentaPredial = fake()->word();
        $lote = fake()->boolean();
        $receta = fake()->boolean();
        $granel = fake()->boolean();
        $tipo = fake()->numberBetween(-10000, 10000);
        $peso = fake()->randomFloat(/** decimal_attributes **/);
        $insumo = fake()->boolean();
        $platillo = fake()->boolean();
        $favorito = fake()->boolean();
        $requerirPreparacion = fake()->boolean();
        $presentacion = fake()->boolean();
        $presentacionPrecio = fake()->boolean();
        $pesoAut = fake()->boolean();
        $status = fake()->numberBetween(-10000, 10000);
        $unidadCompra = fake()->numberBetween(-10000, 10000);
        $unidadVenta = fake()->numberBetween(-10000, 10000);
        $cat_id = fake()->numberBetween(-10000, 10000);
        $showEco = fake()->boolean();
        $etiquetaVenta = fake()->numberBetween(-10000, 10000);
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('articulos.update', $articulo), [
            'store_id' => $store->id,
            'art_id' => $art_id,
            'clave' => $clave,
            'claveAlterna' => $claveAlterna,
            'descripcion' => $descripcion,
            'servicio' => $servicio,
            'localizacion' => $localizacion,
            'invMin' => $invMin,
            'invMax' => $invMax,
            'factor' => $factor,
            'precioCompra' => $precioCompra,
            'preCompraProm' => $preCompraProm,
            'margen1' => $margen1,
            'margen2' => $margen2,
            'margen3' => $margen3,
            'margen4' => $margen4,
            'precio1' => $precio1,
            'precio2' => $precio2,
            'precio3' => $precio3,
            'precio4' => $precio4,
            'mayoreo1' => $mayoreo1,
            'mayoreo2' => $mayoreo2,
            'mayoreo3' => $mayoreo3,
            'mayoreo4' => $mayoreo4,
            'existencia' => $existencia,
            'aislado' => $aislado,
            'disponible' => $disponible,
            'caracteristicas' => $caracteristicas,
            'iepsActivo' => $iepsActivo,
            'cuotaIeps' => $cuotaIeps,
            'cuentaPredial' => $cuentaPredial,
            'lote' => $lote,
            'receta' => $receta,
            'granel' => $granel,
            'tipo' => $tipo,
            'peso' => $peso,
            'insumo' => $insumo,
            'platillo' => $platillo,
            'favorito' => $favorito,
            'requerirPreparacion' => $requerirPreparacion,
            'presentacion' => $presentacion,
            'presentacionPrecio' => $presentacionPrecio,
            'pesoAut' => $pesoAut,
            'status' => $status,
            'unidadCompra' => $unidadCompra,
            'unidadVenta' => $unidadVenta,
            'cat_id' => $cat_id,
            'showEco' => $showEco,
            'etiquetaVenta' => $etiquetaVenta,
            'validation_status' => $validation_status,
        ]);

        $articulo->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($store->id, $articulo->store_id);
        $this->assertEquals($art_id, $articulo->art_id);
        $this->assertEquals($clave, $articulo->clave);
        $this->assertEquals($claveAlterna, $articulo->claveAlterna);
        $this->assertEquals($descripcion, $articulo->descripcion);
        $this->assertEquals($servicio, $articulo->servicio);
        $this->assertEquals($localizacion, $articulo->localizacion);
        $this->assertEquals($invMin, $articulo->invMin);
        $this->assertEquals($invMax, $articulo->invMax);
        $this->assertEquals($factor, $articulo->factor);
        $this->assertEquals($precioCompra, $articulo->precioCompra);
        $this->assertEquals($preCompraProm, $articulo->preCompraProm);
        $this->assertEquals($margen1, $articulo->margen1);
        $this->assertEquals($margen2, $articulo->margen2);
        $this->assertEquals($margen3, $articulo->margen3);
        $this->assertEquals($margen4, $articulo->margen4);
        $this->assertEquals($precio1, $articulo->precio1);
        $this->assertEquals($precio2, $articulo->precio2);
        $this->assertEquals($precio3, $articulo->precio3);
        $this->assertEquals($precio4, $articulo->precio4);
        $this->assertEquals($mayoreo1, $articulo->mayoreo1);
        $this->assertEquals($mayoreo2, $articulo->mayoreo2);
        $this->assertEquals($mayoreo3, $articulo->mayoreo3);
        $this->assertEquals($mayoreo4, $articulo->mayoreo4);
        $this->assertEquals($existencia, $articulo->existencia);
        $this->assertEquals($aislado, $articulo->aislado);
        $this->assertEquals($disponible, $articulo->disponible);
        $this->assertEquals($caracteristicas, $articulo->caracteristicas);
        $this->assertEquals($iepsActivo, $articulo->iepsActivo);
        $this->assertEquals($cuotaIeps, $articulo->cuotaIeps);
        $this->assertEquals($cuentaPredial, $articulo->cuentaPredial);
        $this->assertEquals($lote, $articulo->lote);
        $this->assertEquals($receta, $articulo->receta);
        $this->assertEquals($granel, $articulo->granel);
        $this->assertEquals($tipo, $articulo->tipo);
        $this->assertEquals($peso, $articulo->peso);
        $this->assertEquals($insumo, $articulo->insumo);
        $this->assertEquals($platillo, $articulo->platillo);
        $this->assertEquals($favorito, $articulo->favorito);
        $this->assertEquals($requerirPreparacion, $articulo->requerirPreparacion);
        $this->assertEquals($presentacion, $articulo->presentacion);
        $this->assertEquals($presentacionPrecio, $articulo->presentacionPrecio);
        $this->assertEquals($pesoAut, $articulo->pesoAut);
        $this->assertEquals($status, $articulo->status);
        $this->assertEquals($unidadCompra, $articulo->unidadCompra);
        $this->assertEquals($unidadVenta, $articulo->unidadVenta);
        $this->assertEquals($cat_id, $articulo->cat_id);
        $this->assertEquals($showEco, $articulo->showEco);
        $this->assertEquals($etiquetaVenta, $articulo->etiquetaVenta);
        $this->assertEquals($validation_status, $articulo->validation_status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $articulo = Articulo::factory()->create();

        $response = $this->delete(route('articulos.destroy', $articulo));

        $response->assertNoContent();

        $this->assertModelMissing($articulo);
    }
}
