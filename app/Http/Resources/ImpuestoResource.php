<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImpuestoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'imp_id' => $this->imp_id,
            'nombre' => $this->nombre,
            'impuesto' => $this->impuesto,
            'impreso' => $this->impreso,
            'tras' => $this->tras,
            'local' => $this->local,
            'aplicarIVA' => $this->aplicarIVA,
            'orden' => $this->orden,
            'status' => $this->status,
            'tipoFactor' => $this->tipoFactor,
            'cco_id' => $this->cco_id,
            'compraPagada' => $this->compraPagada,
            'compraCredito' => $this->compraCredito,
            'gastoPagado' => $this->gastoPagado,
            'gastoCredito' => $this->gastoCredito,
            'anticipoCliente' => $this->anticipoCliente,
        ];
    }
}
