<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Thiagoprz\CompositeKey\HasCompositeKey;
use App\Models\Traits\HasStoreScopedBinding;

class GrupoArticulo extends Model
{
    use HasFactory, HasStoreScopedBinding, HasCompositeKey;

    protected $table = 'grupoarticulos';

    protected $primaryKey = ['store_id', 'gar_id', 'art_id'];
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'store_id',
        'gar_id',
        'art_id',
        'grupo_id',
        'articulo_id',
        'costoExtra',
        'status',
        'cantidad',
        'imprimir',
        'alias',
        'validation_status',
        'validation_errors',
    ];

    protected $casts = [
        'store_id' => 'integer',
        'gar_id' => 'integer',
        'art_id' => 'integer',
        'grupo_id' => 'integer',
        'articulo_id' => 'integer',
        'costoExtra' => 'decimal:2',
        'status' => 'integer',
        'cantidad' => 'decimal:3',
        'imprimir' => 'boolean',
        'validation_errors' => 'array',
    ];

    public function grupo(): BelongsTo
    {
        return $this->belongsTo(Grupo::class);
    }

    public function articulo(): BelongsTo
    {
        return $this->belongsTo(Articulo::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
