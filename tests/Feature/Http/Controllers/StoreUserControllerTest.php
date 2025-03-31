<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Store;
use App\Models\StoreUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\StoreUserController
 */
final class StoreUserControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $storeUsers = StoreUser::factory()->count(3)->create();

        $response = $this->get(route('store-users.index'));

        $response->assertOk();
        $response->assertViewIs('storeUser.index');
        $response->assertViewHas('storeUsers');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('store-users.create'));

        $response->assertOk();
        $response->assertViewIs('storeUser.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StoreUserController::class,
            'store',
            \App\Http\Requests\StoreUserStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $store = Store::factory()->create();
        $user = User::factory()->create();

        $response = $this->post(route('store-users.store'), [
            'store_id' => $store->id,
            'user_id' => $user->id,
        ]);

        $storeUsers = StoreUser::query()
            ->where('store_id', $store->id)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $storeUsers);
        $storeUser = $storeUsers->first();

        $response->assertRedirect(route('storeUsers.index'));
        $response->assertSessionHas('storeUser.id', $storeUser->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $storeUser = StoreUser::factory()->create();

        $response = $this->get(route('store-users.show', $storeUser));

        $response->assertOk();
        $response->assertViewIs('storeUser.show');
        $response->assertViewHas('storeUser');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $storeUser = StoreUser::factory()->create();

        $response = $this->get(route('store-users.edit', $storeUser));

        $response->assertOk();
        $response->assertViewIs('storeUser.edit');
        $response->assertViewHas('storeUser');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\StoreUserController::class,
            'update',
            \App\Http\Requests\StoreUserUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $storeUser = StoreUser::factory()->create();
        $store = Store::factory()->create();
        $user = User::factory()->create();

        $response = $this->put(route('store-users.update', $storeUser), [
            'store_id' => $store->id,
            'user_id' => $user->id,
        ]);

        $storeUser->refresh();

        $response->assertRedirect(route('storeUsers.index'));
        $response->assertSessionHas('storeUser.id', $storeUser->id);

        $this->assertEquals($store->id, $storeUser->store_id);
        $this->assertEquals($user->id, $storeUser->user_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $storeUser = StoreUser::factory()->create();

        $response = $this->delete(route('store-users.destroy', $storeUser));

        $response->assertRedirect(route('storeUsers.index'));

        $this->assertModelMissing($storeUser);
    }
}
