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
        Schema::create('datos_emergencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aspirante_id')->constrained('fichas','id');
            $table->foreignId('tipo_sangre_id')->constrained('tipos_sangre','id');
            $table->string('comunicar_con')->nullable();
            $table->string('tipo_alergia')->nullable();
            $table->string('enfermedad')->nullable();
            $table->string('calle_numero')->nullable();
            $table->string('colonia')->nullable();
            $table->string('municipio')->nullable();
            $table->string('telefono_contacto')->nullable();
            $table->string('lugar_trabajo')->nullable();
            $table->string('telefono_trabajo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_emergencias');
    }
};
