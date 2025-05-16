<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaqueteStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
			'store_id' 		=> ['required', 'integer', 'exists:stores,id'],
            'paquete'      	=> ['required', 'integer'],
			'articulo'     	=> ['required', 'integer'],
			'cantidad'     	=> ['required', 'numeric'],
			'opcional'     	=> ['nullable', 'boolean'],
			'incluido'     	=> ['nullable', 'boolean'],
			'costoExtra'   	=> ['nullable', 'boolean'],
			'porcion'      	=> ['nullable', 'numeric'],
			'grupo'        	=> ['nullable', 'integer'],
			'maximo'       	=> ['nullable', 'integer'],
			'minimo'       	=> ['nullable', 'integer'],
			'multiplicador'	=> ['nullable', 'integer'],
        ];
    }
}
