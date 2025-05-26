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

        Schema::create('resumencortecajas', function (Blueprint $table) {
            $table->id()->comment('ID server del resumen');
            $table->foreignId('store_id')->constrained();
            $table->integer('rcc_id')->comment('ID local del resumen');
            $table->integer('cor_id')->nullable()->comment('ID local del corte de caja');
            $table->foreignId('cortecaja_id')->nullable()->constrained()->comment('ID servidor del corte de caja');
            $table->decimal('venCon', 20, 2);
            $table->decimal('venCre', 20, 2);
            $table->decimal('venConC', 20, 2);
            $table->decimal('venCreC', 20, 2);
            $table->decimal('comCon', 20, 2);
            $table->decimal('comCre', 20, 2);
            $table->decimal('comConC', 20, 2);
            $table->decimal('comCreC', 20, 2);
            $table->decimal('notCre', 20, 2)->default(0.00);
            $table->decimal('notCreC', 20, 2)->default(0.00);
            $table->decimal('entVen', 20, 2);
            $table->decimal('entCre', 20, 2);
            $table->decimal('entComC', 20, 2);
            $table->decimal('entNotC', 20, 2)->default(0.00);
            $table->decimal('entMov', 20, 2);
            $table->decimal('salCom', 20, 2);
            $table->decimal('salCre', 20, 2);
            $table->decimal('salVenC', 20, 2);
            $table->decimal('salNot', 20, 2)->default(0.00);
            $table->decimal('salMov', 20, 2);
            $table->decimal('gasCon', 20, 2)->nullable();
            $table->decimal('gasCre', 20, 2)->nullable();
            $table->decimal('gasConC', 20, 2)->nullable();
            $table->decimal('gasCreC', 20, 2)->nullable();
            $table->decimal('notCrePro', 20, 2)->nullable();
            $table->decimal('notCreProC', 20, 2)->nullable();
            $table->decimal('entGasC', 20, 2)->nullable();
            $table->decimal('salNotProC', 20, 2)->nullable();
            $table->decimal('salGas', 20, 2)->nullable();
            $table->decimal('entNotPro', 20, 2)->nullable();
            $table->enum('validation_status', ["valid","partial","invalid"])->default('valid');
            $table->json('validation_errors')->nullable();
            $table->unique(['store_id', 'rcc_id']);
            $table->index('cortecaja_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumencortecajas');
    }
};
