<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetallepromoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'dpr_id' => $this->dpr_id,
            'pro_id' => $this->pro_id,
            'promocion_id' => $this->promocion_id,
            'art_id' => $this->art_id,
            'articulo_id' => $this->articulo_id,
            'cat_id' => $this->cat_id,
            'categoria_id' => $this->categoria_id,
            'dep_id' => $this->dep_id,
            'departamento_id' => $this->departamento_id,
            'tipo' => $this->tipo,
            'status' => $this->status,
            'validation_status' => $this->validation_status,
            'validation_errors' => $this->validation_errors,
        ];
    }
}
