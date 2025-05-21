<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GrupoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'gar_id' => $this->gar_id,
            'nombre' => $this->nombre,
            'status' => $this->status,
            'padre' => $this->padre
        ];
    }
}
