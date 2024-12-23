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
        Schema::create('datos_familiares', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aspirante_id')->constrained('fichas','id');
            $table->boolean('vive_padre')->default(true);
            $table->string('apellido_paterno_padre')->nullable();
            $table->string('apellido_materno_padre')->nullable();
            $table->string('nombre_padre')->nullable();
            $table->string('apellido_paterno_madre')->nullable();
            $table->string('apellido_materno_madre')->nullable();
            $table->string('nombre_madre')->nullable();
            $table->boolean('vive_madre')->default(true);
            $table->string('estado_civil',1);
            $table->string('capacidad_diferente')->nullable();
            $table->boolean('beca')->default(false);
            $table->string('zona_procedencia',1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dato_familiares');
    }
};
