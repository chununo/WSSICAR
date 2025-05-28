<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Cliente;
use App\Models\Store;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ClienteController
 */
final class ClienteControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $clientes = Cliente::factory()->count(3)->create();

        $response = $this->get(route('clientes.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ClienteController::class,
            'store',
            \App\Http\Requests\ClienteStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $store = Store::factory()->create();
        $cli_id = fake()->numberBetween(-10000, 10000);
        $domicilio = fake()->word();
        $noExt = fake()->word();
        $noInt = fake()->word();
        $localidad = fake()->word();
        $ciudad = fake()->word();
        $estado = fake()->word();
        $pais = fake()->word();
        $codigoPostal = fake()->word();
        $colonia = fake()->word();
        $rfc = fake()->word();
        $curp = fake()->word();
        $telefono = fake()->word();
        $celular = fake()->word();
        $mail = fake()->word();
        $comentario = fake()->word();
        $status = fake()->numberBetween(-10000, 10000);
        $limite = fake()->randomFloat(/** decimal_attributes **/);
        $precio = fake()->numberBetween(-10000, 10000);
        $diasCredito = fake()->numberBetween(-10000, 10000);
        $retener = fake()->boolean();
        $desglosarIEPS = fake()->boolean();
        $notificar = fake()->boolean();
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('clientes.store'), [
            'store_id' => $store->id,
            'cli_id' => $cli_id,
            'domicilio' => $domicilio,
            'noExt' => $noExt,
            'noInt' => $noInt,
            'localidad' => $localidad,
            'ciudad' => $ciudad,
            'estado' => $estado,
            'pais' => $pais,
            'codigoPostal' => $codigoPostal,
            'colonia' => $colonia,
            'rfc' => $rfc,
            'curp' => $curp,
            'telefono' => $telefono,
            'celular' => $celular,
            'mail' => $mail,
            'comentario' => $comentario,
            'status' => $status,
            'limite' => $limite,
            'precio' => $precio,
            'diasCredito' => $diasCredito,
            'retener' => $retener,
            'desglosarIEPS' => $desglosarIEPS,
            'notificar' => $notificar,
            'validation_status' => $validation_status,
        ]);

        $clientes = Cliente::query()
            ->where('store_id', $store->id)
            ->where('cli_id', $cli_id)
            ->where('domicilio', $domicilio)
            ->where('noExt', $noExt)
            ->where('noInt', $noInt)
            ->where('localidad', $localidad)
            ->where('ciudad', $ciudad)
            ->where('estado', $estado)
            ->where('pais', $pais)
            ->where('codigoPostal', $codigoPostal)
            ->where('colonia', $colonia)
            ->where('rfc', $rfc)
            ->where('curp', $curp)
            ->where('telefono', $telefono)
            ->where('celular', $celular)
            ->where('mail', $mail)
            ->where('comentario', $comentario)
            ->where('status', $status)
            ->where('limite', $limite)
            ->where('precio', $precio)
            ->where('diasCredito', $diasCredito)
            ->where('retener', $retener)
            ->where('desglosarIEPS', $desglosarIEPS)
            ->where('notificar', $notificar)
            ->where('validation_status', $validation_status)
            ->get();
        $this->assertCount(1, $clientes);
        $cliente = $clientes->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $cliente = Cliente::factory()->create();

        $response = $this->get(route('clientes.show', $cliente));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ClienteController::class,
            'update',
            \App\Http\Requests\ClienteUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $cliente = Cliente::factory()->create();
        $store = Store::factory()->create();
        $cli_id = fake()->numberBetween(-10000, 10000);
        $domicilio = fake()->word();
        $noExt = fake()->word();
        $noInt = fake()->word();
        $localidad = fake()->word();
        $ciudad = fake()->word();
        $estado = fake()->word();
        $pais = fake()->word();
        $codigoPostal = fake()->word();
        $colonia = fake()->word();
        $rfc = fake()->word();
        $curp = fake()->word();
        $telefono = fake()->word();
        $celular = fake()->word();
        $mail = fake()->word();
        $comentario = fake()->word();
        $status = fake()->numberBetween(-10000, 10000);
        $limite = fake()->randomFloat(/** decimal_attributes **/);
        $precio = fake()->numberBetween(-10000, 10000);
        $diasCredito = fake()->numberBetween(-10000, 10000);
        $retener = fake()->boolean();
        $desglosarIEPS = fake()->boolean();
        $notificar = fake()->boolean();
        $validation_status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('clientes.update', $cliente), [
            'store_id' => $store->id,
            'cli_id' => $cli_id,
            'domicilio' => $domicilio,
            'noExt' => $noExt,
            'noInt' => $noInt,
            'localidad' => $localidad,
            'ciudad' => $ciudad,
            'estado' => $estado,
            'pais' => $pais,
            'codigoPostal' => $codigoPostal,
            'colonia' => $colonia,
            'rfc' => $rfc,
            'curp' => $curp,
            'telefono' => $telefono,
            'celular' => $celular,
            'mail' => $mail,
            'comentario' => $comentario,
            'status' => $status,
            'limite' => $limite,
            'precio' => $precio,
            'diasCredito' => $diasCredito,
            'retener' => $retener,
            'desglosarIEPS' => $desglosarIEPS,
            'notificar' => $notificar,
            'validation_status' => $validation_status,
        ]);

        $cliente->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($store->id, $cliente->store_id);
        $this->assertEquals($cli_id, $cliente->cli_id);
        $this->assertEquals($domicilio, $cliente->domicilio);
        $this->assertEquals($noExt, $cliente->noExt);
        $this->assertEquals($noInt, $cliente->noInt);
        $this->assertEquals($localidad, $cliente->localidad);
        $this->assertEquals($ciudad, $cliente->ciudad);
        $this->assertEquals($estado, $cliente->estado);
        $this->assertEquals($pais, $cliente->pais);
        $this->assertEquals($codigoPostal, $cliente->codigoPostal);
        $this->assertEquals($colonia, $cliente->colonia);
        $this->assertEquals($rfc, $cliente->rfc);
        $this->assertEquals($curp, $cliente->curp);
        $this->assertEquals($telefono, $cliente->telefono);
        $this->assertEquals($celular, $cliente->celular);
        $this->assertEquals($mail, $cliente->mail);
        $this->assertEquals($comentario, $cliente->comentario);
        $this->assertEquals($status, $cliente->status);
        $this->assertEquals($limite, $cliente->limite);
        $this->assertEquals($precio, $cliente->precio);
        $this->assertEquals($diasCredito, $cliente->diasCredito);
        $this->assertEquals($retener, $cliente->retener);
        $this->assertEquals($desglosarIEPS, $cliente->desglosarIEPS);
        $this->assertEquals($notificar, $cliente->notificar);
        $this->assertEquals($validation_status, $cliente->validation_status);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $cliente = Cliente::factory()->create();

        $response = $this->delete(route('clientes.destroy', $cliente));

        $response->assertNoContent();

        $this->assertModelMissing($cliente);
    }
}
