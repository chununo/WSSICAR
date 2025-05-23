<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoriaUpdateRequest extends FormRequest
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
            'nombre' => ['sometimes', 'string', 'max:45'],
            'system' => ['sometimes'],
            'status' => ['sometimes', 'integer'],
            'dep_id'   => ['sometimes','integer'],
            'imagen' => ['nullable'],
            'comision' => ['nullable', 'numeric', 'between:-9999999999999999.9999,9999999999999999.9999'],
        ];
    }

	/**
	 * Convierte "0"/"1" a boolean antes de validar,
	 * si tu frontend manda strings.
	 */
	protected function prepareForValidation(): void
	{
		$this->merge([
			'system' => filter_var($this->system, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
		]);
	}
	public function messages(): array
	{
		return [
			'store_id.required' => 'El campo store_id es obligatorio.',
			'store_id.integer' => 'El campo store_id debe ser un número entero.',
			'store_id.exists' => 'El valor seleccionado para store_id no es válido.',
			'cat_id.required' => 'El campo cat_id es obligatorio.',
			'cat_id.integer' => 'El campo cat_id debe ser un número entero.',
			'nombre.required' => 'El campo nombre es obligatorio.',
			'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
			'nombre.max' => 'El campo nombre no puede tener más de 45 caracteres.',
			'system.required' => 'El campo system es obligatorio.',
			'system.boolean' => 'El campo system debe ser verdadero o falso.',
			'status.required' => 'El campo status es obligatorio.',
			'status.integer' => 'El campo status debe ser un número entero.',
			'departamento_id.required' => 'El campo departamento_id es obligatorio.',
			'departamento_id.integer' => 'El campo departamento_id debe ser un número entero.',
			'departamento_id.exists' => 'El valor seleccionado para departamento_id no es válido.',
			'imagen.image' => 'El archivo de imagen debe ser una imagen válida (jpg, jpeg, png, bmp, gif, svg).',
			'imagen.max' => 'La imagen no puede exceder los 2MB de tamaño.',
			'comision.numeric' => 'El campo comision debe ser un número.',
			'comision.between' => 'El campo comision debe estar entre -9999999999999999.9999 y 9999999999999999.9999',
			'dep_id.exists' => "El departamento :input no existe en tu tienda.",
		];
	}
	public function attributes(): array
	{
		return [
			'store_id' => 'ID de la tienda',
			'cat_id' => 'ID de la categoría',
			'nombre' => 'Nombre de la categoría',
			'system' => 'Sistema',
			'status' => 'Estado',
			'departamento_id' => 'ID del departamento',
			'imagen' => 'Imagen de la categoría',
			'comision' => 'Comisión',
			'dep_id' => 'ID del departamento',
		];
	}
}
