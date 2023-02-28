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
    
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $calendarios = DB::table('calendarios')
            ->select('id','fecha_partido', 'local_id', 'visitante_id', 'torneo_id')
            ->where('fecha_partido', 'LIKE', '%'.$texto.'%')
            ->orderBy('fecha_partido', 'asc')
            ->paginate(10);
        return view('calendarios.index', compact('calendarios', 'texto')); 
    }

    
    public function create(Torneo $torneo)
    {
        $calendario = new Calendario();
        $equipos = Equipo::all();
        return view('calendarios.create', compact('calendario', 'equipos', 'torneo'));
    }

    
    public function store(CalendarioStoreRequest $request, Torneo $torneo)
    {
        $validatedData = $request->validated();
        Calendario::create($validatedData);
        return redirect()->route('calendario.create', ['torneo' => $torneo['id']])->with(['status' => 'Success', 'color' => 'green', 'message' => 'Fecha add successfully']);
    }

    
    public function show(Calendario $calendario)
    {
        //
    }

   
    public function edit(Calendario $calendario)
    {
        return view('calendarios.create', compact('calendario'));        
    }

    
    public function update(Request $request, Calendario $calendario)
    {
        $calendario->fill($request->validate());
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