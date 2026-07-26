<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResiduoController;
use App\Http\Controllers\EmpresaAliadaController;
use App\Http\Controllers\PuntosController;
use App\Http\Controllers\CentroAcopioController;

Route::prefix('puntos')->name('puntos.')->group(function () {
    Route::get('/', [PuntosController::class, 'index'])->name('index');
    Route::post('/confirmar/{registro}', [PuntosController::class, 'confirmar'])->name('confirmar');
    Route::post('/ajustar/{usuario}', [PuntosController::class, 'ajustar'])->name('ajustar');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('centros-acopio-mapa-data', [CentroAcopioController::class, 'mapaData'])
    ->name('centros-acopio.mapa-data');

Route::resource('users', UserController::class);
Route::resource('residuos', ResiduoController::class);
Route::resource('empresas-aliadas', EmpresaAliadaController::class);
Route::resource('centros-acopio', CentroAcopioController::class);