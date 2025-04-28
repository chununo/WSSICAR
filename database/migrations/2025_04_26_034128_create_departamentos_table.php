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

        Schema::create('departamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->bigInteger('dep_id');
            $table->string('nombre')->comment('Nombre del departamento (máximo 45 caracteres)');
            $table->boolean('restringido')->default(0);
            $table->decimal('porcentaje', 20, 2)->default(0.00);
            $table->boolean('system')->default(0);
            $table->integer('status');
            $table->binary('imagen')->nullable();
            $table->decimal('comision', 20, 4)->nullable();
            $table->unique(['store_id', 'dep_id']);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamentos');
    }
};
