<?php

namespace App\Models;

use App\Models\Traits\HasStoreScopedBinding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Categoria extends Model
{
    use HasFactory, HasStoreScopedBinding;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id',
        'cat_id',
        'nombre',
        'system',
        'status',
        'departamento_id',
        'dep_id',
        'imagen',
        'comision',
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
        'cat_id' => 'integer',
        'system' => 'boolean',
        'departamento_id' => 'integer',
        'dep_id' => 'integer',
        'comision' => 'decimal:4',
		'validation_status' => 'string',
		'validation_errors' => 'array', 
    ];

	protected $guarded = ['store_id'];

	protected static $storeLocalKey = 'cat_id';

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }
}
