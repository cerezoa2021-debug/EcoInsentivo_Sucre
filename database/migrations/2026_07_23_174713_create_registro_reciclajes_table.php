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
        Schema::create('registro_reciclajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('residuo_id')->constrained('residuos')->cascadeOnDelete();
            $table->foreignId('centro_id')->constrained('centros_acopios')->cascadeOnDelete(); /** */
            $table->integer('cantidad');
            $table->integer('puntos_generados')->default(0);
            $table->timestamp('fecha')->useCurrent();
            $table->string('estado')->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_reciclajes');
    }
};
