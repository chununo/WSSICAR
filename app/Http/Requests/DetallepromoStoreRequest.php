<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DetallepromoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'store_id' => ['required', 'integer', 'exists:stores,id'],
            'dpr_id' => [
                'required', 'integer',
                Rule::unique('detallepromos')->where(fn ($q) =>
                    $q->where('store_id', $this->input('store_id'))
                ),
            ],
            'pro_id' => ['required', 'integer'],
            'promocion_id' => ['nullable', 'integer', 'exists:promociones,id'],
            'art_id' => ['nullable', 'integer'],
            'articulo_id' => ['nullable', 'integer', 'exists:articulos,id'],
            'cat_id' => ['nullable', 'integer'],
            'categoria_id' => ['nullable', 'integer', 'exists:categorias,id'],
            'dep_id' => ['nullable', 'integer'],
            'departamento_id' => ['nullable', 'integer', 'exists:departamentos,id'],
            'tipo' => ['sometimes', 'integer'],
            'status' => ['sometimes', 'integer'],
            'validation_status' => ['nullable', 'in:valid,partial,invalid'],
            'validation_errors' => ['nullable', 'array'],
        ];
    }

    public function attributes(): array
    {
        return [
            'store_id' => 'Tienda',
            'dpr_id' => 'ID local de detalle promo',
            'pro_id' => 'ID local de la promoción',
            'promocion_id' => 'ID servidor de la promoción',
            'art_id' => 'ID local del artículo',
            'articulo_id' => 'ID servidor del artículo',
            'cat_id' => 'ID local de la categoría',
            'categoria_id' => 'ID servidor de la categoría',
            'dep_id' => 'ID local del departamento',
            'departamento_id' => 'ID servidor del departamento',
            'tipo' => 'Tipo',
            'status' => 'Estado',
            'validation_status' => 'Estado de validación',
            'validation_errors' => 'Errores de validación',
        ];
    }
}
