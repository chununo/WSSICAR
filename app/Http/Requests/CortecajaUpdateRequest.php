<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CortecajaUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fecha'        => ['sometimes', 'date'],
            'contado'      => ['sometimes', 'numeric'],
            'calculado'    => ['sometimes', 'numeric'],
            'diferencia'   => ['sometimes', 'numeric'],
            'retiro'       => ['sometimes', 'numeric'],
            'caj_id'       => ['sometimes', 'integer'],
        ];
    }

    public function attributes(): array
    {
        return [
            'fecha'      => 'Fecha',
            'contado'    => 'Monto Contado',
            'calculado'  => 'Monto Calculado',
            'diferencia' => 'Diferencia',
            'retiro'     => 'Retiro',
            'caj_id'     => 'ID Caja',
        ];
    }
}
