<?php

namespace App\Http\Controllers;

use App\Models\Calendario;
use App\Models\EstadisticaEquipo;
use App\Models\EstadisticaJugador;
use App\Models\Sancion;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticaEquipoController extends Controller
{

    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $estadisticas = EstadisticaEquipo::with('calendario')->get();
        $estadistica = EstadisticaJugador::with('calendario')->get();
        $estadisticaJ = $estadistica->combine(EstadisticaJugador::with('jugador')->get());
        $estadisticasJd = $estadisticaJ->combine(EstadisticaJugador::with('sanciones')->get());
        return view('estadisticas.index', compact('estadisticas', 'texto', 'estadisticasJd')); 
    }

    
    public function create()
    {
      $select = false;
        $calenda = Calendario::with('local')
            ->get();

        $calendarios = $calenda->combine(Calendario::with('visitante')->get()
            );

        $estadisticaEq = new EstadisticaEquipo();
        $estadisticaJd = new EstadisticaJugador();
        $users = User::all();
        $sanciones = Sancion::all();
        return view('estadisticas.create', compact('select','estadisticaEq', 'calendarios', 'estadisticaJd', 'users', 'sanciones'));
    }

    
    public function store(Request $request)
    {
        $validate = $request->all();
        EstadisticaEquipo::create($validate);        
        return redirect()->route('estadistica-equipo.create');
    }
    
    public function select(Calendario $calendario)
    {        
        $calenda = Calendario::with('local')
            ->get();

        $calendarios = $calenda->combine(Calendario::with('visitante')
            ->get());
        $select = True;
        $estadisticaEq = new EstadisticaEquipo();
        $estadisticaJd = new EstadisticaJugador();
        $users = User::all();
        $sanciones = Sancion::all();
       return view('estadisticas.create', compact('select', 'calendario', 'calendarios', 'users', 'sanciones', 'estadisticaEq', 'estadisticaJd'));
    }

    public function show(EstadisticaEquipo $estadistica)
    {
        //
    }

   
    public function edit(EstadisticaEquipo $estadistica)
    {
        return view('estadisticas.create', compact('estadistica'));        
    }

    
    public function update(Request $request, EstadisticaEquipo $estadistica)
    {
        $estadistica->fill($request->all());
        $estadistica->save();    
        return redirect()->route('estadistica-equipo.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Equipo Updated Sucessfully']);
    }

    
    public function destroy(EstadisticaEquipo $estadistica)
    {
        try {
            $estadistica->delete();
            $result = ['status'=>'Success', 'color' => 'green','message'=>'Result Deleted Sucessfully'];
        } catch(Exception $e) {
            $result = ['status'=>'Success', 'color' => 'red','message'=>'Result cannot be delete'];
        } 
        return redirect()->route('estadistica-equipo.index')->with($result);
    }
}
