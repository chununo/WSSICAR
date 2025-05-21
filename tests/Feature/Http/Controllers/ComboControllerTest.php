<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Combo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ComboController
 */
final class ComboControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $combos = Combo::factory()->count(3)->create();

        $response = $this->get(route('combos.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ComboController::class,
            'store',
            \App\Http\Requests\ComboStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $combo = fake()->numberBetween(-10000, 10000);

        $response = $this->post(route('combos.store'), [
            'combo' => $combo,
        ]);

        $combos = Combo::query()
            ->where('combo', $combo)
            ->get();
        $this->assertCount(1, $combos);
        $combo = $combos->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $combo = Combo::factory()->create();

        $response = $this->get(route('combos.show', $combo));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ComboController::class,
            'update',
            \App\Http\Requests\ComboUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $combo = Combo::factory()->create();
        $combo = fake()->numberBetween(-10000, 10000);

        $response = $this->put(route('combos.update', $combo), [
            'combo' => $combo,
        ]);

        $combo->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($combo, $combo->combo);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $combo = Combo::factory()->create();

        $response = $this->delete(route('combos.destroy', $combo));

        $response->assertNoContent();

        $this->assertModelMissing($combo);
    }
}
