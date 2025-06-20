<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TurnoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'tur_id' => $this->tur_id,
            'nombre' => $this->nombre,
            'nocturno' => $this->nocturno,
            'semana' => $this->semana,
            'horaEnt' => $this->horaEnt,
            'horaSal' => $this->horaSal,
            'lunes' => $this->lunes,
            'entLun' => $this->entLun,
            'salLun' => $this->salLun,
            'martes' => $this->martes,
            'entMar' => $this->entMar,
            'salMar' => $this->salMar,
            'miercoles' => $this->miercoles,
            'entMie' => $this->entMie,
            'salMie' => $this->salMie,
            'jueves' => $this->jueves,
            'entJue' => $this->entJue,
            'salJue' => $this->salJue,
            'viernes' => $this->viernes,
            'entVie' => $this->entVie,
            'salVie' => $this->salVie,
            'sabado' => $this->sabado,
            'entSab' => $this->entSab,
            'salSab' => $this->salSab,
            'domingo' => $this->domingo,
            'entDom' => $this->entDom,
            'salDom' => $this->salDom,
            'tipo' => $this->tipo,
            'status' => $this->status,
        ];
    }
}
