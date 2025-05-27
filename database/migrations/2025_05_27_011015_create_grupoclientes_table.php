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

        Schema::create('grupoclientes', function (Blueprint $table) {
            $table->id()->comment('ID server del grupo cliente');;
            $table->foreignId('store_id')->constrained();
            $table->integer('grc_id')->comment('ID local del grupo cliente');
            $table->string('descripcion', 255);
            $table->integer('precio');
            $table->boolean('precioObligatorio');
            $table->integer('status');
            $table->unique(['store_id', 'grc_id']);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupoclientes');
    }
};
