<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GrupoclienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'grc_id' => $this->grc_id,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'precioObligatorio' => $this->precioObligatorio,
            'status' => $this->status,
        ];
    }
}
