<?php

use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\EquipoController;
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
    Route::post('/torneo/calendario/{torneo', [TorneoController::class, 'completeSend'])->name('torneo.complete');
    Route::get('/torneo/add-product/{torneo}/', [InvoceDetailController::class, 'create'])->name('torneo.add_matchs');
});
