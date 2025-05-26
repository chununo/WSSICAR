<?php

namespace App\Models;

use App\Models\Traits\HasStoreScopedBinding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resumencortecaja extends Model
{
   	use HasFactory, HasStoreScopedBinding;

    protected static $storeLocalKey = 'rcc_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id',
        'rcc_id',
        'cor_id',
        'cortecaja_id',
        'venCon',
        'venCre',
        'venConC',
        'venCreC',
        'comCon',
        'comCre',
        'comConC',
        'comCreC',
        'notCre',
        'notCreC',
        'entVen',
        'entCre',
        'entComC',
        'entNotC',
        'entMov',
        'salCom',
        'salCre',
        'salVenC',
        'salNot',
        'salMov',
        'gasCon',
        'gasCre',
        'gasConC',
        'gasCreC',
        'notCrePro',
        'notCreProC',
        'entGasC',
        'salNotProC',
        'salGas',
        'entNotPro',
        'validation_status',
        'validation_errors',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'store_id' => 'integer',
        'cortecaja_id' => 'integer',
        'venCon' => 'decimal:2',
        'venCre' => 'decimal:2',
        'venConC' => 'decimal:2',
        'venCreC' => 'decimal:2',
        'comCon' => 'decimal:2',
        'comCre' => 'decimal:2',
        'comConC' => 'decimal:2',
        'comCreC' => 'decimal:2',
        'notCre' => 'decimal:2',
        'notCreC' => 'decimal:2',
        'entVen' => 'decimal:2',
        'entCre' => 'decimal:2',
        'entComC' => 'decimal:2',
        'entNotC' => 'decimal:2',
        'entMov' => 'decimal:2',
        'salCom' => 'decimal:2',
        'salCre' => 'decimal:2',
        'salVenC' => 'decimal:2',
        'salNot' => 'decimal:2',
        'salMov' => 'decimal:2',
        'gasCon' => 'decimal:2',
        'gasCre' => 'decimal:2',
        'gasConC' => 'decimal:2',
        'gasCreC' => 'decimal:2',
        'notCrePro' => 'decimal:2',
        'notCreProC' => 'decimal:2',
        'entGasC' => 'decimal:2',
        'salNotProC' => 'decimal:2',
        'salGas' => 'decimal:2',
        'entNotPro' => 'decimal:2',
        'validation_errors' => 'array',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function cortecaja(): BelongsTo
    {
        return $this->belongsTo(Cortecaja::class);
    }
}
