<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\DatoPersonalController;
use App\Http\Controllers\DatoFamiliarController;
use App\Http\Controllers\DatoPreparatoriaController;
use App\Http\Controllers\DatosSocioeconomicoController;
use App\Http\Controllers\DatosEmergenciaController;
use App\Http\Controllers\DocumentoController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard',[FichaController::class,'index'] )->name('dashboard');
    Route::resource('/datos_personales',DatoPersonalController::class);
    Route::resource('/datos_familiares',DatoFamiliarController::class);
    Route::resource('/datos_preparatoria',DatoPreparatoriaController::class);
    Route::resource('/datos_socioeconomicos',DatosSocioeconomicoController::class);
    Route::resource('/datos_emergencia',DatosEmergenciaController::class);
    Route::resource('/documentos',DocumentoController::class);
    Route::post('/municipios',[FichaController::class,'municipios'])
        ->name('municipios');
});
