<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'store_id' => ['required', 'integer', 'exists:stores,id'],
            'art_id' => ['required', 'integer'],
            'clave' => ['required', 'string', 'max:45'],
            'claveAlterna' => ['required', 'string', 'max:45'],
            'descripcion' => ['required', 'string', 'max:1000'],
            'servicio' => ['required'],
            'localizacion' => ['required', 'string', 'max:10'],
            'invMin' => ['required', 'integer'],
            'invMax' => ['required', 'integer'],
            'factor' => ['required', 'numeric', 'between:-99999999999999999.999,99999999999999999.999'],
            'precioCompra' => ['required', 'numeric', 'between:-99999999999999999.999,99999999999999999.999'],
            'preCompraProm' => ['required', 'numeric', 'between:-99999999999999999.999,99999999999999999.999'],
            'margen1' => ['required', 'numeric', 'between:-99999999999999.999999,99999999999999.999999'],
            'margen2' => ['required', 'numeric', 'between:-99999999999999.999999,99999999999999.999999'],
            'margen3' => ['required', 'numeric', 'between:-99999999999999.999999,99999999999999.999999'],
            'margen4' => ['required', 'numeric', 'between:-99999999999999.999999,99999999999999.999999'],
            'precio1' => ['required', 'numeric', 'between:-99999999999999.999999,99999999999999.999999'],
            'precio2' => ['required', 'numeric', 'between:-99999999999999.999999,99999999999999.999999'],
            'precio3' => ['required', 'numeric', 'between:-99999999999999.999999,99999999999999.999999'],
            'precio4' => ['required', 'numeric', 'between:-99999999999999.999999,99999999999999.999999'],
            'mayoreo1' => ['required', 'numeric', 'between:-99999999999999999.999,99999999999999999.999'],
            'mayoreo2' => ['required', 'numeric', 'between:-99999999999999999.999,99999999999999999.999'],
            'mayoreo3' => ['required', 'numeric', 'between:-99999999999999999.999,99999999999999999.999'],
            'mayoreo4' => ['required', 'numeric', 'between:-99999999999999999.999,99999999999999999.999'],
            'existencia' => ['required', 'numeric', 'between:-9999999999999999.9999,9999999999999999.9999'],
            'aislado' => ['required', 'numeric', 'between:-9999999999999999.9999,9999999999999999.9999'],
            'disponible' => ['required', 'numeric', 'between:-9999999999999999.9999,9999999999999999.9999'],
            'caracteristicas' => ['required', 'string'],
            'iepsActivo' => ['required'],
            'cuotaIeps' => ['required', 'numeric', 'between:-9999999999999999.9999,9999999999999999.9999'],
            'cuentaPredial' => ['required', 'string', 'max:45'],
            'lote' => ['required'],
            'receta' => ['required'],
            'granel' => ['required'],
            'tipo' => ['required', 'integer'],
            'peso' => ['required', 'numeric', 'between:-9999999999999999.9999,9999999999999999.9999'],
            'insumo' => ['required'],
            'platillo' => ['required'],
            'favorito' => ['required'],
            'requerirPreparacion' => ['required'],
            'presentacion' => ['required'],
            'presentacionPrecio' => ['required'],
            'pesoAut' => ['required'],
            'claveProdServ' => ['nullable', 'string', 'max:15'],
            'status' => ['required', 'integer'],
            'unidadCompra' => ['required', 'integer'],
            'unidadCompra_id' => ['nullable', 'integer', 'exists:unidades,id'],
            'unidadVenta' => ['required', 'integer'],
            'unidadVenta_id' => ['nullable', 'integer', 'exists:unidades,id'],
            'cat_id' => ['required', 'integer'],
            'categoria_id' => ['nullable', 'integer', 'exists:categorias,id'],
            'srp_id' => ['nullable', 'integer'],
            'mem_id' => ['nullable', 'integer'],
            'diasVigencia' => ['nullable', 'integer'],
            'prp_id' => ['nullable', 'integer'],
            'merma' => ['nullable', 'numeric', 'between:-9999999999999999.9999,9999999999999999.9999'],
            'rpl_id' => ['nullable', 'integer'],
            'imp_id' => ['nullable', 'integer'],
            'tipoLote' => ['nullable', 'integer'],
            'nombreAduana' => ['nullable', 'string', 'max:512'],
            'fechaDocAduanero' => ['nullable', 'date'],
            'pedimento' => ['nullable', 'string', 'max:128'],
            'oculto' => ['nullable', 'integer'],
            'horarioPromo' => ['nullable', 'integer'],
            'existenciaActivo' => ['nullable', 'numeric', 'between:-9999999999999999.9999,9999999999999999.9999'],
            'preCompraPromGas' => ['nullable', 'numeric', 'between:-99999999999999999.999,99999999999999999.999'],
            'showEco' => ['required'],
            'etiquetaVenta' => ['required', 'integer']
        ];
    }
}
