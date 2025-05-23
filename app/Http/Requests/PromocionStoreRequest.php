<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PromocionStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'store_id' => ['required', 'integer', 'exists:stores,id'],
            'pro_id' => [
                'required', 'integer',
                Rule::unique('promociones')->where(fn ($q) =>
                    $q->where('store_id', $this->input('store_id'))
                ),
            ],
            'nombre' => ['required', 'string', 'max:255'],
            'fechaIni' => ['required', 'date'],
            'fechaFin' => ['required', 'date'],
            'descuento' => ['nullable', 'numeric'],
            'pago' => ['nullable', 'integer'],
            'salida' => ['nullable', 'integer'],
            'precio' => ['nullable', 'integer'],
            'condicion' => ['required', 'boolean'],
            'totalMin' => ['nullable', 'numeric'],
            'piezasMin' => ['nullable', 'integer'],
            'piezasReq' => ['nullable', 'integer'],
            'piezasPromo' => ['nullable', 'integer'],
            'cascada' => ['required', 'boolean'],
            'status' => ['required', 'integer'],
            'sincronizar' => ['required', 'boolean'],
            'mixto' => ['required', 'boolean'],
            'mostrarComensal' => ['required', 'boolean'],
            'artReq' => ['required', 'boolean'],
            'artReqMixto' => ['required', 'boolean'],
            'clientes' => ['required', 'boolean'],
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
            $this->merge([
                $campo => filter_var($this->input($campo), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            ]);
        }
    }

    public function attributes(): array
    {
        return [
            'store_id' => 'Tienda',
            'pro_id' => 'ID de promoción',
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
