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
        Schema::create('fichas', function (Blueprint $table) {
            $table->id();
            $table->string('periodo');
            $table->foreignId('aspirante')->constrained('users');
            $table->integer('ficha')->default(0);
            $table->integer('bandera1')->default(0);
            $table->integer('bandera2')->default(0);
            $table->integer('bandera3')->default(0);
            $table->integer('bandera4')->default(0);
            $table->integer('bandera5')->default(0);
            $table->integer('pago_ficha')->default(0);
            $table->integer('pago_propedeutico')->default(0);
            $table->integer('pago_inscripcion')->default(0);
            $table->string('control')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fichas');
    }
};
