<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Traits\HasStoreScopedBinding;

class Detallepromo extends Model
{
    use HasFactory, HasStoreScopedBinding;
	protected static $storeLocalKey = 'dpr_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id',
        'dpr_id',
        'pro_id',
        'promocion_id',
        'art_id',
        'articulo_id',
        'cat_id',
        'categoria_id',
        'dep_id',
        'departamento_id',
        'tipo',
        'status',
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
        'promocion_id' => 'integer',
        'articulo_id' => 'integer',
        'categoria_id' => 'integer',
        'departamento_id' => 'integer',
        'validation_errors' => 'array',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function promocion(): BelongsTo
    {
        return $this->belongsTo(Promocion::class);
    }

    public function articulo(): BelongsTo
    {
        return $this->belongsTo(Articulo::class);
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }
}
