<?php

namespace App\Models;

use App\Models\Traits\HasStoreScopedBinding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Impuesto extends Model
{
    use HasFactory,	HasStoreScopedBinding;

	protected static $storeLocalKey = 'imp_id';

	public function getRouteKeyName()
    {
        return 'imp_id';               // que busque por imp_id
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id',
        'imp_id',
        'nombre',
        'impuesto',
        'impreso',
        'tras',
        'local',
        'aplicarIVA',
        'orden',
        'status',
        'tipoFactor',
        'cco_id',
        'compraPagada',
        'compraCredito',
        'gastoPagado',
        'gastoCredito',
        'anticipoCliente',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'store_id' => 'integer',
        'imp_id' => 'integer',
        'impuesto' => 'decimal:6',
        'impreso' => 'boolean',
        'tras' => 'boolean',
        'local' => 'boolean',
        'aplicarIVA' => 'boolean',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
