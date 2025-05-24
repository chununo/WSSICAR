<?php

namespace App\Models;

use App\Models\Traits\HasStoreScopedBinding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cortecaja extends Model
{
    use HasFactory, HasStoreScopedBinding;

    protected static $storeLocalKey = 'cor_id';

    protected $fillable = [
        'store_id',
        'cor_id',
        'fecha',
        'contado',
        'calculado',
        'diferencia',
        'retiro',
        'caj_id',
        'caja_id',
        'validation_status',
        'validation_errors',
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'contado' => 'decimal:2',
        'calculado' => 'decimal:2',
        'diferencia' => 'decimal:2',
        'retiro' => 'decimal:2',
        'validation_errors' => 'array',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function caja(): BelongsTo
    {
        return $this->belongsTo(Caja::class);
    }
}
