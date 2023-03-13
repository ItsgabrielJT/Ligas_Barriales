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
        
    public function store(Request $request)
    {
        $validate = $request->all();
        EstadisticaJugador::create($validate);
        return redirect()->route('estadistica-equipo.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Results from player Registred Sucessfully']);
    }

    
    public function show(EstadisticaEquipo $estadistica)
    {
        //
    }

   
    public function edit(EstadisticaJugador $jugador)
    {
        return view('estadisticas.create', compact('jugador'));        
    }

    
    public function update(Request $request, EstadisticaJugador $estadistica)
    {
        $estadistica->fill($request->all());
        $estadistica->save();    
        return redirect()->route('estadistica-equipo.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Result from player Updated Sucessfully']);
    }

    
    public function destroy(EstadisticaJugador $jugador)
    {
        try {
            $jugador->delete();
            $result = ['status'=>'Success', 'color' => 'green','message'=>'Result from player Deleted Sucessfully'];
        } catch(Exception $e) {
            $result = ['status'=>'Success', 'color' => 'red','message'=>'Resultfrom player cannot be delete'];
        } 
        return redirect()->route('estadistica-equipo.index')->with($result);
    }
    
}
