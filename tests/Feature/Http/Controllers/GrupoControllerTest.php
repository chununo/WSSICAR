<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Grupo;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\GrupoController
 */
final class GrupoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $grupos = Grupo::factory()->count(3)->create();

        $response = $this->get(route('grupos.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\GrupoController::class,
            'store',
            \App\Http\Requests\GrupoStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $store = Store::factory()->create();
        $gar_id = fake()->numberBetween(-10000, 10000);
        $nombre = fake()->word();
        $status = fake()->numberBetween(-10000, 10000);
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('grupos.store'), [
            'store_id' => $store->id,
            'gar_id' => $gar_id,
            'nombre' => $nombre,
            'status' => $status,
            'validation_status' => $validation_status,
        ]);

        $grupos = Grupo::query()
            ->where('store_id', $store->id)
            ->where('gar_id', $gar_id)
            ->where('nombre', $nombre)
            ->where('status', $status)
            ->where('validation_status', $validation_status)
            ->get();
        $this->assertCount(1, $grupos);
        $grupo = $grupos->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $grupo = Grupo::factory()->create();

        $response = $this->get(route('grupos.show', $grupo));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\GrupoController::class,
            'update',
            \App\Http\Requests\GrupoUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $grupo = Grupo::factory()->create();
        $store = Store::factory()->create();
        $gar_id = fake()->numberBetween(-10000, 10000);
        $nombre = fake()->word();
        $status = fake()->numberBetween(-10000, 10000);
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('grupos.update', $grupo), [
            'store_id' => $store->id,
            'gar_id' => $gar_id,
            'nombre' => $nombre,
            'status' => $status,
            'validation_status' => $validation_status,
        ]);

        $grupo->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($store->id, $grupo->store_id);
        $this->assertEquals($gar_id, $grupo->gar_id);
        $this->assertEquals($nombre, $grupo->nombre);
        $this->assertEquals($status, $grupo->status);
        $this->assertEquals($validation_status, $grupo->validation_status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $grupo = Grupo::factory()->create();

        $response = $this->delete(route('grupos.destroy', $grupo));

        $response->assertNoContent();

        $this->assertModelMissing($grupo);
    }
}
