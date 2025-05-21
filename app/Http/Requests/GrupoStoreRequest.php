<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GrupoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'store_id' => ['required', 'integer', 'exists:stores,id'],
            'gar_id' => [
                'required',
                'integer',
                Rule::unique('grupos')->where(fn ($q) =>
                    $q->where('store_id', $this->input('store_id'))
                ),
            ],
            'nombre' => ['required', 'string', 'max:45'],
            'status' => ['required', 'integer'],
            'padre' => ['nullable', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'store_id.required' => 'El campo tienda es obligatorio.',
            'store_id.integer' => 'El campo tienda debe ser un número.',
            'store_id.exists' => 'La tienda seleccionada no existe.',
            'gar_id.required' => 'El campo ID local del grupo es obligatorio.',
            'gar_id.integer' => 'El campo ID local del grupo debe ser un número.',
            'gar_id.unique' => 'El ID local del grupo ya existe para esta tienda.',
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El campo nombre no puede tener más de 45 caracteres.',
            'status.required' => 'El campo estado es obligatorio.',
            'status.integer' => 'El campo estado debe ser un número entero.',
            'padre.integer' => 'El campo padre debe ser un número entero.',
        ];
    }

    public function attributes(): array
    {
        return [
            'store_id' => 'tienda',
            'gar_id' => 'ID local del grupo',
            'nombre' => 'nombre',
            'status' => 'estado',
            'padre' => 'grupo padre',
        ];
    }
}
