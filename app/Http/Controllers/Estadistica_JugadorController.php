<?php

namespace App\Http\Controllers;

use App\Http\Requests\Estadistica_JugadorStoreRequest;
use App\Http\Requests\TeamStoreRequest;
use App\Models\EstadisticasJugador;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $estadisticaJugadores = DB::table('estadisticaJugadores')
            ->select('goles', 'remates', 'asistencias','torneo_id','sanciones_id', 'created_at')
            ->where('torneo_id', 'LIKE', '%'.$texto.'%')
            ->orderBy('torneo_id', 'asc')
            ->paginate(10);
        return view('estadisticaJugadores.index', compact('estadisticaJugadores', 'texto')); 
    }

    
    public function create()
    {
        $estadisticaJugadores = new EstadisticasJugador();
        $users = User::all();
       // $plantillas = Plantilla::all();
        return view('estadisticaJugadores.create', compact('estadisticaJugadores', 'users'));
    }

    
    public function store(Estadistica_JugadorStoreRequest $request)
    {
        EstadisticasJugador::create($request->validated());
        return redirect()->route('estadisticaJugadores.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'EstadisticasJugador Registred Sucessfully']);
    }

    
    public function show(EstadisticasJugador $EstadisticasJugador)
    {
        //
    }

   
    public function edit(EstadisticasJugador $EstadisticasJugador)
    {
        return view('estadisticaJugadores.create', compact('EstadisticasJugador'));        
    }

    
    public function update(TeamStoreRequest $request, EstadisticasJugador $EstadisticasJugador)
    {
        $EstadisticasJugador->fill($request->validate());
        $EstadisticasJugador->save();    
        return redirect()->route('estadisticaJugadores.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'EstadisticasJugador Updated Sucessfully']);
    }

    
    public function destroy(EstadisticasJugador $EstadisticasJugador)
    {
        try {
            $EstadisticasJugador->delete();
            $result = ['status'=>'Success', 'color' => 'green','message'=>'EstadisticasJugador Deleted Sucessfully'];
        } catch(Exception $e) {
            $result = ['status'=>'Success', 'color' => 'red','message'=>'EstadisticasJugador cannot be delete'];
        } 
        return redirect()->route('estadisticaJugadores.index')->with($result);
    }
}
