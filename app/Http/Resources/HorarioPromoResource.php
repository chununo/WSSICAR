<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HorarioPromoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'hor_id' => $this->hor_id,
            'nombre' => $this->nombre,
            'lunes' => $this->lunes,
            'iniLun' => $this->iniLun,
            'finLun' => $this->finLun,
            'martes' => $this->martes,
            'iniMar' => $this->iniMar,
            'finMar' => $this->finMar,
            'miercoles' => $this->miercoles,
            'iniMie' => $this->iniMie,
            'finMie' => $this->finMie,
            'jueves' => $this->jueves,
            'iniJue' => $this->iniJue,
            'finJue' => $this->finJue,
            'viernes' => $this->viernes,
            'iniVie' => $this->iniVie,
            'finVie' => $this->finVie,
            'sabado' => $this->sabado,
            'iniSab' => $this->iniSab,
            'finSab' => $this->finSab,
            'domingo' => $this->domingo,
            'iniDom' => $this->iniDom,
            'finDom' => $this->finDom,
            'status' => $this->status,
        ];
    }
}
