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

        Schema::create('paquetes', function (Blueprint $table) {
            $table->foreignId('store_id')->constrained();
            $table->integer('paquete')->comment('ID local del artículo que es paquete');
            $table->integer('articulo')->comment('ID local del artículo contenido en el paquete');
            $table->foreignId('paquete_id')->nullable()->constrained('articulos')->comment('ID del servidor del artículo que es paquete');
            $table->foreignId('articulo_id')->nullable()->constrained()->comment('ID del servidor del artículo contenido');
            $table->decimal('cantidad', 20, 5);
            $table->boolean('opcional')->default(0);
            $table->boolean('incluido')->default(1);
            $table->boolean('costoExtra')->default(0);
            $table->decimal('porcion', 20, 3)->nullable();
            $table->integer('grupo')->nullable();
            $table->integer('maximo')->nullable();
            $table->integer('minimo')->nullable();
            $table->integer('multiplicador')->nullable();
            $table->enum('validation_status', ["valid","partial","invalid"])->default('valid');
            $table->json('validation_errors')->nullable();
            $table->unique(['store_id', 'paquete', 'articulo']);
            $table->index('paquete_id');
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
        Schema::dropIfExists('paquetes');
    }
};
