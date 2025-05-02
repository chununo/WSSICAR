<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UnidadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'uni_id' => $this->uni_id,
            'nombre' => $this->nombre,
            'status' => $this->status,
            'clave' => $this->clave,
        ];
    }
}
