<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\StoreController
 */
final class StoreControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $stores = Store::factory()->count(3)->create();

        $response = $this->get(route('stores.index'));

        $response->assertOk();
        $response->assertViewIs('store.index');
        $response->assertViewHas('stores');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('stores.create'));

        $response->assertOk();
        $response->assertViewIs('store.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StoreController::class,
            'store',
            \App\Http\Requests\StoreStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $nombre = fake()->word();

        $response = $this->post(route('stores.store'), [
            'nombre' => $nombre,
        ]);

        $stores = Store::query()
            ->where('nombre', $nombre)
            ->get();
        $this->assertCount(1, $stores);
        $store = $stores->first();

        $response->assertRedirect(route('stores.index'));
        $response->assertSessionHas('store.id', $store->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $store = Store::factory()->create();

        $response = $this->get(route('stores.show', $store));

        $response->assertOk();
        $response->assertViewIs('store.show');
        $response->assertViewHas('store');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $store = Store::factory()->create();

        $response = $this->get(route('stores.edit', $store));

        $response->assertOk();
        $response->assertViewIs('store.edit');
        $response->assertViewHas('store');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StoreController::class,
            'update',
            \App\Http\Requests\StoreUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $store = Store::factory()->create();
        $nombre = fake()->word();

        $response = $this->put(route('stores.update', $store), [
            'nombre' => $nombre,
        ]);

        $store->refresh();

        $response->assertRedirect(route('stores.index'));
        $response->assertSessionHas('store.id', $store->id);

        $this->assertEquals($nombre, $store->nombre);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $store = Store::factory()->create();

        $response = $this->delete(route('stores.destroy', $store));

        $response->assertRedirect(route('stores.index'));

        $this->assertModelMissing($store);
    }
}
