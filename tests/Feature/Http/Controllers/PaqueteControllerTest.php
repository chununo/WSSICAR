<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Paquete;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PaqueteController
 */
final class PaqueteControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $paquetes = Paquete::factory()->count(3)->create();

        $response = $this->get(route('paquetes.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PaqueteController::class,
            'store',
            \App\Http\Requests\PaqueteStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $paquete = fake()->numberBetween(-10000, 10000);

        $response = $this->post(route('paquetes.store'), [
            'paquete' => $paquete,
        ]);

        $paquetes = Paquete::query()
            ->where('paquete', $paquete)
            ->get();
        $this->assertCount(1, $paquetes);
        $paquete = $paquetes->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $paquete = Paquete::factory()->create();

        $response = $this->get(route('paquetes.show', $paquete));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PaqueteController::class,
            'update',
            \App\Http\Requests\PaqueteUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $paquete = Paquete::factory()->create();
        $paquete = fake()->numberBetween(-10000, 10000);

        $response = $this->put(route('paquetes.update', $paquete), [
            'paquete' => $paquete,
        ]);

        $paquete->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($paquete, $paquete->paquete);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $paquete = Paquete::factory()->create();

        $response = $this->delete(route('paquetes.destroy', $paquete));

        $response->assertNoContent();

        $this->assertModelMissing($paquete);
    }
}
