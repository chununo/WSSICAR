<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'cli_id' => $this->cli_id,
            'nombre' => $this->nombre,
            'representante' => $this->representante,
            'domicilio' => $this->domicilio,
            'noExt' => $this->noExt,
            'noInt' => $this->noInt,
            'localidad' => $this->localidad,
            'ciudad' => $this->ciudad,
            'estado' => $this->estado,
            'pais' => $this->pais,
            'codigoPostal' => $this->codigoPostal,
            'colonia' => $this->colonia,
            'rfc' => $this->rfc,
            'curp' => $this->curp,
            'telefono' => $this->telefono,
            'celular' => $this->celular,
            'mail' => $this->mail,
            'comentario' => $this->comentario,
            'status' => $this->status,
            'limite' => $this->limite,
            'precio' => $this->precio,
            'diasCredito' => $this->diasCredito,
            'retener' => $this->retener,
            'desglosarIEPS' => $this->desglosarIEPS,
            'notificar' => $this->notificar,
            'clave' => $this->clave,
            'foto' => $this->foto,
            'huella' => $this->huella,
            'muestra' => $this->muestra,
            'usoCfdi' => $this->usoCfdi,
            'idCIF' => $this->idCIF,
            'sid' => $this->sid,
            'eduNivel' => $this->eduNivel,
            'eduClave' => $this->eduClave,
            'eduRfc' => $this->eduRfc,
            'eduNombre' => $this->eduNombre,
            'grc_id' => $this->grc_id,
            'grupocliente_id' => $this->grupocliente_id,
            'rgf_id' => $this->rgf_id,
            'regimenfiscal_id' => $this->regimenfiscal_id,
            'validation_status' => $this->validation_status,
            'validation_errors' => $this->validation_errors,
        ];
    }
}
