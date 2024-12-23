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
        Schema::create('datos_socioeconomicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aspirante_id')->constrained('fichas','id');
            $table->integer('nivel_estudios_padre_id');
            $table->integer('nivel_estudios_madre_id');
            $table->string('habita');
            $table->integer('ingresos_padre')->nullable();
            $table->integer('ingresos_madre')->nullable();
            $table->integer('ingresos_hermanos')->nullable();
            $table->integer('ingresos_propios')->nullable();
            $table->foreignId('ocupacion_padre_id')->constrained('ocupaciones','id');
            $table->foreignId('ocupacion_madre_id')->constrained('ocupaciones','id');
            $table->string('casa_vives')->nullable();
            $table->string('dependencia');
            $table->integer('cuartos_casa');
            $table->integer('personas_casa');
            $table->integer('personas_dependen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_socioeconomicos');
    }
};
