<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MonedaUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'moneda'       => ['sometimes', 'string', 'max:45'],
            'abr'          => ['sometimes', 'string', 'max:5'],
            'tipoCambio'   => ['sometimes', 'numeric', 'between:0,9999999999999999.999999'],
            'singPlur'     => ['sometimes', 'string', 'max:90'],
            'caracter'     => ['sometimes', 'string', 'max:5'],
            'mn'           => ['sometimes', 'boolean'],
            'img16'        => ['nullable'],
            'img24'        => ['nullable'],
            'img32'        => ['nullable'],
            'status'       => ['sometimes', 'integer'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'mn' => filter_var($this->mn, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        ]);
    }

    public function attributes(): array
    {
        return [
            'moneda' => 'Nombre de la moneda',
            'abr' => 'Abreviación',
            'tipoCambio' => 'Tipo de cambio',
            'singPlur' => 'Singular/Plural',
            'caracter' => 'Símbolo',
            'mn' => '¿Es moneda nacional?',
            'img16' => 'Icono 16px',
            'img24' => 'Icono 24px',
            'img32' => 'Icono 32px',
            'status' => 'Estado',
        ];
    }
}
