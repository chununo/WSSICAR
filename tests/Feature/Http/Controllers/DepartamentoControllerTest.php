<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Departamento;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DepartamentoController
 */
final class DepartamentoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $departamentos = Departamento::factory()->count(3)->create();

        $response = $this->get(route('departamentos.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DepartamentoController::class,
            'store',
            \App\Http\Requests\DepartamentoStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $store = Store::factory()->create();
        $dep_id = fake()->numberBetween(-100000, 100000);
        $nombre = fake()->word();
        $restringido = fake()->boolean();
        $porcentaje = fake()->randomFloat(/** decimal_attributes **/);
        $system = fake()->boolean();
        $status = fake()->numberBetween(-10000, 10000);

        $response = $this->post(route('departamentos.store'), [
            'store_id' => $store->id,
            'dep_id' => $dep_id,
            'nombre' => $nombre,
            'restringido' => $restringido,
            'porcentaje' => $porcentaje,
            'system' => $system,
            'status' => $status,
        ]);

        $departamentos = Departamento::query()
            ->where('store_id', $store->id)
            ->where('dep_id', $dep_id)
            ->where('nombre', $nombre)
            ->where('restringido', $restringido)
            ->where('porcentaje', $porcentaje)
            ->where('system', $system)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $departamentos);
        $departamento = $departamentos->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $departamento = Departamento::factory()->create();

        $response = $this->get(route('departamentos.show', $departamento));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DepartamentoController::class,
            'update',
            \App\Http\Requests\DepartamentoUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $departamento = Departamento::factory()->create();
        $store = Store::factory()->create();
        $dep_id = fake()->numberBetween(-100000, 100000);
        $nombre = fake()->word();
        $restringido = fake()->boolean();
        $porcentaje = fake()->randomFloat(/** decimal_attributes **/);
        $system = fake()->boolean();
        $status = fake()->numberBetween(-10000, 10000);

        $response = $this->put(route('departamentos.update', $departamento), [
            'store_id' => $store->id,
            'dep_id' => $dep_id,
            'nombre' => $nombre,
            'restringido' => $restringido,
            'porcentaje' => $porcentaje,
            'system' => $system,
            'status' => $status,
        ]);

        $departamento->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($store->id, $departamento->store_id);
        $this->assertEquals($dep_id, $departamento->dep_id);
        $this->assertEquals($nombre, $departamento->nombre);
        $this->assertEquals($restringido, $departamento->restringido);
        $this->assertEquals($porcentaje, $departamento->porcentaje);
        $this->assertEquals($system, $departamento->system);
        $this->assertEquals($status, $departamento->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $departamento = Departamento::factory()->create();

        $response = $this->delete(route('departamentos.destroy', $departamento));

        $response->assertNoContent();

        $this->assertModelMissing($departamento);
    }
}
