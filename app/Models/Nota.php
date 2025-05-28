<?php

namespace App\Models;

use App\Models\Traits\HasStoreScopedBinding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nota extends Model
{
    use HasFactory, HasStoreScopedBinding;

    protected static $storeLocalKey = 'not_id';

    protected $fillable = [
        'store_id',
        'not_id',
        'cli_id',
        'cliente_id',
        'validation_status',
        'validation_errors',
    ];

    protected $casts = [
        'store_id' => 'integer',
        'not_id' => 'integer',
        'cli_id' => 'integer',
        'cliente_id' => 'integer',
        'validation_errors' => 'array',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }
}
