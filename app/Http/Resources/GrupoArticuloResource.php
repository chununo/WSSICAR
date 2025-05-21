<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GrupoArticuloResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'store_id' => $this->store_id,
            'gar_id' => $this->gar_id,
            'art_id' => $this->art_id,
            'grupo_id' => $this->grupo_id,
            'articulo_id' => $this->articulo_id,
            'costoExtra' => $this->costoExtra,
            'status' => $this->status,
            'cantidad' => $this->cantidad,
            'imprimir' => $this->imprimir,
            'alias' => $this->alias,
            'validation_status' => $this->validation_status,
            'validation_errors' => $this->validation_errors,
        ];
    }
}
