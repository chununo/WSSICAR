<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HorarioPromoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre'   => ['sometimes', 'string', 'max:45'],
            'lunes'    => ['sometimes', 'boolean'],
            'iniLun'   => ['nullable', 'date_format:H:i:s'],
            'finLun'   => ['nullable', 'date_format:H:i:s'],
            'martes'   => ['sometimes', 'boolean'],
            'iniMar'   => ['nullable', 'date_format:H:i:s'],
            'finMar'   => ['nullable', 'date_format:H:i:s'],
            'miercoles'=> ['sometimes', 'boolean'],
            'iniMie'   => ['nullable', 'date_format:H:i:s'],
            'finMie'   => ['nullable', 'date_format:H:i:s'],
            'jueves'   => ['sometimes', 'boolean'],
            'iniJue'   => ['nullable', 'date_format:H:i:s'],
            'finJue'   => ['nullable', 'date_format:H:i:s'],
            'viernes'  => ['sometimes', 'boolean'],
            'iniVie'   => ['nullable', 'date_format:H:i:s'],
            'finVie'   => ['nullable', 'date_format:H:i:s'],
            'sabado'   => ['sometimes', 'boolean'],
            'iniSab'   => ['nullable', 'date_format:H:i:s'],
            'finSab'   => ['nullable', 'date_format:H:i:s'],
            'domingo'  => ['sometimes', 'boolean'],
            'iniDom'   => ['nullable', 'date_format:H:i:s'],
            'finDom'   => ['nullable', 'date_format:H:i:s'],
            'status'   => ['sometimes', 'integer'],
        ];
    }

    protected function prepareForValidation(): void
    {
        foreach (['lunes','martes','miercoles','jueves','viernes','sabado','domingo'] as $dia) {
            if ($this->has($dia)) {
                $this->merge([
                    $dia => filter_var($this->input($dia), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
                ]);
            }
        }
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'Nombre',
            'lunes' => 'Lunes',
            'iniLun' => 'Inicio Lunes',
            'finLun' => 'Fin Lunes',
            'martes' => 'Martes',
            'iniMar' => 'Inicio Martes',
            'finMar' => 'Fin Martes',
            'miercoles' => 'Miércoles',
            'iniMie' => 'Inicio Miércoles',
            'finMie' => 'Fin Miércoles',
            'jueves' => 'Jueves',
            'iniJue' => 'Inicio Jueves',
            'finJue' => 'Fin Jueves',
            'viernes' => 'Viernes',
            'iniVie' => 'Inicio Viernes',
            'finVie' => 'Fin Viernes',
            'sabado' => 'Sábado',
            'iniSab' => 'Inicio Sábado',
            'finSab' => 'Fin Sábado',
            'domingo' => 'Domingo',
            'iniDom' => 'Inicio Domingo',
            'finDom' => 'Fin Domingo',
            'status' => 'Estado',
        ];
    }
}
