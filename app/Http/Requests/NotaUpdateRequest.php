<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cli_id' => ['sometimes', 'integer'],
        ];
    }

    public function attributes(): array
    {
        return [
            'cli_id' => 'ID local del cliente',
        ];
    }

    public function messages(): array
    {
        return [
            'cli_id.integer' => 'El ID del cliente debe ser un número entero.',
        ];
    }
}
