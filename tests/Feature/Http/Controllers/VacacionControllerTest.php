<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Store;
use App\Models\Vacacion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\VacacionController
 */
final class VacacionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $vacacions = Vacacion::factory()->count(3)->create();

        $response = $this->get(route('vacacions.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VacacionController::class,
            'store',
            \App\Http\Requests\VacacionStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $store = Store::factory()->create();
        $vac_id = fake()->numberBetween(-10000, 10000);
        $nombre = fake()->word();
        $minimo = fake()->numberBetween(-10000, 10000);
        $a1 = fake()->numberBetween(-10000, 10000);
        $a2 = fake()->numberBetween(-10000, 10000);
        $a3 = fake()->numberBetween(-10000, 10000);
        $a4 = fake()->numberBetween(-10000, 10000);
        $a5 = fake()->numberBetween(-10000, 10000);
        $a6 = fake()->numberBetween(-10000, 10000);
        $a7 = fake()->numberBetween(-10000, 10000);
        $a8 = fake()->numberBetween(-10000, 10000);
        $a9 = fake()->numberBetween(-10000, 10000);
        $a10 = fake()->numberBetween(-10000, 10000);
        $a11 = fake()->numberBetween(-10000, 10000);
        $a12 = fake()->numberBetween(-10000, 10000);
        $a13 = fake()->numberBetween(-10000, 10000);
        $a14 = fake()->numberBetween(-10000, 10000);
        $a15 = fake()->numberBetween(-10000, 10000);
        $a16 = fake()->numberBetween(-10000, 10000);
        $a17 = fake()->numberBetween(-10000, 10000);
        $a18 = fake()->numberBetween(-10000, 10000);
        $a19 = fake()->numberBetween(-10000, 10000);
        $a20 = fake()->numberBetween(-10000, 10000);
        $a21 = fake()->numberBetween(-10000, 10000);
        $a22 = fake()->numberBetween(-10000, 10000);
        $a23 = fake()->numberBetween(-10000, 10000);
        $a24 = fake()->numberBetween(-10000, 10000);
        $a25 = fake()->numberBetween(-10000, 10000);
        $a26 = fake()->numberBetween(-10000, 10000);
        $a27 = fake()->numberBetween(-10000, 10000);
        $a28 = fake()->numberBetween(-10000, 10000);
        $a29 = fake()->numberBetween(-10000, 10000);
        $a30 = fake()->numberBetween(-10000, 10000);
        $a31 = fake()->numberBetween(-10000, 10000);
        $a32 = fake()->numberBetween(-10000, 10000);
        $a33 = fake()->numberBetween(-10000, 10000);
        $a34 = fake()->numberBetween(-10000, 10000);
        $a35 = fake()->numberBetween(-10000, 10000);
        $a36 = fake()->numberBetween(-10000, 10000);
        $a37 = fake()->numberBetween(-10000, 10000);
        $a38 = fake()->numberBetween(-10000, 10000);
        $a39 = fake()->numberBetween(-10000, 10000);
        $a40 = fake()->numberBetween(-10000, 10000);
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('vacacions.store'), [
            'store_id' => $store->id,
            'vac_id' => $vac_id,
            'nombre' => $nombre,
            'minimo' => $minimo,
            'a1' => $a1,
            'a2' => $a2,
            'a3' => $a3,
            'a4' => $a4,
            'a5' => $a5,
            'a6' => $a6,
            'a7' => $a7,
            'a8' => $a8,
            'a9' => $a9,
            'a10' => $a10,
            'a11' => $a11,
            'a12' => $a12,
            'a13' => $a13,
            'a14' => $a14,
            'a15' => $a15,
            'a16' => $a16,
            'a17' => $a17,
            'a18' => $a18,
            'a19' => $a19,
            'a20' => $a20,
            'a21' => $a21,
            'a22' => $a22,
            'a23' => $a23,
            'a24' => $a24,
            'a25' => $a25,
            'a26' => $a26,
            'a27' => $a27,
            'a28' => $a28,
            'a29' => $a29,
            'a30' => $a30,
            'a31' => $a31,
            'a32' => $a32,
            'a33' => $a33,
            'a34' => $a34,
            'a35' => $a35,
            'a36' => $a36,
            'a37' => $a37,
            'a38' => $a38,
            'a39' => $a39,
            'a40' => $a40,
            'validation_status' => $validation_status,
        ]);

        $vacacions = Vacacion::query()
            ->where('store_id', $store->id)
            ->where('vac_id', $vac_id)
            ->where('nombre', $nombre)
            ->where('minimo', $minimo)
            ->where('a1', $a1)
            ->where('a2', $a2)
            ->where('a3', $a3)
            ->where('a4', $a4)
            ->where('a5', $a5)
            ->where('a6', $a6)
            ->where('a7', $a7)
            ->where('a8', $a8)
            ->where('a9', $a9)
            ->where('a10', $a10)
            ->where('a11', $a11)
            ->where('a12', $a12)
            ->where('a13', $a13)
            ->where('a14', $a14)
            ->where('a15', $a15)
            ->where('a16', $a16)
            ->where('a17', $a17)
            ->where('a18', $a18)
            ->where('a19', $a19)
            ->where('a20', $a20)
            ->where('a21', $a21)
            ->where('a22', $a22)
            ->where('a23', $a23)
            ->where('a24', $a24)
            ->where('a25', $a25)
            ->where('a26', $a26)
            ->where('a27', $a27)
            ->where('a28', $a28)
            ->where('a29', $a29)
            ->where('a30', $a30)
            ->where('a31', $a31)
            ->where('a32', $a32)
            ->where('a33', $a33)
            ->where('a34', $a34)
            ->where('a35', $a35)
            ->where('a36', $a36)
            ->where('a37', $a37)
            ->where('a38', $a38)
            ->where('a39', $a39)
            ->where('a40', $a40)
            ->where('validation_status', $validation_status)
            ->get();
        $this->assertCount(1, $vacacions);
        $vacacion = $vacacions->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $vacacion = Vacacion::factory()->create();

        $response = $this->get(route('vacacions.show', $vacacion));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\VacacionController::class,
            'update',
            \App\Http\Requests\VacacionUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $vacacion = Vacacion::factory()->create();
        $store = Store::factory()->create();
        $vac_id = fake()->numberBetween(-10000, 10000);
        $nombre = fake()->word();
        $minimo = fake()->numberBetween(-10000, 10000);
        $a1 = fake()->numberBetween(-10000, 10000);
        $a2 = fake()->numberBetween(-10000, 10000);
        $a3 = fake()->numberBetween(-10000, 10000);
        $a4 = fake()->numberBetween(-10000, 10000);
        $a5 = fake()->numberBetween(-10000, 10000);
        $a6 = fake()->numberBetween(-10000, 10000);
        $a7 = fake()->numberBetween(-10000, 10000);
        $a8 = fake()->numberBetween(-10000, 10000);
        $a9 = fake()->numberBetween(-10000, 10000);
        $a10 = fake()->numberBetween(-10000, 10000);
        $a11 = fake()->numberBetween(-10000, 10000);
        $a12 = fake()->numberBetween(-10000, 10000);
        $a13 = fake()->numberBetween(-10000, 10000);
        $a14 = fake()->numberBetween(-10000, 10000);
        $a15 = fake()->numberBetween(-10000, 10000);
        $a16 = fake()->numberBetween(-10000, 10000);
        $a17 = fake()->numberBetween(-10000, 10000);
        $a18 = fake()->numberBetween(-10000, 10000);
        $a19 = fake()->numberBetween(-10000, 10000);
        $a20 = fake()->numberBetween(-10000, 10000);
        $a21 = fake()->numberBetween(-10000, 10000);
        $a22 = fake()->numberBetween(-10000, 10000);
        $a23 = fake()->numberBetween(-10000, 10000);
        $a24 = fake()->numberBetween(-10000, 10000);
        $a25 = fake()->numberBetween(-10000, 10000);
        $a26 = fake()->numberBetween(-10000, 10000);
        $a27 = fake()->numberBetween(-10000, 10000);
        $a28 = fake()->numberBetween(-10000, 10000);
        $a29 = fake()->numberBetween(-10000, 10000);
        $a30 = fake()->numberBetween(-10000, 10000);
        $a31 = fake()->numberBetween(-10000, 10000);
        $a32 = fake()->numberBetween(-10000, 10000);
        $a33 = fake()->numberBetween(-10000, 10000);
        $a34 = fake()->numberBetween(-10000, 10000);
        $a35 = fake()->numberBetween(-10000, 10000);
        $a36 = fake()->numberBetween(-10000, 10000);
        $a37 = fake()->numberBetween(-10000, 10000);
        $a38 = fake()->numberBetween(-10000, 10000);
        $a39 = fake()->numberBetween(-10000, 10000);
        $a40 = fake()->numberBetween(-10000, 10000);
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('vacacions.update', $vacacion), [
            'store_id' => $store->id,
            'vac_id' => $vac_id,
            'nombre' => $nombre,
            'minimo' => $minimo,
            'a1' => $a1,
            'a2' => $a2,
            'a3' => $a3,
            'a4' => $a4,
            'a5' => $a5,
            'a6' => $a6,
            'a7' => $a7,
            'a8' => $a8,
            'a9' => $a9,
            'a10' => $a10,
            'a11' => $a11,
            'a12' => $a12,
            'a13' => $a13,
            'a14' => $a14,
            'a15' => $a15,
            'a16' => $a16,
            'a17' => $a17,
            'a18' => $a18,
            'a19' => $a19,
            'a20' => $a20,
            'a21' => $a21,
            'a22' => $a22,
            'a23' => $a23,
            'a24' => $a24,
            'a25' => $a25,
            'a26' => $a26,
            'a27' => $a27,
            'a28' => $a28,
            'a29' => $a29,
            'a30' => $a30,
            'a31' => $a31,
            'a32' => $a32,
            'a33' => $a33,
            'a34' => $a34,
            'a35' => $a35,
            'a36' => $a36,
            'a37' => $a37,
            'a38' => $a38,
            'a39' => $a39,
            'a40' => $a40,
            'validation_status' => $validation_status,
        ]);

        $vacacion->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($store->id, $vacacion->store_id);
        $this->assertEquals($vac_id, $vacacion->vac_id);
        $this->assertEquals($nombre, $vacacion->nombre);
        $this->assertEquals($minimo, $vacacion->minimo);
        $this->assertEquals($a1, $vacacion->a1);
        $this->assertEquals($a2, $vacacion->a2);
        $this->assertEquals($a3, $vacacion->a3);
        $this->assertEquals($a4, $vacacion->a4);
        $this->assertEquals($a5, $vacacion->a5);
        $this->assertEquals($a6, $vacacion->a6);
        $this->assertEquals($a7, $vacacion->a7);
        $this->assertEquals($a8, $vacacion->a8);
        $this->assertEquals($a9, $vacacion->a9);
        $this->assertEquals($a10, $vacacion->a10);
        $this->assertEquals($a11, $vacacion->a11);
        $this->assertEquals($a12, $vacacion->a12);
        $this->assertEquals($a13, $vacacion->a13);
        $this->assertEquals($a14, $vacacion->a14);
        $this->assertEquals($a15, $vacacion->a15);
        $this->assertEquals($a16, $vacacion->a16);
        $this->assertEquals($a17, $vacacion->a17);
        $this->assertEquals($a18, $vacacion->a18);
        $this->assertEquals($a19, $vacacion->a19);
        $this->assertEquals($a20, $vacacion->a20);
        $this->assertEquals($a21, $vacacion->a21);
        $this->assertEquals($a22, $vacacion->a22);
        $this->assertEquals($a23, $vacacion->a23);
        $this->assertEquals($a24, $vacacion->a24);
        $this->assertEquals($a25, $vacacion->a25);
        $this->assertEquals($a26, $vacacion->a26);
        $this->assertEquals($a27, $vacacion->a27);
        $this->assertEquals($a28, $vacacion->a28);
        $this->assertEquals($a29, $vacacion->a29);
        $this->assertEquals($a30, $vacacion->a30);
        $this->assertEquals($a31, $vacacion->a31);
        $this->assertEquals($a32, $vacacion->a32);
        $this->assertEquals($a33, $vacacion->a33);
        $this->assertEquals($a34, $vacacion->a34);
        $this->assertEquals($a35, $vacacion->a35);
        $this->assertEquals($a36, $vacacion->a36);
        $this->assertEquals($a37, $vacacion->a37);
        $this->assertEquals($a38, $vacacion->a38);
        $this->assertEquals($a39, $vacacion->a39);
        $this->assertEquals($a40, $vacacion->a40);
        $this->assertEquals($validation_status, $vacacion->validation_status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $vacacion = Vacacion::factory()->create();

        $response = $this->delete(route('vacacions.destroy', $vacacion));

        $response->assertNoContent();

        $this->assertModelMissing($vacacion);
    }
}
