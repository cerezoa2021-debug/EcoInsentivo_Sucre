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
        Schema::create('clasificacion_ias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('imagen_id')->constrained('imagenes')->cascadeOnDelete();
            $table->string('tipo_detectado');
            $table->decimal('confianza', 5, 2);
            $table->string('modelo');
            $table->timestamp('fecha')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clasificacion_ias');
    }
};
