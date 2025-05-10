<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloUpdateRequest extends FormRequest
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
            'clave' => ['sometimes', 'string', 'max:45'],
            'claveAlterna' => ['sometimes', 'string', 'max:45'],
            'descripcion' => ['sometimes', 'string', 'max:1000'],
            'servicio' => ['sometimes'],
            'localizacion' => ['sometimes', 'string', 'max:10'],
            'invMin' => ['sometimes', 'integer'],
            'invMax' => ['sometimes', 'integer'],
            'factor' => ['sometimes', 'numeric', 'between:-99999999999999999.999,99999999999999999.999'],
            'precioCompra' => ['sometimes', 'numeric', 'between:-99999999999999999.999,99999999999999999.999'],
            'preCompraProm' => ['sometimes', 'numeric', 'between:-99999999999999999.999,99999999999999999.999'],
            'margen1' => ['sometimes', 'numeric', 'between:-99999999999999.999999,99999999999999.999999'],
            'margen2' => ['sometimes', 'numeric', 'between:-99999999999999.999999,99999999999999.999999'],
            'margen3' => ['sometimes', 'numeric', 'between:-99999999999999.999999,99999999999999.999999'],
            'margen4' => ['sometimes', 'numeric', 'between:-99999999999999.999999,99999999999999.999999'],
            'precio1' => ['sometimes', 'numeric', 'between:-99999999999999.999999,99999999999999.999999'],
            'precio2' => ['sometimes', 'numeric', 'between:-99999999999999.999999,99999999999999.999999'],
            'precio3' => ['sometimes', 'numeric', 'between:-99999999999999.999999,99999999999999.999999'],
            'precio4' => ['sometimes', 'numeric', 'between:-99999999999999.999999,99999999999999.999999'],
            'mayoreo1' => ['sometimes', 'numeric', 'between:-99999999999999999.999,99999999999999999.999'],
            'mayoreo2' => ['sometimes', 'numeric', 'between:-99999999999999999.999,99999999999999999.999'],
            'mayoreo3' => ['sometimes', 'numeric', 'between:-99999999999999999.999,99999999999999999.999'],
            'mayoreo4' => ['sometimes', 'numeric', 'between:-99999999999999999.999,99999999999999999.999'],
            'existencia' => ['sometimes', 'numeric', 'between:-9999999999999999.9999,9999999999999999.9999'],
            'aislado' => ['sometimes', 'numeric', 'between:-9999999999999999.9999,9999999999999999.9999'],
            'disponible' => ['sometimes', 'numeric', 'between:-9999999999999999.9999,9999999999999999.9999'],
            'caracteristicas' => ['sometimes', 'string'],
            'iepsActivo' => ['sometimes'],
            'cuotaIeps' => ['sometimes', 'numeric', 'between:-9999999999999999.9999,9999999999999999.9999'],
            'cuentaPredial' => ['sometimes', 'string', 'max:45'],
            'lote' => ['sometimes'],
            'receta' => ['sometimes'],
            'granel' => ['sometimes'],
            'tipo' => ['sometimes', 'integer'],
            'peso' => ['sometimes', 'numeric', 'between:-9999999999999999.9999,9999999999999999.9999'],
            'insumo' => ['sometimes'],
            'platillo' => ['sometimes'],
            'favorito' => ['sometimes'],
            'requerirPreparacion' => ['sometimes'],
            'presentacion' => ['sometimes'],
            'presentacionPrecio' => ['sometimes'],
            'pesoAut' => ['sometimes'],
            'claveProdServ' => ['nullable', 'string', 'max:15'],
            'status' => ['sometimes', 'integer'],
            'unidadCompra' => ['sometimes', 'integer'],
            'unidadVenta' => ['sometimes', 'integer'],
            'cat_id' => ['sometimes', 'integer'],
            'srp_id' => ['sometimes','nullable', 'integer'],
            'mem_id' => ['sometimes','nullable', 'integer'],
            'diasVigencia' => ['sometimes','nullable', 'integer'],
            'prp_id' => ['sometimes','nullable', 'integer'],
            'merma' => ['sometimes','nullable', 'numeric', 'between:-9999999999999999.9999,9999999999999999.9999'],
            'rpl_id' => ['sometimes','nullable', 'integer'],
            'imp_id' => ['sometimes','nullable', 'integer'],
            'tipoLote' => ['sometimes','nullable', 'integer'],
            'nombreAduana' => ['sometimes','nullable', 'string', 'max:512'],
            'fechaDocAduanero' => ['sometimes','nullable', 'date'],
            'pedimento' => ['sometimes','nullable', 'string', 'max:128'],
            'oculto' => ['sometimes','nullable', 'integer'],
            'horarioPromo' => ['sometimes','nullable', 'integer'],
            'existenciaActivo' => ['sometimes','nullable', 'numeric', 'between:-9999999999999999.9999,9999999999999999.9999'],
            'preCompraPromGas' => ['sometimes','nullable', 'numeric', 'between:-99999999999999999.999,99999999999999999.999'],
            'showEco' => ['sometimes'],
            'etiquetaVenta' => ['sometimes', 'integer'],
        ];
    }

	/**
	 * Convierte "0"/"1" a boolean antes de validar,
	 * si tu frontend manda strings.
	 */
	protected function prepareForValidation(): void
	{
		$this->merge([
			'servicio' => filter_var($this->servicio, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
			'lote' => filter_var($this->lote, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
			'receta' => filter_var($this->receta, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
			'granel' => filter_var($this->granel, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
			'insumo' => filter_var($this->insumo, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
			'platillo' => filter_var($this->platillo, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
			'favorito' => filter_var($this->favorito, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
			'requerirPreparacion' => filter_var($this->requerirPreparacion, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
			'showEco' => filter_var($this->showEco, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
		]);
		
	}
	public function messages(): array
	{
		return [
			'clave.required' => 'El campo clave es obligatorio.',
			'clave.string' => 'El campo clave debe ser una cadena de texto.',
			'clave.max' => 'El campo clave no puede tener más de 45 caracteres.',
			'claveAlterna.string' => 'El campo claveAlterna debe ser una cadena de texto.',
			'claveAlterna.max' => 'El campo claveAlterna no puede tener más de 45 caracteres.',
			'descripcion.string' => 'El campo descripcion debe ser una cadena de texto.',
			'descripcion.max' => 'El campo descripcion no puede tener más de 1000 caracteres.',
			'invMin.integer' => 'El campo invMin debe ser un número entero.',
			'invMax.integer' => 'El campo invMax debe ser un número entero.',
			'factor.numeric' => 'El campo factor debe ser un número.',
			'factor.between' => 'El campo factor debe estar entre -99999999999999999.999 y 99999999999999999.999',
			'precioCompra.numeric' => 'El campo precioCompra debe ser un número.',
			'precioCompra.between' => 'El campo precioCompra debe estar entre -99999999999999999.999 y 99999999999999999.999',
			'preCompraProm.numeric' => 'El campo preCompraProm debe ser un número.',	
		];
	}
	public function attributes(): array
	{
		return [
			'clave' => 'Clave',
			'claveAlterna' => 'Clave Alterna',
			'descripcion' => 'Descripción',
			'invMin' => 'Inventario Mínimo',
			'invMax' => 'Inventario Máximo',
			'factor' => 'Factor',
			'precioCompra' => 'Precio de Compra',
			'preCompraProm' => 'Precio de Compra Promocional',
			'margen1' => 'Margen 1',
			'margen2' => 'Margen 2',
			'margen3' => 'Margen 3',
			'margen4' => 'Margen 4',
			'precio1' => 'Precio 1',
			'precio2' => 'Precio 2',
			'precio3' => 'Precio 3',
			'precio4' => 'Precio 4',
			'mayoreo1' => 'Mayoreo 1',
			'mayoreo2' => 'Mayoreo 2',
			'mayoreo3' => 'Mayoreo 3',
			'mayoreo4' => 'Mayoreo 4',
			'existencia' => 'Existencia',
			'aislado' => 'Aislado',
			'disponible' => 'Disponible',
			'caracteristicas' => 'Características',
			'iepsActivo' => 'IEPS Activo',
			'cuotaIeps' => 'Cuota IEPS',
			'cuentaPredial' => 'Cuenta Predial',
			'lote' => 'Lote',
			'receta' => 'Receta',
			'granel' => 'Granel',
			'tipo' => 'Tipo',
			'peso' => 'Peso',
			'insumo' => 'Insumo',
			'platillo' => 'Platillo',
			'favorable' => 'Favorito',
			'requerirPreparacion' => 'Requerir Preparación',
			'presentacion' => 'Presentación',
			'presentacionPrecio' => 'Precio de Presentación',
			'pesoAut' => 'Peso Autorizado',
			'claveProdServ' => 'Clave Producto/Servicio',
			'status' => 'Estado',
			'unidadCompra' => 'Unidad de Compra',
			'unidadCompra_id' => 'Unidad de Compra ID',
			'unidadVenta' => 'Unidad de Venta',
			'unidadVenta_id' => 'Unidad de Venta ID',
			'cat_id' => 'Categoría ID',
			'srp_id' => 'SRP ID',
			'mem_id' => 'MEM ID',
			'diasVigencia' => 'Días de Vigencia',
			'prp_id' => 'PRP ID',
			'merma' => 'Merma',
			'rpl_id' => 'RPL ID',
			'imp_id' => 'IMP ID',
			'tipoLote' => 'Tipo de Lote',
			'nombreAduana' => 'Nombre de Aduana',
			'fechaDocAduanero' => 'Fecha de Documento Aduanero',
			'pedimento' => 'Pedimento',
			'oculto' => 'Oculto',
			'horarioPromo' => 'Horario Promocional',
			'existenciaActivo' => 'Existencia Activo',
			'preCompraPromGas' => 'Precio de Compra Promocional Gas',
			'showEco' => 'Mostrar Eco',
		];
	}
}
