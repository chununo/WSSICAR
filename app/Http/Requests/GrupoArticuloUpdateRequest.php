<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrupoArticuloUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'costoExtra' => ['sometimes', 'numeric', 'between:-9999999999999999.99,9999999999999999.99'],
            'status'     => ['sometimes', 'integer'],
            'cantidad'   => ['nullable', 'numeric', 'between:-9999999999999999.999,9999999999999999.999'],
            'imprimir'   => ['nullable', 'boolean'],
            'alias'      => ['nullable', 'string', 'max:100'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'imprimir' => filter_var($this->imprimir, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        ]);
    }

    public function attributes(): array
    {
        return [
            'costoExtra' => 'Costo extra',
            'status'     => 'Estado',
            'cantidad'   => 'Cantidad',
            'imprimir'   => 'Imprimir',
            'alias'      => 'Alias',
        ];
    }
}