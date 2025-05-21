<?php

namespace App\Models;

use App\Models\Traits\HasStoreScopedBinding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grupo extends Model
{
    use HasFactory, HasStoreScopedBinding;

    protected $fillable = [
        'store_id',
        'gar_id',
        'nombre',
        'status',
        'padre'
    ];

    protected $casts = [
        'id' => 'integer',
        'store_id' => 'integer',
        'gar_id' => 'integer',
        'status' => 'integer',
        'padre' => 'integer',
    ];

    // Si estás usando binding por 'gar_id'
    protected static $storeLocalKey = 'gar_id';

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function padreGrupo(): BelongsTo
    {
        return $this->belongsTo(self::class, 'padre');
    }

    public function subGrupos(): HasMany
    {
        return $this->hasMany(self::class, 'padre');
    }
}
