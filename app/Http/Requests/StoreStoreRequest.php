<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStoreRequest extends FormRequest
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
            'nombre' => ['required', 'string'],
            'alias' => ['nullable', 'string'],
            'correo_principal' => ['nullable', 'string'],
            'correo_secundario' => ['nullable', 'string'],
            'telefono_principal' => ['nullable', 'string'],
            'telefono_secundario' => ['nullable', 'string'],
            'calle' => ['nullable', 'string'],
            'numero_externo' => ['nullable', 'string'],
            'numero_interno' => ['nullable', 'string'],
            'colonia' => ['nullable', 'string'],
            'entidad' => ['nullable', 'string'],
            'estado' => ['nullable', 'string'],
            'cp' => ['nullable', 'string'],
            'nota_direccion' => ['nullable', 'string'],
        ];
    }
}
