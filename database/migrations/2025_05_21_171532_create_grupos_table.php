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

        Schema::create('grupos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->integer('gar_id');
            $table->string('nombre', 45);
            $table->integer('status');
            $table->integer('padre')->nullable();
            $table->unique(['store_id', 'gar_id']);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupos');
    }
};
