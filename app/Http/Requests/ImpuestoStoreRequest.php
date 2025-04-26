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
			'store_id.required' => 'Debes indicar la sucursal para crear un impuesto.',
			'store_id.exists'   => 'La sucursal seleccionada no existe.',
			'imp_id.exists'   => 'Impuesto ya existe.',
		];
	}

}
