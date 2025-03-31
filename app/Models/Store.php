<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Store extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'alias',
        'correo_principal',
        'correo_secundario',
        'telefono_principal',
        'telefono_secundario',
        'calle',
        'numero_externo',
        'numero_interno',
        'colonia',
        'entidad',
        'estado',
        'cp',
        'nota_direccion',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(StoreUser::class);
    }
}
