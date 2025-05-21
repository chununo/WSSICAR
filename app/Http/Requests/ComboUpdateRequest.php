<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComboUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cantidad'   => ['sometimes', 'integer'],
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
            'cantidad.integer'  => 'La cantidad debe ser un número entero.',
            'opcional.boolean'  => 'El campo opcional debe ser verdadero o falso.',
            'orden.integer'     => 'El orden debe ser un número entero.',
            'incluido.boolean'  => 'El campo incluido debe ser verdadero o falso.',
            'status.integer'    => 'El campo estado debe ser un número entero.',
        ];
    }

    public function attributes(): array
    {
        return [
            'cantidad'  => 'Cantidad',
            'opcional'  => 'Opción adicional',
            'orden'     => 'Orden',
            'incluido'  => 'Incluido',
            'status'    => 'Estado',
        ];
    }

}
