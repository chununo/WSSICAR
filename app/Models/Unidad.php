<?php

namespace App\Models;

use App\Models\Traits\HasStoreScopedBinding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Unidad extends Model
{
    use HasFactory, HasStoreScopedBinding;

	protected $table = 'unidades';
	
    /**
	 * The attributes that are mass assignable.
     *
	 * @var array
     */
	protected $fillable = [
		'store_id',
        'uni_id',
        'nombre',
        'status',
        'clave',
    ];
	
    /**
	 * The attributes that should be cast to native types.
     *
	 * @var array
     */
	protected $casts = [
		'id' => 'integer',
        'store_id' => 'integer',
    ];
	
	protected $guarded = ['store_id'];
	protected static $storeLocalKey = 'uni_id';
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
