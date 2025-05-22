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

        Schema::create('horariopromos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->integer('hor_id');
            $table->string('nombre', 45);
            $table->boolean('lunes');
            $table->time('iniLun')->nullable();
            $table->time('finLun')->nullable();
            $table->boolean('martes');
            $table->time('iniMar')->nullable();
            $table->time('finMar')->nullable();
            $table->boolean('miercoles');
            $table->time('iniMie')->nullable();
            $table->time('finMie')->nullable();
            $table->boolean('jueves');
            $table->time('iniJue')->nullable();
            $table->time('finJue')->nullable();
            $table->boolean('viernes');
            $table->time('iniVie')->nullable();
            $table->time('finVie')->nullable();
            $table->boolean('sabado');
            $table->time('iniSab')->nullable();
            $table->time('finSab')->nullable();
            $table->boolean('domingo');
            $table->time('iniDom')->nullable();
            $table->time('finDom')->nullable();
            $table->integer('status')->default(1);
            $table->unique(['store_id', 'hor_id']);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horariopromos');
    }
};
