<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartamentoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'dep_id' => $this->dep_id,
            'nombre' => $this->nombre,
            'restringido' => $this->restringido,
            'porcentaje' => $this->porcentaje,
            'system' => $this->system,
            'status' => $this->status,
            'imagen' => $this->imagen,
            'comision' => $this->comision,
        ];
    }
}
