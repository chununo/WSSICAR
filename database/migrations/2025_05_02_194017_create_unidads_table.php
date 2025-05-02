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

        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->integer('uni_id');
            $table->string('nombre', 5);
            $table->integer('status');
            $table->string('clave', 10)->nullable();
            $table->unique(['store_id', 'uni_id']);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades');
    }
};
