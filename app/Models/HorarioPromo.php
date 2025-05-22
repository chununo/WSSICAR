<?php

namespace App\Models;

use App\Models\Traits\HasStoreScopedBinding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HorarioPromo extends Model
{
    use HasFactory, HasStoreScopedBinding;

    protected static $storeLocalKey = 'hor_id';
	protected $table = 'horariopromos';

    protected $fillable = [
        'store_id',
        'hor_id',
        'nombre',
        'lunes', 'iniLun', 'finLun',
        'martes', 'iniMar', 'finMar',
        'miercoles', 'iniMie', 'finMie',
        'jueves', 'iniJue', 'finJue',
        'viernes', 'iniVie', 'finVie',
        'sabado', 'iniSab', 'finSab',
        'domingo', 'iniDom', 'finDom',
        'status',
    ];

    protected $casts = [
        'id' => 'integer',
        'store_id' => 'integer',
        'hor_id' => 'integer',
        'lunes' => 'boolean',
        'martes' => 'boolean',
        'miercoles' => 'boolean',
        'jueves' => 'boolean',
        'viernes' => 'boolean',
        'sabado' => 'boolean',
        'domingo' => 'boolean',
        'iniLun' => 'string',
        'finLun' => 'string',
        'iniMar' => 'string',
        'finMar' => 'string',
        'iniMie' => 'string',
        'finMie' => 'string',
        'iniJue' => 'string',
        'finJue' => 'string',
        'iniVie' => 'string',
        'finVie' => 'string',
        'iniSab' => 'string',
        'finSab' => 'string',
        'iniDom' => 'string',
        'finDom' => 'string',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
