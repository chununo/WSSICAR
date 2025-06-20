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

        Schema::create('turnos', function (Blueprint $table) {
            $table->id()->comment('ID server del turno');
            $table->foreignId('store_id')->constrained();
            $table->integer('tur_id')->comment('ID local del turno');
            $table->string('nombre', 45);
            $table->boolean('nocturno');
            $table->boolean('semana');
            $table->time('horaEnt')->nullable();
            $table->time('horaSal')->nullable();
            $table->boolean('lunes')->nullable();
            $table->time('entLun')->nullable();
            $table->time('salLun')->nullable();
            $table->boolean('martes')->nullable();
            $table->time('entMar')->nullable();
            $table->time('salMar')->nullable();
            $table->boolean('miercoles')->nullable();
            $table->time('entMie')->nullable();
            $table->time('salMie')->nullable();
            $table->boolean('jueves')->nullable();
            $table->time('entJue')->nullable();
            $table->time('salJue')->nullable();
            $table->boolean('viernes')->nullable();
            $table->time('entVie')->nullable();
            $table->time('salVie')->nullable();
            $table->boolean('sabado')->nullable();
            $table->time('entSab')->nullable();
            $table->time('salSab')->nullable();
            $table->boolean('domingo')->nullable();
            $table->time('entDom')->nullable();
            $table->time('salDom')->nullable();
            $table->integer('tipo')->default(1)->comment('1 - Turno Normal, 2 - Excepciones');
            $table->integer('status')->default(1)->comment('1 - Activo, 2 - Eliminado');
            $table->unique(['store_id', 'tur_id']);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turnos');
    }
};
