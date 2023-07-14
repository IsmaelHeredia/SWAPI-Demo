<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\APIController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ruta principal

Route::get('/', [HomeController::class, 'index'])->name('home');

// Ruta para los API

Route::get('/api/importarDatos', [APIController::class, 'importarDatos'])->name('importarDatos');

Route::get('/api/cargarNaves', [APIController::class, 'cargarNaves'])->name('cargarNaves');
Route::get('/api/cargarVehiculos', [APIController::class, 'cargarVehiculos'])->name('cargarVehiculos');

Route::post('/api/setearCantidadNave', [APIController::class, 'setearCantidadNave'])->name('setearCantidadNave');
Route::post('/api/aumentarCantidadNave', [APIController::class, 'aumentarCantidadNave'])->name('aumentarCantidadNave');
Route::post('/api/disminuirCantidadNave', [APIController::class, 'disminuirCantidadNave'])->name('disminuirCantidadNave');

Route::post('/api/setearCantidadVehiculo', [APIController::class, 'setearCantidadVehiculo'])->name('setearCantidadVehiculo');
Route::post('/api/aumentarCantidadVehiculo', [APIController::class, 'aumentarCantidadVehiculo'])->name('aumentarCantidadVehiculo');
Route::post('/api/disminuirCantidadVehiculo', [APIController::class, 'disminuirCantidadVehiculo'])->name('disminuirCantidadVehiculo');