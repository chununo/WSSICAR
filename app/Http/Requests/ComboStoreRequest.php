<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComboStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
			'store_id' => ['required', 'integer', 'exists:stores,id'],
            'combo'      => ['required', 'integer'],
            'grupo'      => ['required', 'integer'],
            'cantidad'   => ['required', 'integer'],
            'opcional'   => ['sometimes', 'boolean'],
            'orden'      => ['sometimes', 'integer'],
            'incluido'   => ['sometimes', 'boolean'],
            'status'     => ['sometimes', 'integer'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'opcional' => filter_var($this->opcional, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'incluido' => filter_var($this->incluido, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        ]);
    }

    public function messages(): array
    {
        return [
			'store_id.required' => 'El campo tienda es obligatorio.',
			'store_id.integer' => 'El campo tienda debe ser un número entero.',
			'store_id.exists' => 'El campo tienda no es válido.',
            'combo.required'    => 'El campo combo es obligatorio.',
            'combo.integer'     => 'El campo combo debe ser un número entero.',
            'grupo.required'    => 'El campo grupo es obligatorio.',
            'grupo.integer'     => 'El campo grupo debe ser un número entero.',
            'cantidad.required' => 'El campo cantidad es obligatorio.',
            'cantidad.integer'  => 'El campo cantidad debe ser un número entero.',
            'opcional.boolean'  => 'El campo opcional debe ser verdadero o falso.',
            'orden.integer'     => 'El campo orden debe ser un número entero.',
            'incluido.boolean'  => 'El campo incluido debe ser verdadero o falso.',
            'status.integer'    => 'El campo status debe ser un número entero.',
        ];
    }

    public function attributes(): array
    {
        return [
			'store_id'  => 'Tienda',
            'combo'     => 'Combo (artículo)',
            'grupo'     => 'Grupo',
            'cantidad'  => 'Cantidad',
            'opcional'  => 'Opción adicional',
            'orden'     => 'Orden de aparición',
            'incluido'  => 'Incluido',
            'status'    => 'Estado',
        ];
    }

}
