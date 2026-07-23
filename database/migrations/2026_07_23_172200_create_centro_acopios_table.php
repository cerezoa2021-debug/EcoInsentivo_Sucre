<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('centros_acopios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('direccion');
            $table->string('horario')->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
        // Columna de postgis permite mejor calculo  de las dintancias y la ubicacion
        DB::statement('ALTER TABLE centros_acopios ADD COLUMN ubicacion geography(Point, 4326)');
        DB::statement('CREATE INDEX centros_acopio_ubicacion_idx ON centros_acopios USING GIST (ubicacion)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centros_acopios');
    }
};
