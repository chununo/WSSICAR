<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Resumencortecaja;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ResumencortecajaController
 */
final class ResumencortecajaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $resumencortecajas = Resumencortecaja::factory()->count(3)->create();

        $response = $this->get(route('resumencortecajas.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ResumencortecajaController::class,
            'store',
            \App\Http\Requests\ResumencortecajaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $store = Store::factory()->create();
        $rcc_id = fake()->numberBetween(-10000, 10000);
        $venCon = fake()->randomFloat(/** decimal_attributes **/);
        $venCre = fake()->randomFloat(/** decimal_attributes **/);
        $venConC = fake()->randomFloat(/** decimal_attributes **/);
        $venCreC = fake()->randomFloat(/** decimal_attributes **/);
        $comCon = fake()->randomFloat(/** decimal_attributes **/);
        $comCre = fake()->randomFloat(/** decimal_attributes **/);
        $comConC = fake()->randomFloat(/** decimal_attributes **/);
        $comCreC = fake()->randomFloat(/** decimal_attributes **/);
        $notCre = fake()->randomFloat(/** decimal_attributes **/);
        $notCreC = fake()->randomFloat(/** decimal_attributes **/);
        $entVen = fake()->randomFloat(/** decimal_attributes **/);
        $entCre = fake()->randomFloat(/** decimal_attributes **/);
        $entComC = fake()->randomFloat(/** decimal_attributes **/);
        $entNotC = fake()->randomFloat(/** decimal_attributes **/);
        $entMov = fake()->randomFloat(/** decimal_attributes **/);
        $salCom = fake()->randomFloat(/** decimal_attributes **/);
        $salCre = fake()->randomFloat(/** decimal_attributes **/);
        $salVenC = fake()->randomFloat(/** decimal_attributes **/);
        $salNot = fake()->randomFloat(/** decimal_attributes **/);
        $salMov = fake()->randomFloat(/** decimal_attributes **/);
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('resumencortecajas.store'), [
            'store_id' => $store->id,
            'rcc_id' => $rcc_id,
            'venCon' => $venCon,
            'venCre' => $venCre,
            'venConC' => $venConC,
            'venCreC' => $venCreC,
            'comCon' => $comCon,
            'comCre' => $comCre,
            'comConC' => $comConC,
            'comCreC' => $comCreC,
            'notCre' => $notCre,
            'notCreC' => $notCreC,
            'entVen' => $entVen,
            'entCre' => $entCre,
            'entComC' => $entComC,
            'entNotC' => $entNotC,
            'entMov' => $entMov,
            'salCom' => $salCom,
            'salCre' => $salCre,
            'salVenC' => $salVenC,
            'salNot' => $salNot,
            'salMov' => $salMov,
            'validation_status' => $validation_status,
        ]);

        $resumencortecajas = Resumencortecaja::query()
            ->where('store_id', $store->id)
            ->where('rcc_id', $rcc_id)
            ->where('venCon', $venCon)
            ->where('venCre', $venCre)
            ->where('venConC', $venConC)
            ->where('venCreC', $venCreC)
            ->where('comCon', $comCon)
            ->where('comCre', $comCre)
            ->where('comConC', $comConC)
            ->where('comCreC', $comCreC)
            ->where('notCre', $notCre)
            ->where('notCreC', $notCreC)
            ->where('entVen', $entVen)
            ->where('entCre', $entCre)
            ->where('entComC', $entComC)
            ->where('entNotC', $entNotC)
            ->where('entMov', $entMov)
            ->where('salCom', $salCom)
            ->where('salCre', $salCre)
            ->where('salVenC', $salVenC)
            ->where('salNot', $salNot)
            ->where('salMov', $salMov)
            ->where('validation_status', $validation_status)
            ->get();
        $this->assertCount(1, $resumencortecajas);
        $resumencortecaja = $resumencortecajas->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $resumencortecaja = Resumencortecaja::factory()->create();

        $response = $this->get(route('resumencortecajas.show', $resumencortecaja));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ResumencortecajaController::class,
            'update',
            \App\Http\Requests\ResumencortecajaUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $resumencortecaja = Resumencortecaja::factory()->create();
        $store = Store::factory()->create();
        $rcc_id = fake()->numberBetween(-10000, 10000);
        $venCon = fake()->randomFloat(/** decimal_attributes **/);
        $venCre = fake()->randomFloat(/** decimal_attributes **/);
        $venConC = fake()->randomFloat(/** decimal_attributes **/);
        $venCreC = fake()->randomFloat(/** decimal_attributes **/);
        $comCon = fake()->randomFloat(/** decimal_attributes **/);
        $comCre = fake()->randomFloat(/** decimal_attributes **/);
        $comConC = fake()->randomFloat(/** decimal_attributes **/);
        $comCreC = fake()->randomFloat(/** decimal_attributes **/);
        $notCre = fake()->randomFloat(/** decimal_attributes **/);
        $notCreC = fake()->randomFloat(/** decimal_attributes **/);
        $entVen = fake()->randomFloat(/** decimal_attributes **/);
        $entCre = fake()->randomFloat(/** decimal_attributes **/);
        $entComC = fake()->randomFloat(/** decimal_attributes **/);
        $entNotC = fake()->randomFloat(/** decimal_attributes **/);
        $entMov = fake()->randomFloat(/** decimal_attributes **/);
        $salCom = fake()->randomFloat(/** decimal_attributes **/);
        $salCre = fake()->randomFloat(/** decimal_attributes **/);
        $salVenC = fake()->randomFloat(/** decimal_attributes **/);
        $salNot = fake()->randomFloat(/** decimal_attributes **/);
        $salMov = fake()->randomFloat(/** decimal_attributes **/);
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('resumencortecajas.update', $resumencortecaja), [
            'store_id' => $store->id,
            'rcc_id' => $rcc_id,
            'venCon' => $venCon,
            'venCre' => $venCre,
            'venConC' => $venConC,
            'venCreC' => $venCreC,
            'comCon' => $comCon,
            'comCre' => $comCre,
            'comConC' => $comConC,
            'comCreC' => $comCreC,
            'notCre' => $notCre,
            'notCreC' => $notCreC,
            'entVen' => $entVen,
            'entCre' => $entCre,
            'entComC' => $entComC,
            'entNotC' => $entNotC,
            'entMov' => $entMov,
            'salCom' => $salCom,
            'salCre' => $salCre,
            'salVenC' => $salVenC,
            'salNot' => $salNot,
            'salMov' => $salMov,
            'validation_status' => $validation_status,
        ]);

        $resumencortecaja->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($store->id, $resumencortecaja->store_id);
        $this->assertEquals($rcc_id, $resumencortecaja->rcc_id);
        $this->assertEquals($venCon, $resumencortecaja->venCon);
        $this->assertEquals($venCre, $resumencortecaja->venCre);
        $this->assertEquals($venConC, $resumencortecaja->venConC);
        $this->assertEquals($venCreC, $resumencortecaja->venCreC);
        $this->assertEquals($comCon, $resumencortecaja->comCon);
        $this->assertEquals($comCre, $resumencortecaja->comCre);
        $this->assertEquals($comConC, $resumencortecaja->comConC);
        $this->assertEquals($comCreC, $resumencortecaja->comCreC);
        $this->assertEquals($notCre, $resumencortecaja->notCre);
        $this->assertEquals($notCreC, $resumencortecaja->notCreC);
        $this->assertEquals($entVen, $resumencortecaja->entVen);
        $this->assertEquals($entCre, $resumencortecaja->entCre);
        $this->assertEquals($entComC, $resumencortecaja->entComC);
        $this->assertEquals($entNotC, $resumencortecaja->entNotC);
        $this->assertEquals($entMov, $resumencortecaja->entMov);
        $this->assertEquals($salCom, $resumencortecaja->salCom);
        $this->assertEquals($salCre, $resumencortecaja->salCre);
        $this->assertEquals($salVenC, $resumencortecaja->salVenC);
        $this->assertEquals($salNot, $resumencortecaja->salNot);
        $this->assertEquals($salMov, $resumencortecaja->salMov);
        $this->assertEquals($validation_status, $resumencortecaja->validation_status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $resumencortecaja = Resumencortecaja::factory()->create();

        $response = $this->delete(route('resumencortecajas.destroy', $resumencortecaja));

        $response->assertNoContent();

        $this->assertModelMissing($resumencortecaja);
    }
}
