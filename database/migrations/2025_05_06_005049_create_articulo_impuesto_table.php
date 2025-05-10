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
		Schema::create('articuloimpuesto', function (Blueprint $table) {
			$table->unsignedBigInteger('store_id');
			$table->integer('art_id');
			$table->integer('imp_id');
	
			// Nuevas columnas
			$table->foreignId('articulo_id')->nullable()->constrained('articulos')->nullOnDelete();
			$table->foreignId('impuesto_id')->nullable()->constrained('impuestos')->nullOnDelete();
	
			$table->enum('validation_status', ['valid', 'partial', 'invalid'])->default('valid');
			$table->json('validation_errors')->nullable();
	
			// clave primaria compuesta original
			$table->primary(['store_id', 'art_id', 'imp_id']);
	
			$table->index(['store_id','art_id']);
			$table->index(['store_id','imp_id']);
		});
	}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articuloimpuesto');
    }
};
