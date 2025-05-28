<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Vacacion;

class VacacionUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['sometimes', 'string', 'max:255'],
            'minimo' => ['sometimes', 'integer'],
            'a1' => ['sometimes', 'integer'], 'a2' => ['sometimes', 'integer'], 'a3' => ['sometimes', 'integer'],
            'a4' => ['sometimes', 'integer'], 'a5' => ['sometimes', 'integer'], 'a6' => ['sometimes', 'integer'],
            'a7' => ['sometimes', 'integer'], 'a8' => ['sometimes', 'integer'], 'a9' => ['sometimes', 'integer'],
            'a10' => ['sometimes', 'integer'], 'a11' => ['sometimes', 'integer'], 'a12' => ['sometimes', 'integer'],
            'a13' => ['sometimes', 'integer'], 'a14' => ['sometimes', 'integer'], 'a15' => ['sometimes', 'integer'],
            'a16' => ['sometimes', 'integer'], 'a17' => ['sometimes', 'integer'], 'a18' => ['sometimes', 'integer'],
            'a19' => ['sometimes', 'integer'], 'a20' => ['sometimes', 'integer'], 'a21' => ['sometimes', 'integer'],
            'a22' => ['sometimes', 'integer'], 'a23' => ['sometimes', 'integer'], 'a24' => ['sometimes', 'integer'],
            'a25' => ['sometimes', 'integer'], 'a26' => ['sometimes', 'integer'], 'a27' => ['sometimes', 'integer'],
            'a28' => ['sometimes', 'integer'], 'a29' => ['sometimes', 'integer'], 'a30' => ['sometimes', 'integer'],
            'a31' => ['sometimes', 'integer'], 'a32' => ['sometimes', 'integer'], 'a33' => ['sometimes', 'integer'],
            'a34' => ['sometimes', 'integer'], 'a35' => ['sometimes', 'integer'], 'a36' => ['sometimes', 'integer'],
            'a37' => ['sometimes', 'integer'], 'a38' => ['sometimes', 'integer'], 'a39' => ['sometimes', 'integer'],
            'a40' => ['sometimes', 'integer'],
            'fechaVigorReemplazo' => ['sometimes', 'nullable', 'date'],
			'vacacionReemplazo' => ['sometimes', 'integer'],
            'vacacionReemplazo_id' => ['nullable', 'integer'],
            'validation_status' => ['nullable', 'string'],
            'validation_errors' => ['nullable', 'array'],
            'store_id' => ['required', 'integer'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $storeId = $this->get('store_id');
        $vacReemplazo = $this->input('vacacionReemplazo');

        $status = 'valid';
        $errors = [];
        $id = null;

        if ($this->has('vacacionReemplazo')) {
            if (!empty($vacReemplazo)) {
                $id = Vacacion::where('store_id', $storeId)
                    ->where('vac_id', $vacReemplazo)
                    ->value('id');

                if (!$id) {
                    $errors['vacacionReemplazo'] = ["La vacación de reemplazo {$vacReemplazo} no existe en la tienda."];
                    $status = 'partial';
                }
            }

            $this->merge([
                'vacacionReemplazo_id' => $id,
            ]);
        }

        $originalErrors = $this->input('validation_errors', []);

        $this->merge([
            'validation_status' => $status,
            'validation_errors' => array_merge($originalErrors, $errors) ?: null,
        ]);
    }

    public function attributes(): array
    {
        return [
            'vacacionReemplazo' => 'Vacación de reemplazo',
        ];
    }
}
