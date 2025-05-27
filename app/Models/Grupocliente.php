<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasStoreScopedBinding;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grupocliente extends Model
{
    use HasFactory, HasStoreScopedBinding;

    protected static $storeLocalKey = 'grc_id';

    protected $fillable = [
        'store_id',
        'grc_id',
        'descripcion',
        'precio',
        'precioObligatorio',
        'status',
    ];

    protected $casts = [
        'store_id' => 'integer',
        'grc_id' => 'integer',
        'precio' => 'integer',
        'precioObligatorio' => 'boolean',
        'status' => 'integer',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
