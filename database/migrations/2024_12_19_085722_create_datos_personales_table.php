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
        Schema::create('datos_personales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aspirante_id')->constrained('fichas','id');
            $table->string('nombre');
            $table->string('apellido_paterno')->nullable();
            $table->string('apellido_materno');
            $table->date('fecha_nacimiento');
            $table->string('sexo');
            $table->foreignId('pais_id')->constrained('paises','id');
            $table->foreignId('estado_nacimiento_id')->constrained('estados','estado_id');
            $table->foreignId('municipio_nacimiento_id')->constrained('municipios','id');
            $table->foreignId('etnia_id')->constrained('etnias','id');
            $table->string('curp',18);
            $table->string('carrera');
            $table->string('telefono');
            $table->string('calle_numero');
            $table->string('colonia');
            $table->foreignId('estado_domicilio_id')->constrained('estados','estado_id');
            $table->foreignId('municipio_domicilio_id')->constrained('municipios','id');
            $table->string('codigo_postal',5);
            $table->string('correo');
            $table->string('fb')->nullable();
            $table->string('ig')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_personales');
    }
};
