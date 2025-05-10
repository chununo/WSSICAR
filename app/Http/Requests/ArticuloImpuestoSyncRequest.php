<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloImpuestoSyncRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // o comprueba permisos
    }

    public function rules(): array
    {
        return [
            'impuestos'   => ['sometimes','array'],
            'impuestos.*' => ['integer'], // aquí podrías validar exists:imp_id si quisieras
        ];
    }
}
