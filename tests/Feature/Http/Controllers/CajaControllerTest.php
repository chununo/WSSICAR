<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Caja;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CajaController
 */
final class CajaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $cajas = Caja::factory()->count(3)->create();

        $response = $this->get(route('cajas.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CajaController::class,
            'store',
            \App\Http\Requests\CajaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $store = Store::factory()->create();
        $caj_id = fake()->numberBetween(-10000, 10000);
        $nombre = fake()->word();
        $total = fake()->randomFloat(/** decimal_attributes **/);
        $status = fake()->numberBetween(-10000, 10000);

        $response = $this->post(route('cajas.store'), [
            'store_id' => $store->id,
            'caj_id' => $caj_id,
            'nombre' => $nombre,
            'total' => $total,
            'status' => $status,
        ]);

        $cajas = Caja::query()
            ->where('store_id', $store->id)
            ->where('caj_id', $caj_id)
            ->where('nombre', $nombre)
            ->where('total', $total)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $cajas);
        $caja = $cajas->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $caja = Caja::factory()->create();

        $response = $this->get(route('cajas.show', $caja));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CajaController::class,
            'update',
            \App\Http\Requests\CajaUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $caja = Caja::factory()->create();
        $store = Store::factory()->create();
        $caj_id = fake()->numberBetween(-10000, 10000);
        $nombre = fake()->word();
        $total = fake()->randomFloat(/** decimal_attributes **/);
        $status = fake()->numberBetween(-10000, 10000);

        $response = $this->put(route('cajas.update', $caja), [
            'store_id' => $store->id,
            'caj_id' => $caj_id,
            'nombre' => $nombre,
            'total' => $total,
            'status' => $status,
        ]);

        $caja->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($store->id, $caja->store_id);
        $this->assertEquals($caj_id, $caja->caj_id);
        $this->assertEquals($nombre, $caja->nombre);
        $this->assertEquals($total, $caja->total);
        $this->assertEquals($status, $caja->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $caja = Caja::factory()->create();

        $response = $this->delete(route('cajas.destroy', $caja));

        $response->assertNoContent();

        $this->assertModelMissing($caja);
    }
}
