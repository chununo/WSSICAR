<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Store;
use App\Models\Turno;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TurnoController
 */
final class TurnoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $turnos = Turno::factory()->count(3)->create();

        $response = $this->get(route('turnos.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TurnoController::class,
            'store',
            \App\Http\Requests\TurnoStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $store = Store::factory()->create();
        $tur_id = fake()->numberBetween(-10000, 10000);
        $nombre = fake()->word();
        $nocturno = fake()->boolean();
        $semana = fake()->boolean();
        $tipo = fake()->numberBetween(-10000, 10000);
        $status = fake()->numberBetween(-10000, 10000);

        $response = $this->post(route('turnos.store'), [
            'store_id' => $store->id,
            'tur_id' => $tur_id,
            'nombre' => $nombre,
            'nocturno' => $nocturno,
            'semana' => $semana,
            'tipo' => $tipo,
            'status' => $status,
        ]);

        $turnos = Turno::query()
            ->where('store_id', $store->id)
            ->where('tur_id', $tur_id)
            ->where('nombre', $nombre)
            ->where('nocturno', $nocturno)
            ->where('semana', $semana)
            ->where('tipo', $tipo)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $turnos);
        $turno = $turnos->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $turno = Turno::factory()->create();

        $response = $this->get(route('turnos.show', $turno));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TurnoController::class,
            'update',
            \App\Http\Requests\TurnoUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $turno = Turno::factory()->create();
        $store = Store::factory()->create();
        $tur_id = fake()->numberBetween(-10000, 10000);
        $nombre = fake()->word();
        $nocturno = fake()->boolean();
        $semana = fake()->boolean();
        $tipo = fake()->numberBetween(-10000, 10000);
        $status = fake()->numberBetween(-10000, 10000);

        $response = $this->put(route('turnos.update', $turno), [
            'store_id' => $store->id,
            'tur_id' => $tur_id,
            'nombre' => $nombre,
            'nocturno' => $nocturno,
            'semana' => $semana,
            'tipo' => $tipo,
            'status' => $status,
        ]);

        $turno->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($store->id, $turno->store_id);
        $this->assertEquals($tur_id, $turno->tur_id);
        $this->assertEquals($nombre, $turno->nombre);
        $this->assertEquals($nocturno, $turno->nocturno);
        $this->assertEquals($semana, $turno->semana);
        $this->assertEquals($tipo, $turno->tipo);
        $this->assertEquals($status, $turno->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $turno = Turno::factory()->create();

        $response = $this->delete(route('turnos.destroy', $turno));

        $response->assertNoContent();

        $this->assertModelMissing($turno);
    }
}
