<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CortecajaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'cor_id' => $this->cor_id,
            'fecha' => $this->fecha,
            'contado' => $this->contado,
            'calculado' => $this->calculado,
            'diferencia' => $this->diferencia,
            'retiro' => $this->retiro,
            'caj_id' => $this->caj_id,
            'caja_id' => $this->caja_id,
            'validation_status' => $this->validation_status,
            'validation_errors' => $this->validation_errors,
        ];
    }
}
