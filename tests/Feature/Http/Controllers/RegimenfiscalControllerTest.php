<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Regimenfiscal;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\RegimenfiscalController
 */
final class RegimenfiscalControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $regimenfiscals = Regimenfiscal::factory()->count(3)->create();

        $response = $this->get(route('regimenfiscals.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RegimenfiscalController::class,
            'store',
            \App\Http\Requests\RegimenfiscalStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $store = Store::factory()->create();
        $rgf_id = fake()->numberBetween(-10000, 10000);
        $clave = fake()->word();
        $descripcion = fake()->word();
        $fisica = fake()->boolean();
        $moral = fake()->boolean();

        $response = $this->post(route('regimenfiscals.store'), [
            'store_id' => $store->id,
            'rgf_id' => $rgf_id,
            'clave' => $clave,
            'descripcion' => $descripcion,
            'fisica' => $fisica,
            'moral' => $moral,
        ]);

        $regimenfiscals = Regimenfiscal::query()
            ->where('store_id', $store->id)
            ->where('rgf_id', $rgf_id)
            ->where('clave', $clave)
            ->where('descripcion', $descripcion)
            ->where('fisica', $fisica)
            ->where('moral', $moral)
            ->get();
        $this->assertCount(1, $regimenfiscals);
        $regimenfiscal = $regimenfiscals->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $regimenfiscal = Regimenfiscal::factory()->create();

        $response = $this->get(route('regimenfiscals.show', $regimenfiscal));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RegimenfiscalController::class,
            'update',
            \App\Http\Requests\RegimenfiscalUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $regimenfiscal = Regimenfiscal::factory()->create();
        $store = Store::factory()->create();
        $rgf_id = fake()->numberBetween(-10000, 10000);
        $clave = fake()->word();
        $descripcion = fake()->word();
        $fisica = fake()->boolean();
        $moral = fake()->boolean();

        $response = $this->put(route('regimenfiscals.update', $regimenfiscal), [
            'store_id' => $store->id,
            'rgf_id' => $rgf_id,
            'clave' => $clave,
            'descripcion' => $descripcion,
            'fisica' => $fisica,
            'moral' => $moral,
        ]);

        $regimenfiscal->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($store->id, $regimenfiscal->store_id);
        $this->assertEquals($rgf_id, $regimenfiscal->rgf_id);
        $this->assertEquals($clave, $regimenfiscal->clave);
        $this->assertEquals($descripcion, $regimenfiscal->descripcion);
        $this->assertEquals($fisica, $regimenfiscal->fisica);
        $this->assertEquals($moral, $regimenfiscal->moral);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $regimenfiscal = Regimenfiscal::factory()->create();

        $response = $this->delete(route('regimenfiscals.destroy', $regimenfiscal));

        $response->assertNoContent();

        $this->assertModelMissing($regimenfiscal);
    }
}
