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

        Schema::create('notas', function (Blueprint $table) {
            $table->id()->comment('ID server de la nota (controlado por el cliente)');
            $table->foreignId('store_id')->constrained();
            $table->bigInteger('not_id')->comment('ID local de la nota (controlado por el cliente)');
            $table->integer('cli_id')->comment('ID local del cliente (por tienda)');
            $table->foreignId('cliente_id')->nullable()->constrained()->comment('ID del cliente (servidor)');
            $table->enum('validation_status', ["valid","partial","invalid"])->default('valid');
            $table->json('validation_errors')->nullable();
            $table->unique(['store_id', 'not_id']);
            $table->index('cli_id');
            $table->index('cliente_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
