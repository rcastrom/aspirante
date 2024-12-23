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
        Schema::create('datos_preparatoria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aspirante_id')->constrained('fichas','id');
            $table->foreignId('estado_id')->constrained('estados','estado_id');
            $table->string('nombre_preparatoria');
            $table->string('egreso',4);
            $table->string('promedio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_preparatoria');
    }
};
