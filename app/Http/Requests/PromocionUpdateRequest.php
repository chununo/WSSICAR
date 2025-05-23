<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromocionUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'string', 'max:255'],
            'fechaIni' => ['sometimes', 'date'],
            'fechaFin' => ['sometimes', 'date'],
            'descuento' => ['nullable', 'numeric'],
            'pago' => ['nullable', 'integer'],
            'salida' => ['nullable', 'integer'],
            'precio' => ['nullable', 'integer'],
            'condicion' => ['sometimes', 'boolean'],
            'totalMin' => ['nullable', 'numeric'],
            'piezasMin' => ['nullable', 'integer'],
            'piezasReq' => ['nullable', 'integer'],
            'piezasPromo' => ['nullable', 'integer'],
            'cascada' => ['sometimes', 'boolean'],
            'status' => ['sometimes', 'integer'],
            'sincronizar' => ['sometimes', 'boolean'],
            'mixto' => ['sometimes', 'boolean'],
            'mostrarComensal' => ['sometimes', 'boolean'],
            'artReq' => ['sometimes', 'boolean'],
            'artReqMixto' => ['sometimes', 'boolean'],
            'clientes' => ['sometimes', 'boolean'],
            'hor_id' => ['nullable', 'integer'],
            'horariopromo_id' => ['nullable', 'integer', 'exists:horariopromos,id'],
            'validation_status' => ['nullable', 'in:valid,partial,invalid'],
            'validation_errors' => ['nullable', 'array'],
        ];
    }

    protected function prepareForValidation(): void
    {
        foreach ([
            'condicion', 'cascada', 'sincronizar', 'mixto',
            'mostrarComensal', 'artReq', 'artReqMixto', 'clientes'
        ] as $campo) {
            if ($this->has($campo)) {
                $this->merge([
                    $campo => filter_var($this->input($campo), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
                ]);
            }
        }
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'Nombre',
            'fechaIni' => 'Fecha de inicio',
            'fechaFin' => 'Fecha de fin',
            'descuento' => 'Descuento',
            'pago' => 'Pago',
            'salida' => 'Salida',
            'precio' => 'Precio',
            'condicion' => 'Condición',
            'totalMin' => 'Total mínimo',
            'piezasMin' => 'Piezas mínimas',
            'piezasReq' => 'Piezas requeridas',
            'piezasPromo' => 'Piezas en promoción',
            'cascada' => 'Cascada',
            'status' => 'Estado',
            'sincronizar' => 'Sincronizar',
            'mixto' => 'Mixto',
            'mostrarComensal' => 'Mostrar al comensal',
            'artReq' => 'Artículo requerido',
            'artReqMixto' => 'Artículo requerido mixto',
            'clientes' => 'Clientes',
            'hor_id' => 'Horario promocional (ID local)',
            'horariopromo_id' => 'Horario promocional (ID servidor)',
            'validation_status' => 'Estado de validación',
            'validation_errors' => 'Errores de validación',
        ];
    }
}
