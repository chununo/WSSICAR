<?php

namespace App\Models;

use App\Models\Traits\HasStoreScopedBinding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Promocion extends Model
{
    use HasFactory, HasStoreScopedBinding;

    protected static $storeLocalKey = 'pro_id';
	protected $table = 'promociones';

    protected $fillable = [
        'store_id',
        'pro_id',
        'nombre',
        'fechaIni',
        'fechaFin',
        'descuento',
        'pago',
        'salida',
        'precio',
        'condicion',
        'totalMin',
        'piezasMin',
        'piezasReq',
        'piezasPromo',
        'cascada',
        'status',
        'sincronizar',
        'mixto',
        'mostrarComensal',
        'artReq',
        'artReqMixto',
        'clientes',
        'hor_id',
        'horariopromo_id',
        'validation_status',
        'validation_errors',
    ];

    protected $casts = [
        'id' => 'integer',
        'store_id' => 'integer',
        'pro_id' => 'integer',
        'fechaIni' => 'date',
        'fechaFin' => 'date',
        'descuento' => 'decimal:2',
        'pago' => 'integer',
        'salida' => 'integer',
        'precio' => 'integer',
        'condicion' => 'boolean',
        'totalMin' => 'decimal:2',
        'piezasMin' => 'integer',
        'piezasReq' => 'integer',
        'piezasPromo' => 'integer',
        'cascada' => 'boolean',
        'status' => 'integer',
        'sincronizar' => 'boolean',
        'mixto' => 'boolean',
        'mostrarComensal' => 'boolean',
        'artReq' => 'boolean',
        'artReqMixto' => 'boolean',
        'clientes' => 'boolean',
        'hor_id' => 'integer',
        'horariopromo_id' => 'integer',
        'validation_errors' => 'array',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function horariopromo(): BelongsTo
    {
        return $this->belongsTo(Horariopromo::class, 'horariopromo_id');
    }
}
