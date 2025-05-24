<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CortecajaStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'store_id'     => ['required', 'integer', 'exists:stores,id'],
            'cor_id'       => [
                'required', 'integer',
                Rule::unique('cortecajas')->where(fn ($q) =>
                    $q->where('store_id', $this->input('store_id'))
                )
            ],
            'fecha'        => ['required', 'date'],
            'contado'      => ['required', 'numeric'],
            'calculado'    => ['required', 'numeric'],
            'diferencia'   => ['required', 'numeric'],
            'retiro'       => ['required', 'numeric'],
            'caj_id'       => ['required', 'integer'],
        ];
    }

    public function attributes(): array
    {
        return [
            'store_id'   => 'Sucursal',
            'cor_id'     => 'ID Corte Caja',
            'fecha'      => 'Fecha',
            'contado'    => 'Monto Contado',
            'calculado'  => 'Monto Calculado',
            'diferencia' => 'Diferencia',
            'retiro'     => 'Retiro',
            'caj_id'     => 'ID Caja',
        ];
    }
}
