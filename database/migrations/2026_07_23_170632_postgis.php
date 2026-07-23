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
        // Crea la extension postgis si no existe
        DB::statement('CREATE EXTENSION IF NOT EXISTS postgis');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Genera una advertencia si hay otra tabla usando postgis
        DB::statement('DROP EXTENSION IF EXISTS postgis');
    }
};
