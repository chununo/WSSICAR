<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class ImpuestoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        
		// El modelo actual llega por route-model-binding:  /impuestos/{impuesto}
        $impuestoActual = $this->route('impuesto');

        return [
            // FK
            'store_id' => [
                'sometimes', 'integer', 'exists:stores,id',
            ],

            // id “local” (único por tienda)
            'imp_id'   => [
                'sometimes', 'integer',
                Rule::unique('impuestos')
                    ->where(fn ($q) =>
                        $q->where('store_id', $this->input('store_id', $impuestoActual->store_id))
                    )
                    ->ignore($impuestoActual->id),   // ignora el propio registro
            ],

            'nombre'     => ['sometimes', 'string', 'max:20'],
            'impuesto'   => ['sometimes', 'numeric', 'between:0,99999999999999.999999'],

            // booleanos
            'impreso'    => ['sometimes', 'boolean'],
            'tras'       => ['sometimes', 'boolean'],
            'local'      => ['sometimes', 'boolean'],
            'aplicarIVA' => ['sometimes', 'boolean'],

            // enteros
            'orden'          => ['sometimes', 'integer'],
            'status'         => ['sometimes', 'integer'],
            'cco_id'         => ['nullable', 'integer'],
            'compraPagada'   => ['nullable', 'integer'],
            'compraCredito'  => ['nullable', 'integer'],
            'gastoPagado'    => ['nullable', 'integer'],
            'gastoCredito'   => ['nullable', 'integer'],
            'anticipoCliente'=> ['nullable', 'integer'],

            // texto opcional
            'tipoFactor' => ['nullable', 'string', 'max:15'],
        ];
    }

    /**
     * Convierte "0"/"1" a boolean antes de validar (si tu frontend manda strings).
     */
    protected function prepareForValidation(): void
    {
        foreach (['impreso','tras','local','aplicarIVA'] as $campo) {
            if ($this->has($campo)) {
                $this->merge([$campo => filter_var($this->$campo, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)]);
            }
        }
    }
}
