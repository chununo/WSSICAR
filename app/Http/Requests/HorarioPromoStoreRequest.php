<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HorarioPromoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'store_id' => ['required', 'integer', 'exists:stores,id'],
            'hor_id' => [
				'required', 'integer',
				Rule::unique('horariopromos')->where(fn ($q) =>
					$q->where('store_id', $this->input('store_id'))
				)
			],
            'nombre'   => ['required', 'string', 'max:45'],
            'lunes'    => ['required', 'boolean'],
            'iniLun'   => ['nullable', 'date_format:H:i:s'],
            'finLun'   => ['nullable', 'date_format:H:i:s'],
            'martes'   => ['required', 'boolean'],
            'iniMar'   => ['nullable', 'date_format:H:i:s'],
            'finMar'   => ['nullable', 'date_format:H:i:s'],
            'miercoles'=> ['required', 'boolean'],
            'iniMie'   => ['nullable', 'date_format:H:i:s'],
            'finMie'   => ['nullable', 'date_format:H:i:s'],
            'jueves'   => ['required', 'boolean'],
            'iniJue'   => ['nullable', 'date_format:H:i:s'],
            'finJue'   => ['nullable', 'date_format:H:i:s'],
            'viernes'  => ['required', 'boolean'],
            'iniVie'   => ['nullable', 'date_format:H:i:s'],
            'finVie'   => ['nullable', 'date_format:H:i:s'],
            'sabado'   => ['required', 'boolean'],
            'iniSab'   => ['nullable', 'date_format:H:i:s'],
            'finSab'   => ['nullable', 'date_format:H:i:s'],
            'domingo'  => ['required', 'boolean'],
            'iniDom'   => ['nullable', 'date_format:H:i:s'],
            'finDom'   => ['nullable', 'date_format:H:i:s'],
            'status'   => ['required', 'integer'],
        ];
    }

    protected function prepareForValidation(): void
    {
        foreach (['lunes','martes','miercoles','jueves','viernes','sabado','domingo'] as $dia) {
            $this->merge([
                $dia => filter_var($this->input($dia), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            ]);
        }

        $this->merge([
            'status' => filter_var($this->input('status'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        ]);
    }

    public function attributes(): array
    {
        return [
            'store_id' => 'Tienda',
            'hor_id'   => 'ID horario',
            'nombre'   => 'Nombre',
            'lunes'    => 'Lunes',
            'iniLun'   => 'Inicio Lunes',
            'finLun'   => 'Fin Lunes',
            'martes'   => 'Martes',
            'iniMar'   => 'Inicio Martes',
            'finMar'   => 'Fin Martes',
            'miercoles'=> 'Miércoles',
            'iniMie'   => 'Inicio Miércoles',
            'finMie'   => 'Fin Miércoles',
            'jueves'   => 'Jueves',
            'iniJue'   => 'Inicio Jueves',
            'finJue'   => 'Fin Jueves',
            'viernes'  => 'Viernes',
            'iniVie'   => 'Inicio Viernes',
            'finVie'   => 'Fin Viernes',
            'sabado'   => 'Sábado',
            'iniSab'   => 'Inicio Sábado',
            'finSab'   => 'Fin Sábado',
            'domingo'  => 'Domingo',
            'iniDom'   => 'Inicio Domingo',
            'finDom'   => 'Fin Domingo',
            'status'   => 'Estado',
        ];
    }
}
