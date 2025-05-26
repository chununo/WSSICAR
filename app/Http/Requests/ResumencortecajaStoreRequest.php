<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResumencortecajaStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'store_id' => ['required', 'exists:stores,id'],
            'rcc_id' => [
                'required',
                'integer',
                Rule::unique('resumencortecajas')->where(fn ($q) =>
                    $q->where('store_id', $this->input('store_id'))
                )
            ],
            'cor_id' => ['nullable', 'integer'],
            // Todos los demás campos decimales obligatorios
            'venCon' => ['required', 'numeric'],
            'venCre' => ['required', 'numeric'],
            'venConC' => ['required', 'numeric'],
            'venCreC' => ['required', 'numeric'],
            'comCon' => ['required', 'numeric'],
            'comCre' => ['required', 'numeric'],
            'comConC' => ['required', 'numeric'],
            'comCreC' => ['required', 'numeric'],
            'notCre' => ['required', 'numeric'],
            'notCreC' => ['required', 'numeric'],
            'entVen' => ['required', 'numeric'],
            'entCre' => ['required', 'numeric'],
            'entComC' => ['required', 'numeric'],
            'entNotC' => ['required', 'numeric'],
            'entMov' => ['required', 'numeric'],
            'salCom' => ['required', 'numeric'],
            'salCre' => ['required', 'numeric'],
            'salVenC' => ['required', 'numeric'],
            'salNot' => ['required', 'numeric'],
            'salMov' => ['required', 'numeric'],
            // Campos opcionales
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


    public function attributes(): array
    {
        return [
            'store_id' => 'Sucursal',
            'rcc_id' => 'ID del resumen',
            'cor_id' => 'ID del corte',
            'venCon' => 'Ventas contado',
            'venCre' => 'Ventas crédito',
            'venConC' => 'Ventas contado C',
            'venCreC' => 'Ventas crédito C',
            'comCon' => 'Compras contado',
            'comCre' => 'Compras crédito',
            'comConC' => 'Compras contado C',
            'comCreC' => 'Compras crédito C',
            'notCre' => 'Notas de crédito',
            'notCreC' => 'Notas de crédito C',
            'entVen' => 'Entradas por venta',
            'entCre' => 'Entradas por crédito',
            'entComC' => 'Entradas compras C',
            'entNotC' => 'Entradas notas C',
            'entMov' => 'Entradas por movimiento',
            'salCom' => 'Salidas por compra',
            'salCre' => 'Salidas por crédito',
            'salVenC' => 'Salidas ventas C',
            'salNot' => 'Salidas notas',
            'salMov' => 'Salidas por movimiento',
            'gasCon' => 'Gasto contado',
            'gasCre' => 'Gasto crédito',
            'gasConC' => 'Gasto contado C',
            'gasCreC' => 'Gasto crédito C',
            'notCrePro' => 'Notas crédito proveedor',
            'notCreProC' => 'Notas crédito proveedor C',
            'entGasC' => 'Entradas gasto C',
            'salNotProC' => 'Salidas notas proveedor C',
            'salGas' => 'Salidas gasto',
            'entNotPro' => 'Entradas notas proveedor',
        ];
    }
}
