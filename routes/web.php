<?php

use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\EstadisticaEquipoController;
use App\Http\Controllers\EstadisticaJugadorController;
use App\Http\Controllers\PlantillaController;
use App\Http\Controllers\TorneoController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


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
    Route::post('/torneo/calendario/{torneo}', [TorneoController::class, 'completeSend'])->name('torneo.complete');
});

 
Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();

    $userExists = User::where ('external_id', $user->id)->where ('external_auth','google')->first();

    if($userExists) {
        Auth::login($userExists);
    } else {
        $userNew = User::create([
            'name' => $user->name,
            'email' => $user -> email,
            'avatar' => $user ->avatar,
            'external_id' => $user -> id,
            'external_auth' => 'google',
        ]);
        Auth::login($userNew);
    }

    return redirect('dashbord');
 
});