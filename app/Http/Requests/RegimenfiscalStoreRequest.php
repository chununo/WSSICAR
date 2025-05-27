<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegimenfiscalStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'store_id' => ['required', 'exists:stores,id'],
            'rgf_id' => [
                'required', 'integer',
                Rule::unique('regimenfiscales')->where(fn ($q) =>
                    $q->where('store_id', $this->input('store_id'))
                ),
            ],
            'clave' => ['required', 'string', 'max:5'],
            'descripcion' => ['required', 'string', 'max:255'],
            'fisica' => ['required', 'boolean'],
            'moral' => ['required', 'boolean'],
            'status' => ['required', 'integer'],
        ];
    }

    public function attributes(): array
    {
        return [
            'rgf_id' => 'ID local',
            'clave' => 'Clave',
            'descripcion' => 'Descripción',
            'fisica' => 'Persona física',
            'moral' => 'Persona moral',
            'status' => 'Estado',
        ];
    }
}

