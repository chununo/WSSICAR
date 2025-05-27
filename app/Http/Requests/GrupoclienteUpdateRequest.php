<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrupoclienteUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'descripcion' => ['sometimes', 'string', 'max:255'],
            'precio' => ['sometimes', 'integer'],
            'precioObligatorio' => ['sometimes', 'boolean'],
            'status' => ['sometimes', 'integer'],
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
            'descripcion' => 'Descripción',
            'precio' => 'Precio',
            'precioObligatorio' => '¿Precio obligatorio?',
            'status' => 'Estado',
        ];
    }
}
