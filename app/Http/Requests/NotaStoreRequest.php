<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NotaStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'store_id' => ['required', 'integer', 'exists:stores,id'],
            'not_id' => ['required', 'integer',
                Rule::unique('notas')->where(fn ($q) =>
                    $q->where('store_id', $this->input('store_id'))
                )
            ],
            'cli_id' => ['required', 'integer'],
        ];
    }

    public function attributes(): array
    {
        return [
            'store_id' => 'ID de la tienda',
            'not_id' => 'ID de la nota',
            'cli_id' => 'ID local del cliente',
        ];
    }

    public function messages(): array
    {
        return [
            'store_id.required' => 'La tienda es obligatoria.',
            'store_id.exists' => 'La tienda seleccionada no existe.',
            'not_id.required' => 'El ID de la nota es obligatorio.',
            'not_id.unique' => 'Ya existe una nota con ese ID en esta tienda.',
            'cli_id.required' => 'El ID del cliente es obligatorio.',
        ];
    }
}
