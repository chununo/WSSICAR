<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartamentoUpdateRequest extends FormRequest
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
            'nombre' => ['sometimes', 'string'],
            'restringido' => ['sometimes'],
            'porcentaje' => ['sometimes', 'numeric', 'between:-999999999999999999.99,999999999999999999.99'],
            'system' => ['sometimes'],
            'status' => ['sometimes', 'integer'],
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
			'restringido' => filter_var($this->restringido, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
			'system' => filter_var($this->system, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
		]);
	}
	public function messages(): array
	{
		return [
			'store_id.required' => 'El campo store_id es obligatorio.',
			'store_id.integer' => 'El campo store_id debe ser un número entero.',
			'store_id.exists' => 'El valor seleccionado para store_id no es válido.',
			'dep_id.required' => 'El campo dep_id es obligatorio.',
			'dep_id.integer' => 'El campo dep_id debe ser un número entero.',
		];
	}
}
