<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GrupoclienteStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'store_id' => ['required', 'exists:stores,id'],
            'grc_id' => [
                'required',
                'integer',
                Rule::unique('grupoclientes')->where(fn ($q) =>
                    $q->where('store_id', $this->input('store_id'))
                ),
            ],
            'descripcion' => ['required', 'string', 'max:255'],
            'precio' => ['required', 'integer'],
            'precioObligatorio' => ['required', 'boolean'],
            'status' => ['required', 'integer'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'precioObligatorio' => filter_var($this->precioObligatorio, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        ]);
    }

    public function attributes(): array
    {
        return [
            'store_id' => 'Tienda',
            'grc_id' => 'ID del grupo cliente',
            'descripcion' => 'Descripción',
            'precio' => 'Precio',
            'precioObligatorio' => '¿Precio obligatorio?',
            'status' => 'Estado',
        ];
    }
}
