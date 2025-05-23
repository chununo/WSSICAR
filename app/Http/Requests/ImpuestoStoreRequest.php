<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ImpuestoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {


        return [
            'store_id'        => ['required', 'exists:stores,id'],
            'imp_id'          => [
                'required',
                'integer',
                // única por tienda
                Rule::unique('impuestos')->where(fn ($q) =>
                    $q->where('store_id', $this->input('store_id'))
                ),
            ],
            'nombre'          => ['required', 'string', 'max:20'],
            'impuesto'        => ['required', 'numeric', 'between:0,99999999999999.999999'],
            'impreso'         => ['required', 'boolean'],
            'tras'            => ['required', 'boolean'],
            'local'           => ['required', 'boolean'],
            'aplicarIVA'      => ['required', 'boolean'],
            'orden'           => ['required', 'integer'],
            'status'          => ['required', 'integer'],
            'tipoFactor'      => ['nullable', 'string', 'max:15'],
            'cco_id'          => ['nullable', 'integer'],
            'compraPagada'    => ['nullable', 'integer'],
            'compraCredito'   => ['nullable', 'integer'],
            'gastoPagado'     => ['nullable', 'integer'],
            'gastoCredito'    => ['nullable', 'integer'],
            'anticipoCliente' => ['nullable', 'integer'],
        ];
    }

    /**
     * Convierte "0"/"1" a boolean antes de validar,
     * si tu frontend manda strings.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'impreso'    => filter_var($this->impreso,    FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'tras'       => filter_var($this->tras,       FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'local'      => filter_var($this->local,      FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'aplicarIVA' => filter_var($this->aplicarIVA, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        ]);
    }

	public function messages(): array
	{
		return [
			'store_id.required' => 'El campo store_id es obligatorio.',
			'store_id.exists'   => 'El valor seleccionado para store_id no es válido.',
			'imp_id.required'   => 'El campo imp_id es obligatorio.',
			'imp_id.integer'    => 'El campo imp_id debe ser un número entero.',
			'nombre.required'   => 'El campo nombre es obligatorio.',
			'nombre.string'     => 'El campo nombre debe ser una cadena de texto.',
			'nombre.max'        => 'El campo nombre no puede tener más de 20 caracteres.',
			'impuesto.required' => 'El campo impuesto es obligatorio.',
			'impuesto.numeric'  => 'El campo impuesto debe ser un número.',
			'impuesto.between'  => 'El campo impuesto debe estar entre 0 y 99999999999999.999999.',
		];
	}

}
