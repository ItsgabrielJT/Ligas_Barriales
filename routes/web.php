<?php

use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\EstadisticaEquipoController;
use App\Http\Controllers\EstadisticaJugadorController;
use App\Http\Controllers\PlantillaController;
use App\Http\Controllers\TorneoController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->get('/dashboard', function (){
    return view('dashboard');
})->name('dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::resource('/equipo', EquipoController::class);
    Route::resource('/plantilla', PlantillaController::class);
    Route::resource('/torneo', TorneoController::class);
    Route::resource('/calendario', CalendarioController::class);
    Route::resource('/estadistica', EstadisticaEquipoController::class)->names('estadistica-equipo');
    Route::post('/torneo/calendario/', [TorneoController::class, 'completeSend'])->name('torneo.complete');
    Route::post('/plantilla/jugador/', [PlantillaController::class, 'completeSend'])->name('plantilla.complete');
});

            
