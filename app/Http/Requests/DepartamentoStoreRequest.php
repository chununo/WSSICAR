<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DepartamentoStoreRequest extends FormRequest
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
            'store_id' => ['required', 'integer', 'exists:stores,id'],
            'dep_id' => ['required', 'integer',
				// única por tienda
				Rule::unique('departamentos')->where(fn ($q) =>
					$q->where('store_id', $this->input('store_id'))
				),
			],
            'nombre' => ['required', 'string'],
            'restringido' => ['required'],
            'porcentaje' => ['required', 'numeric', 'between:-999999999999999999.99,999999999999999999.99'],
            'system' => ['required'],
            'status' => ['required', 'integer'],
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
			'dep_id.unique' => 'El valor de dep_id ya existe para esta tienda.',
			'nombre.required' => 'El campo nombre es obligatorio.',
			'restringido.required' => 'El campo restringido es obligatorio.',
			'porcentaje.required' => 'El campo porcentaje es obligatorio.',
			'porcentaje.numeric' => 'El campo porcentaje debe ser un número.',
			'porcentaje.between' => 'El campo porcentaje debe estar entre -999999999999999999.99 y 999999999999999999.99.',
			'system.required' => 'El campo system es obligatorio.',
			'status.required' => 'El campo status es obligatorio.',
			'status.integer' => 'El campo status debe ser un número entero.',
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function withValidator($validator)
	{
		$validator->after(function ($validator) {
			if ($this->input('restringido') && $this->input('porcentaje') <= 0) {
				$validator->errors()->add('porcentaje', 'El porcentaje debe ser mayor a 0 si restringido es verdadero.');
			}
		});
	}
}
