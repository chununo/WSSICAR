<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegimenfiscalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'rgf_id' => $this->rgf_id,
            'clave' => $this->clave,
            'descripcion' => $this->descripcion,
            'fisica' => $this->fisica,
            'moral' => $this->moral,
        ];
    }
}
