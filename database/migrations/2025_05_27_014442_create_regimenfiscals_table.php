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

        Schema::create('regimenfiscales', function (Blueprint $table) {
            $table->id()->comment('ID server del régimen fiscal');
            $table->foreignId('store_id')->constrained();
            $table->integer('rgf_id')->comment('ID local del régimen fiscal');
            $table->string('clave', 5);
            $table->string('descripcion', 255);
            $table->boolean('fisica');
            $table->boolean('moral');
            $table->unique(['store_id', 'rgf_id']);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regimenfiscales');
    }
};
