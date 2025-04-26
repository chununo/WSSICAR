<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Impuesto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ImpuestoController
 */
final class ImpuestoControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $impuestos = Impuesto::factory()->count(3)->create();

        $response = $this->get(route('impuestos.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ImpuestoController::class,
            'store',
            \App\Http\Requests\ImpuestoStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $impuesto = fake()->randomFloat(/** decimal_attributes **/);

        $response = $this->post(route('impuestos.store'), [
            'impuesto' => $impuesto,
        ]);

        $impuestos = Impuesto::query()
            ->where('impuesto', $impuesto)
            ->get();
        $this->assertCount(1, $impuestos);
        $impuesto = $impuestos->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $impuesto = Impuesto::factory()->create();

        $response = $this->get(route('impuestos.show', $impuesto));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ImpuestoController::class,
            'update',
            \App\Http\Requests\ImpuestoUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $impuesto = Impuesto::factory()->create();
        $impuesto = fake()->randomFloat(/** decimal_attributes **/);

        $response = $this->put(route('impuestos.update', $impuesto), [
            'impuesto' => $impuesto,
        ]);

        $impuesto->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($impuesto, $impuesto->impuesto);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $impuesto = Impuesto::factory()->create();

        $response = $this->delete(route('impuestos.destroy', $impuesto));

        $response->assertNoContent();

        $this->assertModelMissing($impuesto);
    }
}
