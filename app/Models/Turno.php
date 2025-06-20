<?php

namespace App\Models;

use App\Models\Traits\HasStoreScopedBinding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Turno extends Model
{
    use HasFactory, HasStoreScopedBinding;

    /** Clave local (no autoincremental) */
    protected static $storeLocalKey = 'tur_id';

    /** Asignación en masa */
    protected $fillable = [
        'store_id',
        'tur_id',
        'nombre',
        'nocturno',
        'semana',
        'horaEnt',
        'horaSal',
        'lunes',  'entLun',  'salLun',
        'martes', 'entMar',  'salMar',
        'miercoles', 'entMie', 'salMie',
        'jueves', 'entJue', 'salJue',
        'viernes', 'entVie', 'salVie',
        'sabado', 'entSab', 'salSab',
        'domingo', 'entDom', 'salDom',
        'tipo',
        'status',
    ];

    /** Casts */
    protected $casts = [
        'store_id' => 'integer',
        'tur_id'   => 'integer',
        'nocturno' => 'boolean',
        'semana'   => 'boolean',
        'lunes'    => 'boolean',
        'martes'   => 'boolean',
        'miercoles'=> 'boolean',
        'jueves'   => 'boolean',
        'viernes'  => 'boolean',
        'sabado'   => 'boolean',
        'domingo'  => 'boolean',
        'horaEnt'  => 'datetime:H:i:s',
        'horaSal'  => 'datetime:H:i:s',
        'entLun'   => 'datetime:H:i:s',
        'salLun'   => 'datetime:H:i:s',
        'entMar'   => 'datetime:H:i:s',
        'salMar'   => 'datetime:H:i:s',
        'entMie'   => 'datetime:H:i:s',
        'salMie'   => 'datetime:H:i:s',
        'entJue'   => 'datetime:H:i:s',
        'salJue'   => 'datetime:H:i:s',
        'entVie'   => 'datetime:H:i:s',
        'salVie'   => 'datetime:H:i:s',
        'entSab'   => 'datetime:H:i:s',
        'salSab'   => 'datetime:H:i:s',
        'entDom'   => 'datetime:H:i:s',
        'salDom'   => 'datetime:H:i:s',
        'tipo'     => 'integer',
        'status'   => 'integer',
    ];

    /** Relación con Store */
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
