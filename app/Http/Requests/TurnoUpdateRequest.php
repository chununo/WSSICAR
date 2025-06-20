<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TurnoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'   => ['sometimes', 'string', 'max:45'],
            'nocturno' => ['sometimes', 'boolean'],
            'semana'   => ['sometimes', 'boolean'],
            'horaEnt'  => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'horaSal'  => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'lunes'    => ['sometimes', 'boolean'],
            'entLun'   => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'salLun'   => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'martes'   => ['sometimes', 'boolean'],
            'entMar'   => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'salMar'   => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'miercoles'=> ['sometimes', 'boolean'],
            'entMie'   => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'salMie'   => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'jueves'   => ['sometimes', 'boolean'],
            'entJue'   => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'salJue'   => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'viernes'  => ['sometimes', 'boolean'],
            'entVie'   => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'salVie'   => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'sabado'   => ['sometimes', 'boolean'],
            'entSab'   => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'salSab'   => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'domingo'  => ['sometimes', 'boolean'],
            'entDom'   => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'salDom'   => ['sometimes', 'nullable', 'date_format:H:i:s'],
            'tipo'     => ['sometimes', 'integer', 'in:1,2'],
            'status'   => ['sometimes', 'integer', 'in:1,2'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $booleanFields = ['nocturno','semana','lunes','martes','miercoles','jueves','viernes','sábado','domingo'];
        foreach ($booleanFields as $field) {
            if ($this->has($field)) {
                $this->merge([$field => filter_var($this->$field, FILTER_VALIDATE_BOOLEAN)]);
            }
        }
    }
}
