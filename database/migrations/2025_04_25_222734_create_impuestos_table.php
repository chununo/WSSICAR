<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('impuestos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->bigInteger('imp_id');
            $table->string('nombre')->comment('Nombre del impuesto (máximo 20 caracteres)');
            $table->decimal('impuesto', 20, 6)->comment('Impuesto (máximo 20 caracteres)');
            $table->boolean('impreso');
            $table->boolean('tras')->default(1);
            $table->boolean('local')->default(0);
            $table->boolean('aplicarIVA')->default(0);
            $table->integer('orden')->default(0);
            $table->integer('status');
            $table->string('tipoFactor')->nullable()->comment('Tipo de factor (máximo 15 caracteres)');
            $table->integer('cco_id')->nullable();
            $table->integer('compraPagada')->nullable();
            $table->integer('compraCredito')->nullable();
            $table->integer('gastoPagado')->nullable();
            $table->integer('gastoCredito')->nullable();
            $table->integer('anticipoCliente')->nullable();
            $table->unique(['store_id', 'imp_id']);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impuestos');
    }
};
