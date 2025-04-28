<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Categoria;
use App\Models\Categorium;
use App\Models\Departamento;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CategoriaController
 */
final class CategoriaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $categoria = Categoria::factory()->count(3)->create();

        $response = $this->get(route('categoria.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CategoriaController::class,
            'store',
            \App\Http\Requests\CategoriaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $store = Store::factory()->create();
        $cat_id = fake()->numberBetween(-100000, 100000);
        $nombre = fake()->word();
        $system = fake()->boolean();
        $status = fake()->numberBetween(-10000, 10000);
        $departamento = Departamento::factory()->create();
        $dep_id = fake()->numberBetween(-100000, 100000);

        $response = $this->post(route('categoria.store'), [
            'store_id' => $store->id,
            'cat_id' => $cat_id,
            'nombre' => $nombre,
            'system' => $system,
            'status' => $status,
            'departamento_id' => $departamento->id,
            'dep_id' => $dep_id,
        ]);

        $categoria = Categorium::query()
            ->where('store_id', $store->id)
            ->where('cat_id', $cat_id)
            ->where('nombre', $nombre)
            ->where('system', $system)
            ->where('status', $status)
            ->where('departamento_id', $departamento->id)
            ->where('dep_id', $dep_id)
            ->get();
        $this->assertCount(1, $categoria);
        $categorium = $categoria->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $categorium = Categoria::factory()->create();

        $response = $this->get(route('categoria.show', $categorium));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CategoriaController::class,
            'update',
            \App\Http\Requests\CategoriaUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $categorium = Categoria::factory()->create();
        $store = Store::factory()->create();
        $cat_id = fake()->numberBetween(-100000, 100000);
        $nombre = fake()->word();
        $system = fake()->boolean();
        $status = fake()->numberBetween(-10000, 10000);
        $departamento = Departamento::factory()->create();
        $dep_id = fake()->numberBetween(-100000, 100000);

        $response = $this->put(route('categoria.update', $categorium), [
            'store_id' => $store->id,
            'cat_id' => $cat_id,
            'nombre' => $nombre,
            'system' => $system,
            'status' => $status,
            'departamento_id' => $departamento->id,
            'dep_id' => $dep_id,
        ]);

        $categorium->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($store->id, $categorium->store_id);
        $this->assertEquals($cat_id, $categorium->cat_id);
        $this->assertEquals($nombre, $categorium->nombre);
        $this->assertEquals($system, $categorium->system);
        $this->assertEquals($status, $categorium->status);
        $this->assertEquals($departamento->id, $categorium->departamento_id);
        $this->assertEquals($dep_id, $categorium->dep_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $categorium = Categoria::factory()->create();
        $categorium = Categorium::factory()->create();

        $response = $this->delete(route('categoria.destroy', $categorium));

        $response->assertNoContent();

        $this->assertModelMissing($categorium);
    }
}
