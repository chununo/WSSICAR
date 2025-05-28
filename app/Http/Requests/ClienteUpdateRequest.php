<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'string', 'max:1000'],
            'representante' => ['sometimes', 'string', 'max:1000'],
            'domicilio' => ['sometimes', 'string', 'max:120'],
            'noExt' => ['sometimes', 'string', 'max:45'],
            'noInt' => ['sometimes', 'string', 'max:45'],
            'localidad' => ['sometimes', 'string', 'max:120'],
            'ciudad' => ['sometimes', 'string', 'max:120'],
            'estado' => ['sometimes', 'string', 'max:45'],
            'pais' => ['sometimes', 'string', 'max:45'],
            'codigoPostal' => ['sometimes', 'string', 'max:10'],
            'colonia' => ['sometimes', 'string', 'max:45'],
            'rfc' => ['sometimes', 'string', 'max:45'],
            'curp' => ['sometimes', 'string', 'max:45'],
            'telefono' => ['sometimes', 'string', 'max:45'],
            'celular' => ['sometimes', 'string', 'max:45'],
            'mail' => ['sometimes', 'string', 'max:255'],
            'comentario' => ['sometimes', 'string', 'max:255'],
            'status' => ['sometimes', 'integer'],
            'limite' => ['sometimes', 'numeric', 'between:-9999999999999999.99,9999999999999999.99'],
            'precio' => ['sometimes', 'integer'],
            'diasCredito' => ['sometimes', 'integer'],
            'retener' => ['sometimes', 'boolean'],
            'desglosarIEPS' => ['sometimes', 'boolean'],
            'notificar' => ['sometimes', 'boolean'],
            'clave' => ['sometimes', 'string', 'max:45'],
            'foto' => ['sometimes'],
            'huella' => ['sometimes'],
            'muestra' => ['sometimes'],
            'usoCfdi' => ['sometimes', 'string', 'max:10'],
            'idCIF' => ['sometimes', 'string', 'max:20'],
            'sid' => ['sometimes', 'string', 'max:15'],
            'eduNivel' => ['sometimes', 'string', 'max:128'],
            'eduClave' => ['sometimes', 'string', 'max:128'],
            'eduRfc' => ['sometimes', 'string', 'max:45'],
            'eduNombre' => ['sometimes', 'string', 'max:120'],
            'grc_id' => ['sometimes', 'integer'],
            'grupocliente_id' => ['sometimes', 'integer'],
            'rgf_id' => ['sometimes', 'integer'],
            'regimenfiscal_id' => ['sometimes', 'integer'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'retener' => filter_var($this->retener, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'desglosarIEPS' => filter_var($this->desglosarIEPS, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'notificar' => filter_var($this->notificar, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        ]);
    }


    public function attributes(): array
    {
        return (new ClienteStoreRequest)->attributes(); // reutiliza los mismos atributos
    }
}
