<?php

namespace App\Models;

use App\Models\Traits\HasStoreScopedBinding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Articulo extends Model
{
    use HasFactory, HasStoreScopedBinding;

	protected $guarded = ['store_id'];
	protected static $storeLocalKey = 'art_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id',
        'art_id',
        'clave',
        'claveAlterna',
        'descripcion',
        'servicio',
        'localizacion',
        'invMin',
        'invMax',
        'factor',
        'precioCompra',
        'preCompraProm',
        'margen1',
        'margen2',
        'margen3',
        'margen4',
        'precio1',
        'precio2',
        'precio3',
        'precio4',
        'mayoreo1',
        'mayoreo2',
        'mayoreo3',
        'mayoreo4',
        'existencia',
        'aislado',
        'disponible',
        'caracteristicas',
        'iepsActivo',
        'cuotaIeps',
        'cuentaPredial',
        'lote',
        'receta',
        'granel',
        'tipo',
        'peso',
        'insumo',
        'platillo',
        'favorito',
        'requerirPreparacion',
        'presentacion',
        'presentacionPrecio',
        'pesoAut',
        'claveProdServ',
        'status',
        'unidadCompra',
        'unidadCompra_id',
        'unidadVenta',
        'unidadVenta_id',
        'cat_id',
        'categoria_id',
        'srp_id',
        'mem_id',
        'diasVigencia',
        'prp_id',
        'merma',
        'rpl_id',
        'imp_id',
        'tipoLote',
        'nombreAduana',
        'fechaDocAduanero',
        'pedimento',
        'oculto',
        'horarioPromo',
        'existenciaActivo',
        'preCompraPromGas',
        'showEco',
        'etiquetaVenta',
        'validation_status',
        'validation_errors',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'store_id' => 'integer',
        'servicio' => 'boolean',
        'factor' => 'decimal:3',
        'precioCompra' => 'decimal:3',
        'preCompraProm' => 'decimal:3',
        'margen1' => 'decimal:6',
        'margen2' => 'decimal:6',
        'margen3' => 'decimal:6',
        'margen4' => 'decimal:6',
        'precio1' => 'decimal:6',
        'precio2' => 'decimal:6',
        'precio3' => 'decimal:6',
        'precio4' => 'decimal:6',
        'mayoreo1' => 'decimal:3',
        'mayoreo2' => 'decimal:3',
        'mayoreo3' => 'decimal:3',
        'mayoreo4' => 'decimal:3',
        'existencia' => 'decimal:4',
        'aislado' => 'decimal:4',
        'disponible' => 'decimal:4',
        'iepsActivo' => 'boolean',
        'cuotaIeps' => 'decimal:4',
        'lote' => 'boolean',
        'receta' => 'boolean',
        'granel' => 'boolean',
        'peso' => 'decimal:4',
        'insumo' => 'boolean',
        'platillo' => 'boolean',
        'favorito' => 'boolean',
        'requerirPreparacion' => 'boolean',
        'presentacion' => 'boolean',
        'presentacionPrecio' => 'boolean',
        'pesoAut' => 'boolean',
        'unidadCompra_id' => 'integer',
        'unidadVenta_id' => 'integer',
        'categoria_id' => 'integer',
        'merma' => 'decimal:4',
        'fechaDocAduanero' => 'date',
        'existenciaActivo' => 'decimal:4',
        'preCompraPromGas' => 'decimal:3',
        'showEco' => 'boolean',
        'validation_errors' => 'array',
    ];

	public function getRouteKeyName(): string
	{
		return static::$storeLocalKey ?? 'id';
	}

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function unidadCompra(): BelongsTo
    {
        return $this->belongsTo(Unidad::class);
    }

    public function unidadVenta(): BelongsTo
    {
        return $this->belongsTo(Unidad::class);
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

	public function impuestos()
	{
		return $this->belongsToMany(
			Impuesto::class,
			'articuloimpuesto',
			'art_id',      // FK local en esa tabla
			'imp_id'       // FK a Impuesto
		)
		->using(ArticuloImpuesto::class)  // Le indicas tu Pivot personalizado
		->withPivot('store_id');          // si necesitas leer store_id desde la pivot
	}
}
