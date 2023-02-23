<?php

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
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
Route::get('/equipos', function () {
    return view('equipos');
})->name('equipos');

Route::get('/calendarios', function () {
    return view('calendarios');
})->name('calendarios');

Route::get('/torneos', function () {
    return view('torneos');
})->name('torneos');

Route::get('/resultados', function () {
    return view('resultados');
})->name('resultados');
    
Route::get('/jugadores', function () {
    return view('jugadores');
})->name('jugadores');
});

