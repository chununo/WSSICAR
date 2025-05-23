<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Promocion;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PromocionController
 */
final class PromocionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $promocions = Promocion::factory()->count(3)->create();

        $response = $this->get(route('promocions.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PromocionController::class,
            'store',
            \App\Http\Requests\PromocionStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $store = Store::factory()->create();
        $pro_id = fake()->numberBetween(-10000, 10000);
        $nombre = fake()->word();
        $fechaIni = Carbon::parse(fake()->date());
        $fechaFin = Carbon::parse(fake()->date());
        $condicion = fake()->boolean();
        $cascada = fake()->boolean();
        $status = fake()->numberBetween(-10000, 10000);
        $sincronizar = fake()->boolean();
        $mixto = fake()->boolean();
        $mostrarComensal = fake()->boolean();
        $artReq = fake()->boolean();
        $artReqMixto = fake()->boolean();
        $clientes = fake()->boolean();
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('promocions.store'), [
            'store_id' => $store->id,
            'pro_id' => $pro_id,
            'nombre' => $nombre,
            'fechaIni' => $fechaIni->toDateString(),
            'fechaFin' => $fechaFin->toDateString(),
            'condicion' => $condicion,
            'cascada' => $cascada,
            'status' => $status,
            'sincronizar' => $sincronizar,
            'mixto' => $mixto,
            'mostrarComensal' => $mostrarComensal,
            'artReq' => $artReq,
            'artReqMixto' => $artReqMixto,
            'clientes' => $clientes,
            'validation_status' => $validation_status,
        ]);

        $promocions = Promocion::query()
            ->where('store_id', $store->id)
            ->where('pro_id', $pro_id)
            ->where('nombre', $nombre)
            ->where('fechaIni', $fechaIni)
            ->where('fechaFin', $fechaFin)
            ->where('condicion', $condicion)
            ->where('cascada', $cascada)
            ->where('status', $status)
            ->where('sincronizar', $sincronizar)
            ->where('mixto', $mixto)
            ->where('mostrarComensal', $mostrarComensal)
            ->where('artReq', $artReq)
            ->where('artReqMixto', $artReqMixto)
            ->where('clientes', $clientes)
            ->where('validation_status', $validation_status)
            ->get();
        $this->assertCount(1, $promocions);
        $promocion = $promocions->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $promocion = Promocion::factory()->create();

        $response = $this->get(route('promocions.show', $promocion));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PromocionController::class,
            'update',
            \App\Http\Requests\PromocionUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $promocion = Promocion::factory()->create();
        $store = Store::factory()->create();
        $pro_id = fake()->numberBetween(-10000, 10000);
        $nombre = fake()->word();
        $fechaIni = Carbon::parse(fake()->date());
        $fechaFin = Carbon::parse(fake()->date());
        $condicion = fake()->boolean();
        $cascada = fake()->boolean();
        $status = fake()->numberBetween(-10000, 10000);
        $sincronizar = fake()->boolean();
        $mixto = fake()->boolean();
        $mostrarComensal = fake()->boolean();
        $artReq = fake()->boolean();
        $artReqMixto = fake()->boolean();
        $clientes = fake()->boolean();
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('promocions.update', $promocion), [
            'store_id' => $store->id,
            'pro_id' => $pro_id,
            'nombre' => $nombre,
            'fechaIni' => $fechaIni->toDateString(),
            'fechaFin' => $fechaFin->toDateString(),
            'condicion' => $condicion,
            'cascada' => $cascada,
            'status' => $status,
            'sincronizar' => $sincronizar,
            'mixto' => $mixto,
            'mostrarComensal' => $mostrarComensal,
            'artReq' => $artReq,
            'artReqMixto' => $artReqMixto,
            'clientes' => $clientes,
            'validation_status' => $validation_status,
        ]);

        $promocion->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($store->id, $promocion->store_id);
        $this->assertEquals($pro_id, $promocion->pro_id);
        $this->assertEquals($nombre, $promocion->nombre);
        $this->assertEquals($fechaIni, $promocion->fechaIni);
        $this->assertEquals($fechaFin, $promocion->fechaFin);
        $this->assertEquals($condicion, $promocion->condicion);
        $this->assertEquals($cascada, $promocion->cascada);
        $this->assertEquals($status, $promocion->status);
        $this->assertEquals($sincronizar, $promocion->sincronizar);
        $this->assertEquals($mixto, $promocion->mixto);
        $this->assertEquals($mostrarComensal, $promocion->mostrarComensal);
        $this->assertEquals($artReq, $promocion->artReq);
        $this->assertEquals($artReqMixto, $promocion->artReqMixto);
        $this->assertEquals($clientes, $promocion->clientes);
        $this->assertEquals($validation_status, $promocion->validation_status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $promocion = Promocion::factory()->create();

        $response = $this->delete(route('promocions.destroy', $promocion));

        $response->assertNoContent();

        $this->assertModelMissing($promocion);
    }
}
