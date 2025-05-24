<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CajaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'caj_id' => $this->caj_id,
            'nombre' => $this->nombre,
            'total' => $this->total,
            'status' => $this->status,
        ];
    }
}
