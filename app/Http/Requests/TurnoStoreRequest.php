<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TurnoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'store_id' => ['required', 'integer', 'exists:stores,id'],
            'tur_id'   => [
                'required', 'integer',
                Rule::unique('turnos')->where(fn($q) => $q->where('store_id', $this->get('store_id'))),
            ],
            'nombre'   => ['required', 'string', 'max:45'],
            'nocturno' => ['required', 'boolean'],
            'semana'   => ['required', 'boolean'],
            // Horas generales
            'horaEnt'  => ['nullable', 'date_format:H:i:s'],
            'horaSal'  => ['nullable', 'date_format:H:i:s'],
            // Por día
            'lunes'    => ['nullable', 'boolean'],
            'entLun'   => ['nullable', 'date_format:H:i:s'],
            'salLun'   => ['nullable', 'date_format:H:i:s'],
            'martes'   => ['nullable', 'boolean'],
            'entMar'   => ['nullable', 'date_format:H:i:s'],
            'salMar'   => ['nullable', 'date_format:H:i:s'],
            'miercoles'=> ['nullable', 'boolean'],
            'entMie'   => ['nullable', 'date_format:H:i:s'],
            'salMie'   => ['nullable', 'date_format:H:i:s'],
            'jueves'   => ['nullable', 'boolean'],
            'entJue'   => ['nullable', 'date_format:H:i:s'],
            'salJue'   => ['nullable', 'date_format:H:i:s'],
            'viernes'  => ['nullable', 'boolean'],
            'entVie'   => ['nullable', 'date_format:H:i:s'],
            'salVie'   => ['nullable', 'date_format:H:i:s'],
            'sabado'   => ['nullable', 'boolean'],
            'entSab'   => ['nullable', 'date_format:H:i:s'],
            'salSab'   => ['nullable', 'date_format:H:i:s'],
            'domingo'  => ['nullable', 'boolean'],
            'entDom'   => ['nullable', 'date_format:H:i:s'],
            'salDom'   => ['nullable', 'date_format:H:i:s'],
            'tipo'     => ['sometimes', 'integer', 'in:1,2'],
            'status'   => ['sometimes', 'integer', 'in:1,2'],
        ];
    }

    /** Convierte "0"/"1" string a boolean antes de validar */
    protected function prepareForValidation(): void
    {
        $booleanFields = ['nocturno','semana','lunes','martes','miercoles','jueves','viernes','sabado','domingo'];
        foreach ($booleanFields as $field) {
            if ($this->has($field)) {
                $this->merge([$field => filter_var($this->$field, FILTER_VALIDATE_BOOLEAN)]);
            }
        }
    }
}