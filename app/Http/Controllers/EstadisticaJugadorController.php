<?php

namespace App\Http\Controllers;

use App\Models\Calendario;
use App\Models\EstadisticaEquipo;
use App\Models\EstadisticaJugador;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticaJugadorController extends Controller
{
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $estadisticas = DB::table('estadistica_equipos')
            ->select('id', 'total_disparos','asisitencias','faltas','tiros_esquina','pases','tiros_fallidos','calendario_id','created_at')
            ->where('calendario_id', 'LIKE', '%'.$texto.'%')
            ->orderBy('calendario_id', 'asc')
            ->paginate(10);
        return view('estadisticas.index', compact('estadisticas', 'texto')); 
    }

    
    public function create()
    {
        $calenda = Calendario::with('local')
            ->get();

        $calendarios = $calenda->combine(Calendario::with('visitante')
            ->get());

        $estadisticaEq = new EstadisticaEquipo();
        $estadisticaJd = new EstadisticaJugador();
        return view('estadisticas.create', compact('estadisticaEq', 'calendarios', 'estadisticaJd', 'users'));
    }

    
    public function store(Request $request)
    {
        $validate = $request->all();
        EstadisticaJugador::create($validate);
        return redirect()->route('estadistica-equipo.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Results Registred Sucessfully']);
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

    
    public function destroy(EstadisticaEquipo $Equipo)
    {
        try {
            $Equipo->delete();
            $result = ['status'=>'Success', 'color' => 'green','message'=>'Equipo Deleted Sucessfully'];
        } catch(Exception $e) {
            $result = ['status'=>'Success', 'color' => 'red','message'=>'Equipo cannot be delete'];
        } 
        return redirect()->route('estadistica-equipo.index')->with($result);
    }
    
}
