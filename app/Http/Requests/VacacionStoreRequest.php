<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Vacacion;

class VacacionStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'vac_id' => [
                'required',
                'integer',
                Rule::unique('vacaciones')->where(
                    fn ($q) => $q->where('store_id', $this->get('store_id'))
                ),
            ],
            'nombre' => ['required', 'string', 'max:255'],
            'minimo' => ['required', 'integer'],
            'a1' => ['required', 'integer'], 'a2' => ['required', 'integer'], 'a3' => ['required', 'integer'],
            'a4' => ['required', 'integer'], 'a5' => ['required', 'integer'], 'a6' => ['required', 'integer'],
            'a7' => ['required', 'integer'], 'a8' => ['required', 'integer'], 'a9' => ['required', 'integer'],
            'a10' => ['required', 'integer'], 'a11' => ['required', 'integer'], 'a12' => ['required', 'integer'],
            'a13' => ['required', 'integer'], 'a14' => ['required', 'integer'], 'a15' => ['required', 'integer'],
            'a16' => ['required', 'integer'], 'a17' => ['required', 'integer'], 'a18' => ['required', 'integer'],
            'a19' => ['required', 'integer'], 'a20' => ['required', 'integer'], 'a21' => ['required', 'integer'],
            'a22' => ['required', 'integer'], 'a23' => ['required', 'integer'], 'a24' => ['required', 'integer'],
            'a25' => ['required', 'integer'], 'a26' => ['required', 'integer'], 'a27' => ['required', 'integer'],
            'a28' => ['required', 'integer'], 'a29' => ['required', 'integer'], 'a30' => ['required', 'integer'],
            'a31' => ['required', 'integer'], 'a32' => ['required', 'integer'], 'a33' => ['required', 'integer'],
            'a34' => ['required', 'integer'], 'a35' => ['required', 'integer'], 'a36' => ['required', 'integer'],
            'a37' => ['required', 'integer'], 'a38' => ['required', 'integer'], 'a39' => ['required', 'integer'],
            'a40' => ['required', 'integer'],
            'fechaVigorReemplazo' => ['nullable', 'date'],
            'vacacionReemplazo' => ['nullable', 'integer'],
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
