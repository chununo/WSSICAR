<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComboResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'store_id' => $this->store_id,
            'combo' => $this->combo,
            'grupo' => $this->grupo,
            'combo_id' => $this->combo_id,
            'grupo_id' => $this->grupo_id,
            'cantidad' => $this->cantidad,
            'opcional' => $this->opcional,
            'orden' => $this->orden,
            'incluido' => $this->incluido,
            'status' => $this->status,
            'validation_status' => $this->validation_status,
            'validation_errors' => $this->validation_errors,
        ];
    }
}
