<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Cortecaja;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CortecajaController
 */
final class CortecajaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $cortecajas = Cortecaja::factory()->count(3)->create();

        $response = $this->get(route('cortecajas.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CortecajaController::class,
            'store',
            \App\Http\Requests\CortecajaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $store = Store::factory()->create();
        $cor_id = fake()->numberBetween(-100000, 100000);
        $fecha = Carbon::parse(fake()->dateTime());
        $contado = fake()->randomFloat(/** decimal_attributes **/);
        $calculado = fake()->randomFloat(/** decimal_attributes **/);
        $diferencia = fake()->randomFloat(/** decimal_attributes **/);
        $retiro = fake()->randomFloat(/** decimal_attributes **/);
        $caj_id = fake()->numberBetween(-10000, 10000);
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('cortecajas.store'), [
            'store_id' => $store->id,
            'cor_id' => $cor_id,
            'fecha' => $fecha->toDateTimeString(),
            'contado' => $contado,
            'calculado' => $calculado,
            'diferencia' => $diferencia,
            'retiro' => $retiro,
            'caj_id' => $caj_id,
            'validation_status' => $validation_status,
        ]);

        $cortecajas = Cortecaja::query()
            ->where('store_id', $store->id)
            ->where('cor_id', $cor_id)
            ->where('fecha', $fecha)
            ->where('contado', $contado)
            ->where('calculado', $calculado)
            ->where('diferencia', $diferencia)
            ->where('retiro', $retiro)
            ->where('caj_id', $caj_id)
            ->where('validation_status', $validation_status)
            ->get();
        $this->assertCount(1, $cortecajas);
        $cortecaja = $cortecajas->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $cortecaja = Cortecaja::factory()->create();

        $response = $this->get(route('cortecajas.show', $cortecaja));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CortecajaController::class,
            'update',
            \App\Http\Requests\CortecajaUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $cortecaja = Cortecaja::factory()->create();
        $store = Store::factory()->create();
        $cor_id = fake()->numberBetween(-100000, 100000);
        $fecha = Carbon::parse(fake()->dateTime());
        $contado = fake()->randomFloat(/** decimal_attributes **/);
        $calculado = fake()->randomFloat(/** decimal_attributes **/);
        $diferencia = fake()->randomFloat(/** decimal_attributes **/);
        $retiro = fake()->randomFloat(/** decimal_attributes **/);
        $caj_id = fake()->numberBetween(-10000, 10000);
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('cortecajas.update', $cortecaja), [
            'store_id' => $store->id,
            'cor_id' => $cor_id,
            'fecha' => $fecha->toDateTimeString(),
            'contado' => $contado,
            'calculado' => $calculado,
            'diferencia' => $diferencia,
            'retiro' => $retiro,
            'caj_id' => $caj_id,
            'validation_status' => $validation_status,
        ]);

        $cortecaja->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($store->id, $cortecaja->store_id);
        $this->assertEquals($cor_id, $cortecaja->cor_id);
        $this->assertEquals($fecha, $cortecaja->fecha);
        $this->assertEquals($contado, $cortecaja->contado);
        $this->assertEquals($calculado, $cortecaja->calculado);
        $this->assertEquals($diferencia, $cortecaja->diferencia);
        $this->assertEquals($retiro, $cortecaja->retiro);
        $this->assertEquals($caj_id, $cortecaja->caj_id);
        $this->assertEquals($validation_status, $cortecaja->validation_status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $cortecaja = Cortecaja::factory()->create();

        $response = $this->delete(route('cortecajas.destroy', $cortecaja));

        $response->assertNoContent();

        $this->assertModelMissing($cortecaja);
    }
}
