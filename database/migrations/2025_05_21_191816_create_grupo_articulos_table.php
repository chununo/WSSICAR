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

        Schema::create('grupoarticulos', function (Blueprint $table) {
            $table->foreignId('store_id')->constrained();
            $table->integer('gar_id')->comment('ID local del grupo');
            $table->integer('art_id')->comment('ID local del artículo');
            $table->foreignId('grupo_id')->nullable()->constrained()->comment('ID del grupo en el servidor');
            $table->foreignId('articulo_id')->nullable()->constrained()->comment('ID del artículo en el servidor');
            $table->decimal('costoExtra', 20, 2)->default(0.00);
            $table->integer('status')->default(1);
            $table->decimal('cantidad', 20, 3)->nullable();
            $table->boolean('imprimir')->nullable();
            $table->string('alias', 100)->nullable();
            $table->enum('validation_status', ["valid","partial","invalid"])->default('valid');
            $table->json('validation_errors')->nullable();
            $table->unique(['store_id', 'gar_id', 'art_id']);
            $table->index('grupo_id');
            $table->index('articulo_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupoarticulos');
    }
};
