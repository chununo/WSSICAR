<?php

namespace App\Models;

use App\Models\Traits\HasStoreScopedBinding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vacacion extends Model
{
    use HasFactory, HasStoreScopedBinding;

	protected $table = 'vacaciones';
    protected static $storeLocalKey = 'vac_id';

    protected $fillable = [
        'store_id',
        'vac_id',
        'nombre',
        'minimo',
        'a1', 'a2', 'a3', 'a4', 'a5', 'a6', 'a7', 'a8', 'a9', 'a10',
        'a11', 'a12', 'a13', 'a14', 'a15', 'a16', 'a17', 'a18', 'a19', 'a20',
        'a21', 'a22', 'a23', 'a24', 'a25', 'a26', 'a27', 'a28', 'a29', 'a30',
        'a31', 'a32', 'a33', 'a34', 'a35', 'a36', 'a37', 'a38', 'a39', 'a40',
        'fechaVigorReemplazo',
        'vacacionReemplazo',
        'vacacionReemplazo_id',
        'validation_status',
        'validation_errors',
    ];

    protected $casts = [
        'store_id' => 'integer',
        'vac_id' => 'integer',
        'minimo' => 'integer',
        'fechaVigorReemplazo' => 'date',
        'vacacionReemplazo' => 'integer',
        'vacacionReemplazo_id' => 'integer',
        'validation_errors' => 'array',
    ];

    // Castear todos los campos a1–a40 como integer
    protected function casts(): array
    {
        $casts = [];
        foreach (range(1, 40) as $i) {
            $casts["a{$i}"] = 'integer';
        }
        return array_merge($this->casts, $casts);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function vacacionReemplazada(): BelongsTo
    {
        return $this->belongsTo(Vacacion::class, 'vacacionreemplazo_id');
    }
}
