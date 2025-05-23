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

        Schema::create('promociones', function (Blueprint $table) {
            $table->id()->comment('ID server de la promoción');
            $table->foreignId('store_id')->constrained();
            $table->integer('pro_id')->comment('ID local de la promoción');
            $table->string('nombre', 255);
            $table->date('fechaIni');
            $table->date('fechaFin');
            $table->decimal('descuento', 20, 2)->nullable();
            $table->integer('pago')->nullable();
            $table->integer('salida')->nullable();
            $table->integer('precio')->nullable();
            $table->boolean('condicion')->default(0);
            $table->decimal('totalMin', 20, 2)->nullable();
            $table->integer('piezasMin')->nullable();
            $table->integer('piezasReq')->nullable();
            $table->integer('piezasPromo')->nullable();
            $table->boolean('cascada')->default(0);
            $table->integer('status');
            $table->boolean('sincronizar');
            $table->boolean('mixto')->default(0);
            $table->boolean('mostrarComensal')->default(1);
            $table->boolean('artReq')->default(0);
            $table->boolean('artReqMixto')->default(0);
            $table->boolean('clientes')->default(1);
            $table->integer('hor_id')->nullable()->comment('ID local del horario promocional');
            $table->foreignId('horariopromo_id')->nullable()->constrained()->comment('ID del servidor del horario promocional');
            $table->enum('validation_status', ["valid","partial","invalid"])->default('valid');
            $table->json('validation_errors')->nullable();
            $table->unique(['store_id', 'pro_id']);
            $table->index('horariopromo_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promociones');
    }
};
