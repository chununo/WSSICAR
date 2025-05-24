<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Moneda;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MonedaController
 */
final class MonedaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $monedas = Moneda::factory()->count(3)->create();

        $response = $this->get(route('monedas.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MonedaController::class,
            'store',
            \App\Http\Requests\MonedaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $moneda = fake()->word();

        $response = $this->post(route('monedas.store'), [
            'moneda' => $moneda,
        ]);

        $monedas = Moneda::query()
            ->where('moneda', $moneda)
            ->get();
        $this->assertCount(1, $monedas);
        $moneda = $monedas->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $moneda = Moneda::factory()->create();

        $response = $this->get(route('monedas.show', $moneda));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MonedaController::class,
            'update',
            \App\Http\Requests\MonedaUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $moneda = Moneda::factory()->create();
        $moneda = fake()->word();

        $response = $this->put(route('monedas.update', $moneda), [
            'moneda' => $moneda,
        ]);

        $moneda->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($moneda, $moneda->moneda);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $moneda = Moneda::factory()->create();

        $response = $this->delete(route('monedas.destroy', $moneda));

        $response->assertNoContent();

        $this->assertModelMissing($moneda);
    }
}
