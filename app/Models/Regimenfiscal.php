<?php

namespace App\Models;

use App\Models\Traits\HasStoreScopedBinding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Regimenfiscal extends Model
{
    use HasFactory, HasStoreScopedBinding;

	protected $table = 'regimenfiscales';
	protected static $storeLocalKey = 'rgf_id';			
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id',
        'rgf_id',
        'clave',
        'descripcion',
        'fisica',
        'moral',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'store_id' => 'integer',
        'fisica' => 'boolean',
        'moral' => 'boolean',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
