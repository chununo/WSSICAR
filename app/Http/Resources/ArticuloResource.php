<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticuloResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'store_id' => $this->store_id,
            'art_id' => $this->art_id,
            'clave' => $this->clave,
            'claveAlterna' => $this->claveAlterna,
            'descripcion' => $this->descripcion,
            'servicio' => $this->servicio,
            'localizacion' => $this->localizacion,
            'invMin' => $this->invMin,
            'invMax' => $this->invMax,
            'factor' => $this->factor,
            'precioCompra' => $this->precioCompra,
            'preCompraProm' => $this->preCompraProm,
            'margen1' => $this->margen1,
            'margen2' => $this->margen2,
            'margen3' => $this->margen3,
            'margen4' => $this->margen4,
            'precio1' => $this->precio1,
            'precio2' => $this->precio2,
            'precio3' => $this->precio3,
            'precio4' => $this->precio4,
            'mayoreo1' => $this->mayoreo1,
            'mayoreo2' => $this->mayoreo2,
            'mayoreo3' => $this->mayoreo3,
            'mayoreo4' => $this->mayoreo4,
            'existencia' => $this->existencia,
            'aislado' => $this->aislado,
            'disponible' => $this->disponible,
            'caracteristicas' => $this->caracteristicas,
            'iepsActivo' => $this->iepsActivo,
            'cuotaIeps' => $this->cuotaIeps,
            'cuentaPredial' => $this->cuentaPredial,
            'lote' => $this->lote,
            'receta' => $this->receta,
            'granel' => $this->granel,
            'tipo' => $this->tipo,
            'peso' => $this->peso,
            'insumo' => $this->insumo,
            'platillo' => $this->platillo,
            'favorito' => $this->favorito,
            'requerirPreparacion' => $this->requerirPreparacion,
            'presentacion' => $this->presentacion,
            'presentacionPrecio' => $this->presentacionPrecio,
            'pesoAut' => $this->pesoAut,
            'claveProdServ' => $this->claveProdServ,
            'status' => $this->status,
            'unidadCompra' => $this->unidadCompra,
            'unidadCompra_id' => $this->unidadCompra_id,
            'unidadVenta' => $this->unidadVenta,
            'unidadVenta_id' => $this->unidadVenta_id,
            'cat_id' => $this->cat_id,
            'categoria_id' => $this->categoria_id,
            'srp_id' => $this->srp_id,
            'mem_id' => $this->mem_id,
            'diasVigencia' => $this->diasVigencia,
            'prp_id' => $this->prp_id,
            'merma' => $this->merma,
            'rpl_id' => $this->rpl_id,
            'imp_id' => $this->imp_id,
            'tipoLote' => $this->tipoLote,
            'nombreAduana' => $this->nombreAduana,
            'fechaDocAduanero' => $this->fechaDocAduanero,
            'pedimento' => $this->pedimento,
            'oculto' => $this->oculto,
            'horarioPromo' => $this->horarioPromo,
            'existenciaActivo' => $this->existenciaActivo,
            'preCompraPromGas' => $this->preCompraPromGas,
            'showEco' => $this->showEco,
            'etiquetaVenta' => $this->etiquetaVenta,
            'validation_status' => $this->validation_status,
            'validation_errors' => $this->validation_errors,
        ];
    }
}
