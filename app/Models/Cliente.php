<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasStoreScopedBinding;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cliente extends Model
{
    use HasFactory, HasStoreScopedBinding;

    protected static $storeLocalKey = 'cli_id';

    protected $fillable = [
        'store_id',
        'cli_id',
        'nombre',
        'representante',
        'domicilio',
        'noExt',
        'noInt',
        'localidad',
        'ciudad',
        'estado',
        'pais',
        'codigoPostal',
        'colonia',
        'rfc',
        'curp',
        'telefono',
        'celular',
        'mail',
        'comentario',
        'status',
        'limite',
        'precio',
        'diasCredito',
        'retener',
        'desglosarIEPS',
        'notificar',
        'clave',
        'foto',
        'huella',
        'muestra',
        'usoCfdi',
        'idCIF',
        'sid',
        'eduNivel',
        'eduClave',
        'eduRfc',
        'eduNombre',
        'grc_id',
        'grupocliente_id',
        'rgf_id',
        'regimenfiscal_id',
        'validation_status',
        'validation_errors',
    ];

    protected $casts = [
        'store_id' => 'integer',
        'cli_id' => 'integer',
        'status' => 'integer',
        'limite' => 'decimal:2',
        'precio' => 'integer',
        'diasCredito' => 'integer',
        'retener' => 'boolean',
        'desglosarIEPS' => 'boolean',
        'notificar' => 'boolean',
        'grc_id' => 'integer',
        'rgf_id' => 'integer',
        'grupocliente_id' => 'integer',
        'regimenfiscal_id' => 'integer',
        'validation_errors' => 'array',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function grupocliente(): BelongsTo
    {
        return $this->belongsTo(Grupocliente::class);
    }

    public function regimenfiscal(): BelongsTo
    {
        return $this->belongsTo(Regimenfiscal::class);
    }
}
