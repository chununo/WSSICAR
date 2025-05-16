<?php

namespace App\Models;

use App\Models\Traits\HasStoreScopedBinding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Thiagoprz\CompositeKey\HasCompositeKey;

class Paquete extends Model
{
    use HasFactory,HasStoreScopedBinding,HasCompositeKey;
	protected $guarded = ['store_id'];
	public $incrementing = false;
	protected $primaryKey = ['paquete', 'articulo', 'store_id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id',
        'paquete',
        'articulo',
        'paquete_id',
        'articulo_id',
        'cantidad',
        'opcional',
        'incluido',
        'costoExtra',
        'porcion',
        'grupo',
        'maximo',
        'minimo',
        'multiplicador',
        'validation_status',
        'validation_errors',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'store_id' => 'integer',
        'paquete_id' => 'integer',
        'articulo_id' => 'integer',
        'cantidad' => 'decimal:5',
        'opcional' => 'boolean',
        'incluido' => 'boolean',
        'costoExtra' => 'boolean',
        'porcion' => 'decimal:3',
        'validation_errors' => 'array',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function paquete(): BelongsTo
    {
        return $this->belongsTo(Articulo::class);
    }

    public function articulo(): BelongsTo
    {
        return $this->belongsTo(Articulo::class);
    }
}
