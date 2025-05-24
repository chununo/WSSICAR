<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MonedaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'mon_id' => $this->mon_id,
            'moneda' => $this->moneda,
            'abr' => $this->abr,
            'tipoCambio' => $this->tipoCambio,
            'singPlur' => $this->singPlur,
            'caracter' => $this->caracter,
            'mn' => $this->mn,
            'img16' => $this->img16,
            'img24' => $this->img24,
            'img32' => $this->img32,
            'status' => $this->status,
        ];
    }
}
