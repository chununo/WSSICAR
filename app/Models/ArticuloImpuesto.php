<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticuloImpuesto extends Pivot
{
    // Nombre exacto de la tabla en BD:
    protected $table = 'articuloimpuesto';

    // Si no tienes PK autoincremental:
    public $incrementing = false;

    // No hay timestamps en la pivot:
    public $timestamps = false;

    // Columnas que sí quieres poblar/leer
    protected $fillable = [
        'store_id',
        'art_id',
        'imp_id',
		'articulo_id',
        'impuesto_id',
        'validation_status',
        'validation_errors',
    ];

	protected $casts = [
        'validation_errors' => 'array',
    ];

	public function articulo(): BelongsTo
    {
        return $this->belongsTo(Articulo::class);
    }

    public function impuesto(): BelongsTo
    {
        return $this->belongsTo(Impuesto::class);
    }
}
