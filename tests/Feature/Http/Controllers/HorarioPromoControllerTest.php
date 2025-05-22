<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\HorarioPromo;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\HorarioPromoController
 */
final class HorarioPromoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $horarioPromos = HorarioPromo::factory()->count(3)->create();

        $response = $this->get(route('horario-promos.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HorarioPromoController::class,
            'store',
            \App\Http\Requests\HorarioPromoStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $store = Store::factory()->create();
        $hor_id = fake()->numberBetween(-10000, 10000);
        $nombre = fake()->word();
        $lunes = fake()->boolean();
        $martes = fake()->boolean();
        $miercoles = fake()->boolean();
        $jueves = fake()->boolean();
        $viernes = fake()->boolean();
        $sabado = fake()->boolean();
        $domingo = fake()->boolean();
        $status = fake()->numberBetween(-10000, 10000);

        $response = $this->post(route('horario-promos.store'), [
            'store_id' => $store->id,
            'hor_id' => $hor_id,
            'nombre' => $nombre,
            'lunes' => $lunes,
            'martes' => $martes,
            'miercoles' => $miercoles,
            'jueves' => $jueves,
            'viernes' => $viernes,
            'sabado' => $sabado,
            'domingo' => $domingo,
            'status' => $status,
        ]);

        $horarioPromos = HorarioPromo::query()
            ->where('store_id', $store->id)
            ->where('hor_id', $hor_id)
            ->where('nombre', $nombre)
            ->where('lunes', $lunes)
            ->where('martes', $martes)
            ->where('miercoles', $miercoles)
            ->where('jueves', $jueves)
            ->where('viernes', $viernes)
            ->where('sabado', $sabado)
            ->where('domingo', $domingo)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $horarioPromos);
        $horarioPromo = $horarioPromos->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $horarioPromo = HorarioPromo::factory()->create();

        $response = $this->get(route('horario-promos.show', $horarioPromo));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\HorarioPromoController::class,
            'update',
            \App\Http\Requests\HorarioPromoUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $horarioPromo = HorarioPromo::factory()->create();
        $store = Store::factory()->create();
        $hor_id = fake()->numberBetween(-10000, 10000);
        $nombre = fake()->word();
        $lunes = fake()->boolean();
        $martes = fake()->boolean();
        $miercoles = fake()->boolean();
        $jueves = fake()->boolean();
        $viernes = fake()->boolean();
        $sabado = fake()->boolean();
        $domingo = fake()->boolean();
        $status = fake()->numberBetween(-10000, 10000);

        $response = $this->put(route('horario-promos.update', $horarioPromo), [
            'store_id' => $store->id,
            'hor_id' => $hor_id,
            'nombre' => $nombre,
            'lunes' => $lunes,
            'martes' => $martes,
            'miercoles' => $miercoles,
            'jueves' => $jueves,
            'viernes' => $viernes,
            'sabado' => $sabado,
            'domingo' => $domingo,
            'status' => $status,
        ]);

        $horarioPromo->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($store->id, $horarioPromo->store_id);
        $this->assertEquals($hor_id, $horarioPromo->hor_id);
        $this->assertEquals($nombre, $horarioPromo->nombre);
        $this->assertEquals($lunes, $horarioPromo->lunes);
        $this->assertEquals($martes, $horarioPromo->martes);
        $this->assertEquals($miercoles, $horarioPromo->miercoles);
        $this->assertEquals($jueves, $horarioPromo->jueves);
        $this->assertEquals($viernes, $horarioPromo->viernes);
        $this->assertEquals($sabado, $horarioPromo->sabado);
        $this->assertEquals($domingo, $horarioPromo->domingo);
        $this->assertEquals($status, $horarioPromo->status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $horarioPromo = HorarioPromo::factory()->create();

        $response = $this->delete(route('horario-promos.destroy', $horarioPromo));

        $response->assertNoContent();

        $this->assertModelMissing($horarioPromo);
    }
}
