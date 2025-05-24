<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Detallepromo;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\DetallepromoController
 */
final class DetallepromoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $detallepromos = Detallepromo::factory()->count(3)->create();

        $response = $this->get(route('detallepromos.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DetallepromoController::class,
            'store',
            \App\Http\Requests\DetallepromoStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $store = Store::factory()->create();
        $dpr_id = fake()->numberBetween(-10000, 10000);
        $pro_id = fake()->numberBetween(-10000, 10000);
        $tipo = fake()->numberBetween(-10000, 10000);
        $status = fake()->numberBetween(-10000, 10000);
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('detallepromos.store'), [
            'store_id' => $store->id,
            'dpr_id' => $dpr_id,
            'pro_id' => $pro_id,
            'tipo' => $tipo,
            'status' => $status,
            'validation_status' => $validation_status,
        ]);

        $detallepromos = Detallepromo::query()
            ->where('store_id', $store->id)
            ->where('dpr_id', $dpr_id)
            ->where('pro_id', $pro_id)
            ->where('tipo', $tipo)
            ->where('status', $status)
            ->where('validation_status', $validation_status)
            ->get();
        $this->assertCount(1, $detallepromos);
        $detallepromo = $detallepromos->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $detallepromo = Detallepromo::factory()->create();

        $response = $this->get(route('detallepromos.show', $detallepromo));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\DetallepromoController::class,
            'update',
            \App\Http\Requests\DetallepromoUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $detallepromo = Detallepromo::factory()->create();
        $store = Store::factory()->create();
        $dpr_id = fake()->numberBetween(-10000, 10000);
        $pro_id = fake()->numberBetween(-10000, 10000);
        $tipo = fake()->numberBetween(-10000, 10000);
        $status = fake()->numberBetween(-10000, 10000);
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('detallepromos.update', $detallepromo), [
            'store_id' => $store->id,
            'dpr_id' => $dpr_id,
            'pro_id' => $pro_id,
            'tipo' => $tipo,
            'status' => $status,
            'validation_status' => $validation_status,
        ]);

        $detallepromo->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($store->id, $detallepromo->store_id);
        $this->assertEquals($dpr_id, $detallepromo->dpr_id);
        $this->assertEquals($pro_id, $detallepromo->pro_id);
        $this->assertEquals($tipo, $detallepromo->tipo);
        $this->assertEquals($status, $detallepromo->status);
        $this->assertEquals($validation_status, $detallepromo->validation_status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $detallepromo = Detallepromo::factory()->create();

        $response = $this->delete(route('detallepromos.destroy', $detallepromo));

        $response->assertNoContent();

        $this->assertModelMissing($detallepromo);
    }
}
