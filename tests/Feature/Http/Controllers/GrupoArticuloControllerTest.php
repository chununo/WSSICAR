<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\GrupoArticulo;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\GrupoArticuloController
 */
final class GrupoArticuloControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $grupoArticulos = GrupoArticulo::factory()->count(3)->create();

        $response = $this->get(route('grupo-articulos.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\GrupoArticuloController::class,
            'store',
            \App\Http\Requests\GrupoArticuloStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $store = Store::factory()->create();
        $gar_id = fake()->numberBetween(-10000, 10000);
        $art_id = fake()->numberBetween(-10000, 10000);
        $costoExtra = fake()->randomFloat(/** decimal_attributes **/);
        $status = fake()->numberBetween(-10000, 10000);
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('grupo-articulos.store'), [
            'store_id' => $store->id,
            'gar_id' => $gar_id,
            'art_id' => $art_id,
            'costoExtra' => $costoExtra,
            'status' => $status,
            'validation_status' => $validation_status,
        ]);

        $grupoArticulos = GrupoArticulo::query()
            ->where('store_id', $store->id)
            ->where('gar_id', $gar_id)
            ->where('art_id', $art_id)
            ->where('costoExtra', $costoExtra)
            ->where('status', $status)
            ->where('validation_status', $validation_status)
            ->get();
        $this->assertCount(1, $grupoArticulos);
        $grupoArticulo = $grupoArticulos->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $grupoArticulo = GrupoArticulo::factory()->create();

        $response = $this->get(route('grupo-articulos.show', $grupoArticulo));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\GrupoArticuloController::class,
            'update',
            \App\Http\Requests\GrupoArticuloUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $grupoArticulo = GrupoArticulo::factory()->create();
        $store = Store::factory()->create();
        $gar_id = fake()->numberBetween(-10000, 10000);
        $art_id = fake()->numberBetween(-10000, 10000);
        $costoExtra = fake()->randomFloat(/** decimal_attributes **/);
        $status = fake()->numberBetween(-10000, 10000);
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('grupo-articulos.update', $grupoArticulo), [
            'store_id' => $store->id,
            'gar_id' => $gar_id,
            'art_id' => $art_id,
            'costoExtra' => $costoExtra,
            'status' => $status,
            'validation_status' => $validation_status,
        ]);

        $grupoArticulo->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($store->id, $grupoArticulo->store_id);
        $this->assertEquals($gar_id, $grupoArticulo->gar_id);
        $this->assertEquals($art_id, $grupoArticulo->art_id);
        $this->assertEquals($costoExtra, $grupoArticulo->costoExtra);
        $this->assertEquals($status, $grupoArticulo->status);
        $this->assertEquals($validation_status, $grupoArticulo->validation_status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $grupoArticulo = GrupoArticulo::factory()->create();

        $response = $this->delete(route('grupo-articulos.destroy', $grupoArticulo));

        $response->assertNoContent();

        $this->assertModelMissing($grupoArticulo);
    }
}
