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

        Schema::create('vacaciones', function (Blueprint $table) {
            $table->id()->comment('ID server definido por el cliente');
            $table->foreignId('store_id')->constrained();
            $table->integer('vac_id')->comment('ID local definido por el cliente');
            $table->string('nombre', 255);
            $table->integer('minimo')->default(12);
            $table->integer('a1');
            $table->integer('a2');
            $table->integer('a3');
            $table->integer('a4');
            $table->integer('a5');
            $table->integer('a6');
            $table->integer('a7');
            $table->integer('a8');
            $table->integer('a9');
            $table->integer('a10');
            $table->integer('a11');
            $table->integer('a12');
            $table->integer('a13');
            $table->integer('a14');
            $table->integer('a15');
            $table->integer('a16');
            $table->integer('a17');
            $table->integer('a18');
            $table->integer('a19');
            $table->integer('a20');
            $table->integer('a21');
            $table->integer('a22');
            $table->integer('a23');
            $table->integer('a24');
            $table->integer('a25');
            $table->integer('a26');
            $table->integer('a27');
            $table->integer('a28');
            $table->integer('a29');
            $table->integer('a30');
            $table->integer('a31');
            $table->integer('a32');
            $table->integer('a33');
            $table->integer('a34');
            $table->integer('a35');
            $table->integer('a36');
            $table->integer('a37');
            $table->integer('a38');
            $table->integer('a39');
            $table->integer('a40');
            $table->date('fechaVigorReemplazo')->nullable();
            $table->integer('vacacionReemplazo')->nullable()->comment('ID local del reemplazo');
            $table->foreignId('vacacionreemplazo_id')->nullable()->constrained('vacaciones')->comment('ID servidor del reemplazo');
            $table->enum('validation_status', ["valid","partial","invalid"])->default('valid');
            $table->json('validation_errors')->nullable();
            $table->unique(['store_id', 'vac_id']);
            $table->index('vacacionreemplazo_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacaciones');
    }
};
