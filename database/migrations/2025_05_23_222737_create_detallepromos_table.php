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

        Schema::create('detallepromos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->integer('dpr_id')->comment('ID local del detalle de promoción');
            $table->integer('pro_id')->comment('ID local de la promoción');
            $table->foreignId('promocion_id')->nullable()->constrained('promociones')->comment('ID servidor de la promoción');
            $table->integer('art_id')->nullable()->comment('ID local del artículo');
            $table->foreignId('articulo_id')->nullable()->constrained()->comment('ID servidor del artículo');
            $table->integer('cat_id')->nullable()->comment('ID local de la categoría');
            $table->foreignId('categoria_id')->nullable()->constrained()->comment('ID servidor de la categoría');
            $table->integer('dep_id')->nullable()->comment('ID local del departamento');
            $table->foreignId('departamento_id')->nullable()->constrained()->comment('ID servidor del departamento');
            $table->integer('tipo')->default(1);
            $table->integer('status')->default(1);
            $table->enum('validation_status', ["valid","partial","invalid"])->default('valid');
            $table->json('validation_errors')->nullable();
            $table->unique(['store_id', 'dpr_id']);
            $table->index('promocion_id');
            $table->index('articulo_id');
            $table->index('categoria_id');
            $table->index('departamento_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detallepromos');
    }
};
