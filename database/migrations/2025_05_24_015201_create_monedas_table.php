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

        Schema::create('monedas', function (Blueprint $table) {
            $table->id()->comment('ID server de la moneda');
            $table->foreignId('store_id')->constrained();
            $table->integer('mon_id')->comment('ID local de la moneda');
            $table->string('moneda', 45);
            $table->string('abr', 5);
            $table->decimal('tipoCambio', 20, 6);
            $table->string('singPlur', 90);
            $table->string('caracter', 5);
            $table->boolean('mn')->default(0);
            $table->binary('img16')->nullable();
            $table->binary('img24')->nullable();
            $table->binary('img32')->nullable();
            $table->integer('status');
            $table->unique(['store_id', 'mon_id']);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monedas');
    }
};
