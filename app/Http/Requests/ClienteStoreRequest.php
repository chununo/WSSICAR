<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClienteStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'store_id' => ['required', 'integer', 'exists:stores,id'],
            'cli_id' => ['required', 'integer',
                Rule::unique('clientes')->where(fn ($q) =>
                    $q->where('store_id', $this->input('store_id'))
                )
            ],
            'nombre' => ['nullable', 'string', 'max:1000'],
            'representante' => ['nullable', 'string', 'max:1000'],
            'domicilio' => ['required', 'string', 'max:120'],
            'noExt' => ['required', 'string', 'max:45'],
            'noInt' => ['required', 'string', 'max:45'],
            'localidad' => ['required', 'string', 'max:120'],
            'ciudad' => ['required', 'string', 'max:120'],
            'estado' => ['required', 'string', 'max:45'],
            'pais' => ['required', 'string', 'max:45'],
            'codigoPostal' => ['required', 'string', 'max:10'],
            'colonia' => ['required', 'string', 'max:45'],
            'rfc' => ['required', 'string', 'max:45'],
            'curp' => ['required', 'string', 'max:45'],
            'telefono' => ['required', 'string', 'max:45'],
            'celular' => ['required', 'string', 'max:45'],
            'mail' => ['required', 'string', 'max:255'],
            'comentario' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'integer'],
            'limite' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'precio' => ['required', 'integer'],
            'diasCredito' => ['required', 'integer'],
            'retener' => ['boolean'],
            'desglosarIEPS' => ['boolean'],
            'notificar' => ['boolean'],
            'clave' => ['nullable', 'string', 'max:45'],
            'foto' => ['nullable'],
            'huella' => ['nullable'],
            'muestra' => ['nullable'],
            'usoCfdi' => ['nullable', 'string', 'max:10'],
            'idCIF' => ['nullable', 'string', 'max:20'],
            'sid' => ['nullable', 'string', 'max:15'],
            'eduNivel' => ['nullable', 'string', 'max:128'],
            'eduClave' => ['nullable', 'string', 'max:128'],
            'eduRfc' => ['nullable', 'string', 'max:45'],
            'eduNombre' => ['nullable', 'string', 'max:120'],
            'grc_id' => ['nullable', 'integer'],
            'grupocliente_id' => ['nullable', 'integer'],
            'rgf_id' => ['nullable', 'integer'],
            'regimenfiscal_id' => ['nullable', 'integer'],
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

    public function messages(): array
    {
        return [
            'store_id.required' => 'La tienda es obligatoria.',
            'store_id.exists' => 'La tienda seleccionada no existe.',
            'cli_id.required' => 'El ID del cliente es obligatorio.',
            'cli_id.unique' => 'Ya existe un cliente con ese ID en esta tienda.',
            'rfc.required' => 'El RFC es obligatorio.',
            'curp.required' => 'El CURP es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'celular.required' => 'El celular es obligatorio.',
            'mail.required' => 'El correo es obligatorio.',
            'limite.required' => 'El límite de crédito es obligatorio.',
            'precio.required' => 'El nivel de precio es obligatorio.',
            'diasCredito.required' => 'Los días de crédito son obligatorios.',
            'status.required' => 'El estado del cliente es obligatorio.'
        ];
    }

    public function attributes(): array
    {
        return [
            'cli_id' => 'ID del cliente',
            'store_id' => 'Tienda',
            'nombre' => 'Nombre',
            'representante' => 'Representante legal',
            'domicilio' => 'Domicilio',
            'noExt' => 'Número exterior',
            'noInt' => 'Número interior',
            'localidad' => 'Localidad',
            'ciudad' => 'Ciudad',
            'estado' => 'Estado',
            'pais' => 'País',
            'codigoPostal' => 'Código postal',
            'colonia' => 'Colonia',
            'rfc' => 'RFC',
            'curp' => 'CURP',
            'telefono' => 'Teléfono',
            'celular' => 'Celular',
            'mail' => 'Correo electrónico',
            'comentario' => 'Comentario',
            'status' => 'Estado',
            'limite' => 'Límite de crédito',
            'precio' => 'Nivel de precios',
            'diasCredito' => 'Días de crédito',
            'retener' => '¿Retener ISR?',
            'desglosarIEPS' => '¿Desglosar IEPS?',
            'notificar' => '¿Enviar notificaciones?',
            'clave' => 'Clave interna',
            'foto' => 'Foto',
            'huella' => 'Huella',
            'muestra' => 'Muestra',
            'usoCfdi' => 'Uso CFDI',
            'idCIF' => 'ID CIF',
            'sid' => 'SID',
            'eduNivel' => 'Nivel educativo',
            'eduClave' => 'Clave SEP',
            'eduRfc' => 'RFC escuela',
            'eduNombre' => 'Nombre escuela',
            'grupocliente_id' => 'Grupo de cliente',
            'regimenfiscal_id' => 'Régimen fiscal',
        ];
    }
}
