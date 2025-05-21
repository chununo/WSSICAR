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

        Schema::create('combos', function (Blueprint $table) {
            $table->foreignId('store_id')->constrained();
            $table->integer('combo')->comment('ID local del artículo que es combo');
            $table->integer('grupo')->comment('ID local del grupo relacionado');
            $table->foreignId('combo_id')->nullable()->constrained('articulos')->comment('ID del servidor del artículo combo');
            $table->foreignId('grupo_id')->nullable()->constrained()->comment('ID del servidor del grupo');
            $table->integer('cantidad');
            $table->boolean('opcional')->default(1);
            $table->integer('orden')->default(-1);
            $table->boolean('incluido')->default(0);
            $table->integer('status')->default(1);
            $table->enum('validation_status', ["valid","partial","invalid"])->default('valid');
            $table->json('validation_errors')->nullable();
            $table->unique(['store_id', 'combo', 'grupo']);
            $table->index('combo_id');
            $table->index('grupo_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combos');
    }
};
