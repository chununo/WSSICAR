<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Grupocliente;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\GrupoclienteController
 */
final class GrupoclienteControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $grupoclientes = Grupocliente::factory()->count(3)->create();

        $response = $this->get(route('grupoclientes.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\GrupoclienteController::class,
            'store',
            \App\Http\Requests\GrupoclienteStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $store = Store::factory()->create();
        $grc_id = fake()->numberBetween(-10000, 10000);
        $descripcion = fake()->word();
        $precio = fake()->numberBetween(-10000, 10000);
        $precioObligatorio = fake()->boolean();
        $status = fake()->numberBetween(-10000, 10000);

        $response = $this->post(route('grupoclientes.store'), [
            'store_id' => $store->id,
            'grc_id' => $grc_id,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'precioObligatorio' => $precioObligatorio,
            'status' => $status,
        ]);

        $grupoclientes = Grupocliente::query()
            ->where('store_id', $store->id)
            ->where('grc_id', $grc_id)
            ->where('descripcion', $descripcion)
            ->where('precio', $precio)
            ->where('precioObligatorio', $precioObligatorio)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $grupoclientes);
        $grupocliente = $grupoclientes->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $grupocliente = Grupocliente::factory()->create();

        $response = $this->get(route('grupoclientes.show', $grupocliente));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\GrupoclienteController::class,
            'update',
            \App\Http\Requests\GrupoclienteUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $grupocliente = Grupocliente::factory()->create();
        $store = Store::factory()->create();
        $grc_id = fake()->numberBetween(-10000, 10000);
        $descripcion = fake()->word();
        $precio = fake()->numberBetween(-10000, 10000);
        $precioObligatorio = fake()->boolean();
        $status = fake()->numberBetween(-10000, 10000);

        $response = $this->put(route('grupoclientes.update', $grupocliente), [
            'store_id' => $store->id,
            'grc_id' => $grc_id,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'precioObligatorio' => $precioObligatorio,
            'status' => $status,
        ]);

        $grupocliente->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($store->id, $grupocliente->store_id);
        $this->assertEquals($grc_id, $grupocliente->grc_id);
        $this->assertEquals($descripcion, $grupocliente->descripcion);
        $this->assertEquals($precio, $grupocliente->precio);
        $this->assertEquals($precioObligatorio, $grupocliente->precioObligatorio);
        $this->assertEquals($status, $grupocliente->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $grupocliente = Grupocliente::factory()->create();

        $response = $this->delete(route('grupoclientes.destroy', $grupocliente));

        $response->assertNoContent();

        $this->assertModelMissing($grupocliente);
    }
}
