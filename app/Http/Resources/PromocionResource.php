<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PromocionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'pro_id' => $this->pro_id,
            'nombre' => $this->nombre,
            'fechaIni' => $this->fechaIni,
            'fechaFin' => $this->fechaFin,
            'descuento' => $this->descuento,
            'pago' => $this->pago,
            'salida' => $this->salida,
            'precio' => $this->precio,
            'condicion' => $this->condicion,
            'totalMin' => $this->totalMin,
            'piezasMin' => $this->piezasMin,
            'piezasReq' => $this->piezasReq,
            'piezasPromo' => $this->piezasPromo,
            'cascada' => $this->cascada,
            'status' => $this->status,
            'sincronizar' => $this->sincronizar,
            'mixto' => $this->mixto,
            'mostrarComensal' => $this->mostrarComensal,
            'artReq' => $this->artReq,
            'artReqMixto' => $this->artReqMixto,
            'clientes' => $this->clientes,
            'hor_id' => $this->hor_id,
            'horariopromo_id' => $this->horariopromo_id,
            'validation_status' => $this->validation_status,
            'validation_errors' => $this->validation_errors,
        ];
    }
}
