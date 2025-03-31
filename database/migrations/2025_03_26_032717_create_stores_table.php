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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->comment('Nombre de la sucursal');
            $table->string('alias')->nullable();
            $table->string('correo_principal')->nullable();
            $table->string('correo_secundario')->nullable();
            $table->string('telefono_principal')->nullable();
            $table->string('telefono_secundario')->nullable();
            $table->string('calle')->nullable();
            $table->string('numero_externo')->nullable();
            $table->string('numero_interno')->nullable();
            $table->string('colonia')->nullable();
            $table->string('entidad')->nullable()->comment('Delegación, alcaldía');
            $table->string('estado')->nullable();
            $table->string('cp')->nullable();
            $table->string('nota_direccion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
