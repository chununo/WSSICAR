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

        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->integer('cli_id');
            $table->string('nombre', 1000)->nullable();
            $table->string('representante', 1000)->nullable();
            $table->string('domicilio', 120);
            $table->string('noExt', 45);
            $table->string('noInt', 45);
            $table->string('localidad', 120);
            $table->string('ciudad', 120);
            $table->string('estado', 45);
            $table->string('pais', 45);
            $table->string('codigoPostal', 10);
            $table->string('colonia', 45);
            $table->string('rfc', 45);
            $table->string('curp', 45);
            $table->string('telefono', 45);
            $table->string('celular', 45);
            $table->string('mail', 255);
            $table->string('comentario', 255);
            $table->integer('status');
            $table->decimal('limite', 20, 2);
            $table->integer('precio');
            $table->integer('diasCredito');
            $table->boolean('retener')->default(false);
            $table->boolean('desglosarIEPS')->default(false);
            $table->boolean('notificar')->default(true);
            $table->string('clave', 45)->nullable();
            $table->binary('foto')->nullable();
            $table->binary('huella')->nullable();
            $table->binary('muestra')->nullable();
            $table->string('usoCfdi', 10)->nullable();
            $table->string('idCIF', 20)->nullable();
            $table->string('sid', 15)->nullable();
            $table->string('eduNivel', 128)->nullable();
            $table->string('eduClave', 128)->nullable();
            $table->string('eduRfc', 45)->nullable();
            $table->string('eduNombre', 120)->nullable();
            $table->integer('grc_id')->nullable()->comment('ID local del grupo cliente');
            $table->foreignId('grupocliente_id')->nullable()->constrained()->comment('ID servidor del grupo cliente');
            $table->integer('rgf_id')->nullable()->comment('ID local del régimen fiscal');
            $table->foreignId('regimenfiscal_id')->nullable()->constrained('regimenfiscales')->comment('ID servidor del régimen fiscal');
            $table->enum('validation_status', ["valid","partial","invalid"])->default('valid');
            $table->json('validation_errors')->nullable();
            $table->unique(['store_id', 'cli_id']);
            $table->index('grupocliente_id');
            $table->index('regimenfiscal_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
