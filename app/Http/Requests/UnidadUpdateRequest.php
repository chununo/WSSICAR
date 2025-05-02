<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UnidadUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'string', 'max:5'],
            'status' => ['sometimes', 'integer'],
            'clave' => ['nullable', 'string', 'max:10'],
        ];
    }

	public function messages(): array
	{
		return [
			'store_id.required' => 'El campo store_id es obligatorio.',
			'store_id.integer' => 'El campo store_id debe ser un número entero.',
			'store_id.exists' => 'El valor seleccionado para store_id no es válido.',
			'uni_id.required' => 'El campo uni_id es obligatorio.',
			'uni_id.integer' => 'El campo uni_id debe ser un número entero.',
			'uni_id.unique' => 'El valor de uni_id ya existe para esta tienda.',
			'nombre.required' => 'El campo nombre es obligatorio.',
			'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
			'nombre.max' => 'El campo nombre no puede tener más de 5 caracteres.',
			'status.required' => 'El campo status es obligatorio.',
			'status.integer' => 'El campo status debe ser un número entero.',
			'clave.string' => 'El campo clave debe ser una cadena de texto.',
			'clave.max' => 'El campo clave no puede tener más de 10 caracteres.',
		];
	}
}
