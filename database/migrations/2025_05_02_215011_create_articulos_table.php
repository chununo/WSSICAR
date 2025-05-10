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

        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->integer('art_id');
            $table->string('clave', 45);
            $table->string('claveAlterna', 45);
            $table->string('descripcion', 1000);
            $table->boolean('servicio');
            $table->string('localizacion', 10);
            $table->integer('invMin');
            $table->integer('invMax');
            $table->decimal('factor', 20, 3);
            $table->decimal('precioCompra', 20, 3);
            $table->decimal('preCompraProm', 20, 3);
            $table->decimal('margen1', 20, 6);
            $table->decimal('margen2', 20, 6);
            $table->decimal('margen3', 20, 6);
            $table->decimal('margen4', 20, 6);
            $table->decimal('precio1', 20, 6)->default(0.000000);
            $table->decimal('precio2', 20, 6)->default(0.000000);
            $table->decimal('precio3', 20, 6)->default(0.000000);
            $table->decimal('precio4', 20, 6)->default(0.000000);
            $table->decimal('mayoreo1', 20, 3);
            $table->decimal('mayoreo2', 20, 3);
            $table->decimal('mayoreo3', 20, 3);
            $table->decimal('mayoreo4', 20, 3);
            $table->decimal('existencia', 20, 4);
            $table->decimal('aislado', 20, 4)->default(0.0000);
            $table->decimal('disponible', 20, 4)->default(0.0000);
            $table->text('caracteristicas');
            $table->boolean('iepsActivo')->default(0);
            $table->decimal('cuotaIeps', 20, 4)->default(0.0000);
            $table->string('cuentaPredial', 45);
            $table->boolean('lote')->default(0);
            $table->boolean('receta')->default(0);
            $table->boolean('granel')->default(1);
            $table->integer('tipo')->default(0);
            $table->decimal('peso', 20, 4)->default(0.0000);
            $table->boolean('insumo')->default(0);
            $table->boolean('platillo')->default(0);
            $table->boolean('favorito')->default(0);
            $table->boolean('requerirPreparacion')->default(0);
            $table->boolean('presentacion')->default(0);
            $table->boolean('presentacionPrecio')->default(0);
            $table->boolean('pesoAut')->default(0);
            $table->string('claveProdServ', 15)->nullable();
            $table->integer('status');
            $table->integer('unidadCompra');
            $table->foreignId('unidadCompra_id')->nullable()->constrained('unidades');
            $table->integer('unidadVenta');
            $table->foreignId('unidadVenta_id')->nullable()->constrained('unidades');
            $table->integer('cat_id');
            $table->foreignId('categoria_id')->nullable()->constrained();
            $table->integer('srp_id')->nullable();
            $table->integer('mem_id')->nullable();
            $table->integer('diasVigencia')->nullable();
            $table->integer('prp_id')->nullable();
            $table->decimal('merma', 20, 4)->nullable();
            $table->integer('rpl_id')->nullable();
            $table->integer('imp_id')->nullable();
            $table->integer('tipoLote')->nullable();
            $table->string('nombreAduana', 512)->nullable();
            $table->date('fechaDocAduanero')->nullable();
            $table->string('pedimento', 128)->nullable();
            $table->integer('oculto')->nullable();
            $table->integer('horarioPromo')->nullable();
            $table->decimal('existenciaActivo', 20, 4)->nullable();
            $table->decimal('preCompraPromGas', 20, 3)->nullable();
            $table->boolean('showEco')->default(1);
            $table->integer('etiquetaVenta')->default(0);
            $table->enum('validation_status', ["valid","partial","invalid"])->default('valid');
            $table->json('validation_errors')->nullable();
            $table->unique(['store_id', 'art_id']);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articulos');
    }
};
