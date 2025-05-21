<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrupoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'string', 'max:45'],
            'status' => ['sometimes', 'integer'],
            'padre' => ['sometimes', 'nullable', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El campo nombre no puede tener más de 45 caracteres.',
            'status.integer' => 'El campo estado debe ser un número entero.',
            'padre.integer' => 'El campo padre debe ser un número entero.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre',
            'status' => 'estado',
            'padre' => 'grupo padre',
        ];
    }
}
