<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VacacionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'vac_id' => $this->vac_id,
            'nombre' => $this->nombre,
            'minimo' => $this->minimo,
            'a1' => $this->a1,
            'a2' => $this->a2,
            'a3' => $this->a3,
            'a4' => $this->a4,
            'a5' => $this->a5,
            'a6' => $this->a6,
            'a7' => $this->a7,
            'a8' => $this->a8,
            'a9' => $this->a9,
            'a10' => $this->a10,
            'a11' => $this->a11,
            'a12' => $this->a12,
            'a13' => $this->a13,
            'a14' => $this->a14,
            'a15' => $this->a15,
            'a16' => $this->a16,
            'a17' => $this->a17,
            'a18' => $this->a18,
            'a19' => $this->a19,
            'a20' => $this->a20,
            'a21' => $this->a21,
            'a22' => $this->a22,
            'a23' => $this->a23,
            'a24' => $this->a24,
            'a25' => $this->a25,
            'a26' => $this->a26,
            'a27' => $this->a27,
            'a28' => $this->a28,
            'a29' => $this->a29,
            'a30' => $this->a30,
            'a31' => $this->a31,
            'a32' => $this->a32,
            'a33' => $this->a33,
            'a34' => $this->a34,
            'a35' => $this->a35,
            'a36' => $this->a36,
            'a37' => $this->a37,
            'a38' => $this->a38,
            'a39' => $this->a39,
            'a40' => $this->a40,
            'fechaVigorReemplazo' => $this->fechaVigorReemplazo,
            'vacacionReemplazo' => $this->vacacionReemplazo,
            'vacacionreemplazo_id' => $this->vacacionreemplazo_id,
            'validation_status' => $this->validation_status,
            'validation_errors' => $this->validation_errors,
        ];
    }
}
