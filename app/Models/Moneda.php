<?php

namespace App\Models;

use App\Models\Traits\HasStoreScopedBinding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Moneda extends Model
{
    use HasFactory, HasStoreScopedBinding;
	protected static $storeLocalKey = 'mon_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id',
        'mon_id',
        'moneda',
        'abr',
        'tipoCambio',
        'singPlur',
        'caracter',
        'mn',
        'img16',
        'img24',
        'img32',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'store_id' => 'integer',
        'tipoCambio' => 'decimal:6',
        'mn' => 'boolean',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
