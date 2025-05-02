<?php

namespace App\Models;

use App\Models\Traits\HasStoreScopedBinding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Departamento extends Model
{
    use HasFactory, HasStoreScopedBinding;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id',
        'dep_id',
        'nombre',
        'restringido',
        'porcentaje',
        'system',
        'status',
        'imagen',
        'comision',
		'departamento_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'store_id' => 'integer',
        'dep_id' => 'integer',
        'restringido' => 'boolean',
        'porcentaje' => 'decimal:2',
        'system' => 'boolean',
        'comision' => 'decimal:4',
    ];

	protected $guarded = ['store_id'];

	protected static $storeLocalKey = 'dep_id';

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
