<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResumencortecajaUpdateRequest extends FormRequest
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
			'store_id' => ['sometimes', 'exists:stores,id'],
			'rcc_id' => ['sometimes', 'integer'],
			'cor_id' => ['nullable', 'integer'],
			'venCon' => ['sometimes', 'numeric'],
			'venCre' => ['sometimes', 'numeric'],
			'venConC' => ['sometimes', 'numeric'],
			'venCreC' => ['sometimes', 'numeric'],
			'comCon' => ['sometimes', 'numeric'],
			'comCre' => ['sometimes', 'numeric'],
			'comConC' => ['sometimes', 'numeric'],
			'comCreC' => ['sometimes', 'numeric'],
			'notCre' => ['sometimes', 'numeric'],
			'notCreC' => ['sometimes', 'numeric'],
			'entVen' => ['sometimes', 'numeric'],
			'entCre' => ['sometimes', 'numeric'],
			'entComC' => ['sometimes', 'numeric'],
			'entNotC' => ['sometimes', 'numeric'],
			'entMov' => ['sometimes', 'numeric'],
			'salCom' => ['sometimes', 'numeric'],
			'salCre' => ['sometimes', 'numeric'],
			'salVenC' => ['sometimes', 'numeric'],
			'salNot' => ['sometimes', 'numeric'],
			'salMov' => ['sometimes', 'numeric'],
			'gasCon' => ['nullable', 'numeric'],
			'gasCre' => ['nullable', 'numeric'],
			'gasConC' => ['nullable', 'numeric'],
			'gasCreC' => ['nullable', 'numeric'],
			'notCrePro' => ['nullable', 'numeric'],
			'notCreProC' => ['nullable', 'numeric'],
			'entGasC' => ['nullable', 'numeric'],
			'salNotProC' => ['nullable', 'numeric'],
			'salGas' => ['nullable', 'numeric'],
			'entNotPro' => ['nullable', 'numeric'],
		];
	}

	public function messages(): array
	{
		return [
			'store_id.exists' => 'El ID de la tienda no existe.',
			'rcc_id.integer' => 'El ID del resumen debe ser un número entero.',
			'venCon.numeric' => 'El campo venCon debe ser un número.',
		];
	}
	public function attributes(): array
	{
		return [
			'store_id' => 'Sucursal',
			'rcc_id' => 'ID del resumen',
			'cor_id' => 'ID del corte',
			'venCon' => 'Ventas contado',
			'venCre' => 'Ventas crédito',
			'venConC' => 'Ventas contado con tarjeta de crédito',
			'venCreC' => 'Ventas crédito con tarjeta de crédito',
			'comCon' => 'Compras contado',
			'comCre' => 'Compras crédito',
			'comConC' => 'Compras contado con tarjeta de crédito',
			'comCreC' => 'Compras crédito con tarjeta de crédito',
			'entVen' => 'Entradas ventas',
			'entCre' => 'Entradas compras',
			'entComC' => 'Entradas compras con tarjeta de crédito',
			'entNotC' => 'Entradas notas de crédito con tarjeta de crédito',
			'entMov' => 'Entradas movimientos',
			'salCom' => 'Salidas compras',
			'salCre' => 'Salidas ventas',
			'salVenC' => 'Salidas ventas con tarjeta de crédito',
			'salNotProC' => 'Salidas notas de crédito con tarjeta de crédito',
			'salGas' => 'Salidas gastos',
			'entNotPro' => 'Entradas notas de débito con tarjeta de crédito'
		];
	}

}
