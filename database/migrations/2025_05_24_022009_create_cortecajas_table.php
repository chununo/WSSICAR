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

        Schema::create('cortecajas', function (Blueprint $table) {
            $table->id()->comment('ID server del corte de caja');
            $table->foreignId('store_id')->constrained();
            $table->bigInteger('cor_id')->comment('ID local del corte de caja');
            $table->dateTime('fecha');
            $table->decimal('contado', 20, 2);
            $table->decimal('calculado', 20, 2);
            $table->decimal('diferencia', 20, 2);
            $table->decimal('retiro', 20, 2);
            $table->integer('caj_id')->comment('ID local de la caja');
            $table->foreignId('caja_id')->nullable()->constrained()->comment('ID del servidor de la caja');
            $table->enum('validation_status', ["valid","partial","invalid"])->default('valid');
            $table->json('validation_errors')->nullable();
            $table->unique(['store_id', 'cor_id']);
            $table->index('caja_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cortecajas');
    }
};
