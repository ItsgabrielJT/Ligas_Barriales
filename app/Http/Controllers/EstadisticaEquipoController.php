<?php

namespace App\Http\Controllers;

use App\Models\EstadisticaEquipo;
use App\Models\EstadisticaJugador;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticaEquipoController extends Controller
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
        $estadistica = new EstadisticaEquipo();
        return view('estadisticas.create', compact('estadistica'));
    }

    
    public function store(Request $request)
    {
        $validate = $request->all();
        EstadisticaEquipo::create($validate);
        return redirect()->route('estadistica-equipo.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Equipo Registred Sucessfully']);
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
