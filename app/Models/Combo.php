<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Traits\HasStoreScopedBinding;
use Thiagoprz\CompositeKey\HasCompositeKey;

class Combo extends Model
{
    use HasFactory, HasStoreScopedBinding, HasCompositeKey;
	public $incrementing = false;
	protected $primaryKey = ['store_id', 'combo', 'grupo'];
	protected static $storeLocalKey = 'combo';
	protected $guarded = ['store_id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id',
        'combo',
        'grupo',
        'combo_id',
        'grupo_id',
        'cantidad',
        'opcional',
        'orden',
        'incluido',
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
        'combo_id' => 'integer',
        'grupo_id' => 'integer',
        'opcional' => 'boolean',
        'incluido' => 'boolean',
        'validation_errors' => 'array',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function combo(): BelongsTo
    {
        return $this->belongsTo(Articulo::class);
    }

    public function grupo(): BelongsTo
    {
        return $this->belongsTo(Grupo::class);
    }
}
