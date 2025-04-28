<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'cat_id' => $this->cat_id,
            'nombre' => $this->nombre,
            'system' => $this->system,
            'status' => $this->status,
            'departamento_id' => $this->departamento_id,
            'dep_id' => $this->dep_id,
            'imagen' => $this->imagen,
            'comision' => $this->comision,
        ];
    }
}
