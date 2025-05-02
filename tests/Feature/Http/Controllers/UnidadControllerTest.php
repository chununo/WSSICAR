<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Store;
use App\Models\Unidad;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\UnidadController
 */
final class UnidadControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $unidads = Unidad::factory()->count(3)->create();

        $response = $this->get(route('unidads.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UnidadController::class,
            'store',
            \App\Http\Requests\UnidadStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $store = Store::factory()->create();
        $uni_id = fake()->numberBetween(-10000, 10000);
        $nombre = fake()->word();
        $status = fake()->numberBetween(-10000, 10000);

        $response = $this->post(route('unidads.store'), [
            'store_id' => $store->id,
            'uni_id' => $uni_id,
            'nombre' => $nombre,
            'status' => $status,
        ]);

        $unidads = Unidad::query()
            ->where('store_id', $store->id)
            ->where('uni_id', $uni_id)
            ->where('nombre', $nombre)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $unidads);
        $unidad = $unidads->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $unidad = Unidad::factory()->create();

        $response = $this->get(route('unidads.show', $unidad));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\UnidadController::class,
            'update',
            \App\Http\Requests\UnidadUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $unidad = Unidad::factory()->create();
        $store = Store::factory()->create();
        $uni_id = fake()->numberBetween(-10000, 10000);
        $nombre = fake()->word();
        $status = fake()->numberBetween(-10000, 10000);

        $response = $this->put(route('unidads.update', $unidad), [
            'store_id' => $store->id,
            'uni_id' => $uni_id,
            'nombre' => $nombre,
            'status' => $status,
        ]);

        $unidad->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($store->id, $unidad->store_id);
        $this->assertEquals($uni_id, $unidad->uni_id);
        $this->assertEquals($nombre, $unidad->nombre);
        $this->assertEquals($status, $unidad->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $unidad = Unidad::factory()->create();

        $response = $this->delete(route('unidads.destroy', $unidad));

        $response->assertNoContent();

        $this->assertModelMissing($unidad);
    }
}
