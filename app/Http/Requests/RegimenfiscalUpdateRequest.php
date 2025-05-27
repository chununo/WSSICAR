<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegimenfiscalUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'clave' => ['sometimes', 'string', 'max:5'],
            'descripcion' => ['sometimes', 'string', 'max:255'],
            'fisica' => ['sometimes', 'boolean'],
            'moral' => ['sometimes', 'boolean'],
            'status' => ['sometimes', 'integer'],
        ];
    }

    public function attributes(): array
    {
        return [
            'clave' => 'Clave',
            'descripcion' => 'Descripción',
            'fisica' => 'Persona física',
            'moral' => 'Persona moral',
            'status' => 'Estado',
        ];
    }
}

