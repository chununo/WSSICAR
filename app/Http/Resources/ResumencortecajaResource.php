<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResumencortecajaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'rcc_id' => $this->rcc_id,
            'cor_id' => $this->cor_id,
            'cortecaja_id' => $this->cortecaja_id,
            'venCon' => $this->venCon,
            'venCre' => $this->venCre,
            'venConC' => $this->venConC,
            'venCreC' => $this->venCreC,
            'comCon' => $this->comCon,
            'comCre' => $this->comCre,
            'comConC' => $this->comConC,
            'comCreC' => $this->comCreC,
            'notCre' => $this->notCre,
            'notCreC' => $this->notCreC,
            'entVen' => $this->entVen,
            'entCre' => $this->entCre,
            'entComC' => $this->entComC,
            'entNotC' => $this->entNotC,
            'entMov' => $this->entMov,
            'salCom' => $this->salCom,
            'salCre' => $this->salCre,
            'salVenC' => $this->salVenC,
            'salNot' => $this->salNot,
            'salMov' => $this->salMov,
            'gasCon' => $this->gasCon,
            'gasCre' => $this->gasCre,
            'gasConC' => $this->gasConC,
            'gasCreC' => $this->gasCreC,
            'notCrePro' => $this->notCrePro,
            'notCreProC' => $this->notCreProC,
            'entGasC' => $this->entGasC,
            'salNotProC' => $this->salNotProC,
            'salGas' => $this->salGas,
            'entNotPro' => $this->entNotPro,
            'validation_status' => $this->validation_status,
            'validation_errors' => $this->validation_errors,
        ];
    }
}
