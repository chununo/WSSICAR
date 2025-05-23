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

        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->bigInteger('cat_id');
            $table->string('nombre', 45);
            $table->boolean('system')->default(0);
            $table->integer('status');
            $table->foreignId('departamento_id')->constrained();
            $table->bigInteger('dep_id');
            $table->binary('imagen')->nullable();
            $table->decimal('comision', 20, 4)->nullable();
            $table->unique(['store_id', 'cat_id']);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
