<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CajaStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'store_id' => ['required', 'integer', 'exists:stores,id'],
            'caj_id' => [
                'required', 'integer',
                Rule::unique('cajas')->where(fn ($q) =>
                    $q->where('store_id', $this->input('store_id'))
                ),
            ],
            'nombre' => ['required', 'string', 'max:45'],
            'total' => ['required', 'numeric', 'between:0,999999999999999999.99'],
            'status' => ['required', 'integer'],
        ];
    }

    public function attributes(): array
    {
        return [
            'store_id' => 'Tienda',
            'caj_id' => 'ID local de caja',
            'nombre' => 'Nombre',
            'total' => 'Total',
            'status' => 'Estado',
        ];
    }
}
