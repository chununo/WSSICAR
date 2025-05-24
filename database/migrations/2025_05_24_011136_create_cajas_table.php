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

        Schema::create('cajas', function (Blueprint $table) {
            $table->id()->comment('ID server de la caja');
            $table->foreignId('store_id')->constrained();
            $table->integer('caj_id')->comment('ID local de la caja');
            $table->string('nombre', 45);
            $table->decimal('total', 20, 2);
            $table->integer('status');
            $table->timestamps();

            // Solo el ID local debe ser único por tienda
            $table->unique(['store_id', 'caj_id'], 'cajas_store_id_caj_id_unique');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cajas');
    }
};
