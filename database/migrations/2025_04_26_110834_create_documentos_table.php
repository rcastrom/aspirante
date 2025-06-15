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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aspirante_id')->constrained('fichas','id');
            $table->string('periodo','5');
            $table->string('foto',255)->nullable();
            $table->string('certificado_prepa',255)->nullable();
            $table->string('constancia_terminacion',255)->nullable();
            $table->string('acta_nacimiento',255)->nullable();
            $table->string('curp',255)->nullable();
            $table->string('constancia_imss',255)->nullable();
            $table->string('forma_migratoria',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
