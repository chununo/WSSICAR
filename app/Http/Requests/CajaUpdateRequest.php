<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CajaUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'string', 'max:45'],
            'total' => ['sometimes', 'numeric', 'between:0,999999999999999999.99'],
            'status' => ['sometimes', 'integer'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'Nombre',
            'total' => 'Total',
            'status' => 'Estado',
        ];
    }
}
