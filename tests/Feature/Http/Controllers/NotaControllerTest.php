<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Nota;
use App\Models\Notum;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\NotaController
 */
final class NotaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $nota = Nota::factory()->count(3)->create();

        $response = $this->get(route('nota.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\NotaController::class,
            'store',
            \App\Http\Requests\NotaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $store = Store::factory()->create();
        $not_id = fake()->numberBetween(-100000, 100000);
        $cli_id = fake()->numberBetween(-10000, 10000);
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('nota.store'), [
            'store_id' => $store->id,
            'not_id' => $not_id,
            'cli_id' => $cli_id,
            'validation_status' => $validation_status,
        ]);

        $nota = Notum::query()
            ->where('store_id', $store->id)
            ->where('not_id', $not_id)
            ->where('cli_id', $cli_id)
            ->where('validation_status', $validation_status)
            ->get();
        $this->assertCount(1, $nota);
        $notum = $nota->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $notum = Nota::factory()->create();

        $response = $this->get(route('nota.show', $notum));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\NotaController::class,
            'update',
            \App\Http\Requests\NotaUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $notum = Nota::factory()->create();
        $store = Store::factory()->create();
        $not_id = fake()->numberBetween(-100000, 100000);
        $cli_id = fake()->numberBetween(-10000, 10000);
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('nota.update', $notum), [
            'store_id' => $store->id,
            'not_id' => $not_id,
            'cli_id' => $cli_id,
            'validation_status' => $validation_status,
        ]);

        $notum->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($store->id, $notum->store_id);
        $this->assertEquals($not_id, $notum->not_id);
        $this->assertEquals($cli_id, $notum->cli_id);
        $this->assertEquals($validation_status, $notum->validation_status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $notum = Nota::factory()->create();
        $notum = Notum::factory()->create();

        $response = $this->delete(route('nota.destroy', $notum));

        $response->assertNoContent();

        $this->assertModelMissing($notum);
    }
}
