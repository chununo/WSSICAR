<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MonedaStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'store_id'     => ['required', 'integer', 'exists:stores,id'],
            'mon_id'       => ['required', 'integer',
                Rule::unique('monedas')->where(fn ($q) =>
                    $q->where('store_id', $this->input('store_id'))
                )
            ],
            'moneda'       => ['required', 'string', 'max:45'],
            'abr'          => ['required', 'string', 'max:5'],
            'tipoCambio'   => ['required', 'numeric', 'between:0,9999999999999999.999999'],
            'singPlur'     => ['required', 'string', 'max:90'],
            'caracter'     => ['required', 'string', 'max:5'],
            'mn'           => ['required', 'boolean'],
            'img16'        => ['nullable'],
            'img24'        => ['nullable'],
            'img32'        => ['nullable'],
            'status'       => ['required', 'integer'],
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
            'store_id' => 'Sucursal',
            'mon_id' => 'ID Local',
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
