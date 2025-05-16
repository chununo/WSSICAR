<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaqueteResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'store_id' => $this->store_id,
            'paquete' => $this->paquete,
            'articulo' => $this->articulo,
            'paquete_id' => $this->paquete_id,
            'articulo_id' => $this->articulo_id,
            'cantidad' => $this->cantidad,
            'opcional' => $this->opcional,
            'incluido' => $this->incluido,
            'costoExtra' => $this->costoExtra,
            'porcion' => $this->porcion,
            'grupo' => $this->grupo,
            'maximo' => $this->maximo,
            'minimo' => $this->minimo,
            'multiplicador' => $this->multiplicador,
            'validation_status' => $this->validation_status,
            'validation_errors' => $this->validation_errors,
        ];
    }


}
