<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaqueteUpdateRequest extends FormRequest
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
            'cantidad'      => ['sometimes', 'numeric', 'between:0,99999999999999999999.99999'],
            'opcional'      => ['sometimes', 'boolean'],
            'incluido'      => ['sometimes', 'boolean'],
            'costoExtra'    => ['sometimes', 'boolean'],
            'porcion'       => ['sometimes', 'nullable', 'numeric', 'between:0,99999999999999999999.999'],
            'grupo'         => ['sometimes', 'nullable', 'integer'],
            'maximo'        => ['sometimes', 'nullable', 'integer'],
            'minimo'        => ['sometimes', 'nullable', 'integer'],
            'multiplicador' => ['sometimes', 'nullable', 'integer'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'opcional'   => filter_var($this->opcional, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'incluido'   => filter_var($this->incluido, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'costoExtra' => filter_var($this->costoExtra, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        ]);
    }

    public function messages(): array
    {
        return [
            'cantidad.numeric'       => 'El campo cantidad debe ser numérico.',
            'cantidad.between'       => 'El campo cantidad debe estar entre 0 y 99999999999999999999.99999.',
            'porcion.numeric'        => 'El campo porción debe ser numérico.',
            'porcion.between'        => 'El campo porción debe estar entre 0 y 99999999999999999999.999.',
            'grupo.integer'          => 'El campo grupo debe ser un número entero.',
            'maximo.integer'         => 'El campo máximo debe ser un número entero.',
            'minimo.integer'         => 'El campo mínimo debe ser un número entero.',
            'multiplicador.integer'  => 'El campo multiplicador debe ser un número entero.',
        ];
    }

    public function attributes(): array
    {
        return [
            'cantidad'      => 'Cantidad',
            'opcional'      => 'Opcional',
            'incluido'      => 'Incluido',
            'costoExtra'    => 'Costo Extra',
            'porcion'       => 'Porción',
            'grupo'         => 'Grupo',
            'maximo'        => 'Máximo',
            'minimo'        => 'Mínimo',
            'multiplicador' => 'Multiplicador',
        ];
    }
}
