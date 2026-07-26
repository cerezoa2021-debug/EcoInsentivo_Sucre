<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResiduoController;
use App\Http\Controllers\EmpresaAliadaController;
use App\Http\Controllers\PuntosController;
use App\Http\Controllers\CentroAcopioController;

//  RUTAS DE BREEZE Auth y Dashboard
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//  tus rutas Agregadas aqui


Route::prefix('puntos')->name('puntos.')->group(function () {
    Route::get('/', [PuntosController::class, 'index'])->name('index');
    Route::post('/confirmar/{registro}', [PuntosController::class, 'confirmar'])->name('confirmar');
    Route::post('/ajustar/{usuario}', [PuntosController::class, 'ajustar'])->name('ajustar');
});

Route::get('centros-acopio-mapa-data', [CentroAcopioController::class, 'mapaData'])
    ->name('centros-acopio.mapa-data');

// Recursos
Route::resource('users', UserController::class);
Route::resource('residuos', ResiduoController::class);
Route::resource('empresas-aliadas', EmpresaAliadaController::class);
Route::resource('centros-acopio', CentroAcopioController::class);

//  IMPORTANTE No borrar esta línea de Breeze 
require __DIR__.'/auth.php';   
