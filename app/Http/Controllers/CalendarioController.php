<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalendarioStoreRequest;
use App\Models\Calendario;
use App\Models\Equipo;
use App\Models\Torneo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarioController extends Controller
{
    
    public function index(Request $request, Torneo $torneo)
    {
        $texto = trim($request->get('texto'));
        $calen = DB::table('calendarios')
            ->select('id','fecha_partido', 'local_id', 'visitante_id', 'torneo_id')
            ->where('fecha_partido', 'LIKE', '%'.$texto.'%')
            ->orderBy('fecha_partido', 'asc')
            ->paginate(10);
        $calenda = Calendario::with('local')
            ->where('local_id', 'LIKE', '%'.$texto.'%')
            ->get();

        $calendarios = $calenda->combine(Calendario::with('visitante')
            ->where('visitante_id', 'LIKE', '%'.$texto.'%')
            ->get());

        return view('calendarios.index', compact('calendarios', 'texto', 'torneo')); 
    }

    
    public function create()
    {
        $calenda = Calendario::with('local')
            ->get();

        $calendarios = $calenda->combine(Calendario::with('visitante')
            ->get());

        $calendario = new Calendario();
        $equipos = Equipo::all();
        $torneos = Torneo::all();
        return view('calendarios.create', compact('calendario', 'equipos', 'torneos', 'calendarios'));
    }

    
    public function store(Request $request)
    { 
        (new Calendario($request->input()))->saveOrFail();
        return redirect()->route('calendario.create')->with(['status' => 'Success', 'color' => 'green', 'message' => 'Fecha add successfully']);
    }

    
    public function show(Calendario $calendario)
    {
        //
    }

   
    public function edit(Calendario $calendario)
    {        
        $torneos = Torneo::all();
        $equipos = Equipo::all();
        return view('calendarios.edit', compact('calendario', 'torneos', 'equipos'));        
    }

    
    public function update(Request $request, Calendario $calendario)
    {
        $calendario->fill($request->all());
        $calendario->save();    
        return redirect()->route('calendario.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Calendario Updated Sucessfully']);
    }

    
    public function destroy(Calendario $calendario)
    {
        try {
            $calendario->delete();
            $result = ['status'=>'Success', 'color' => 'green','message'=>'Calendario Deleted Sucessfully'];
        } catch(Exception $e) {
            $result = ['status'=>'Success', 'color' => 'red','message'=>'Calendario cannot be delete'];
        } 
        return redirect()->route('calendario.index')->with($result);
    }
}
