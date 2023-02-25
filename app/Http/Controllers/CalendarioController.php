<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalendarioStoreRequest;
use App\Models\Calendario;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $Calendario = DB::table('Calendario')
            ->select('fecha_partido', 'equipo_id_local', 'equipo_id_visitante', 'created_at')
            ->where('fecha_partido', 'LIKE', '%'.$texto.'%')
            ->orderBy('fecha_partido', 'asc')
            ->paginate(10);
        return view('Calendario.index', compact('Calendario', 'texto')); 
    }

    
    public function create()
    {
        $Calendario = new Calendario();
        $users = User::all();
       // $plantillas = Plantilla::all();
        return view('Calendario.create', compact('Calendario', 'users'));
    }

    
    public function store(CalendarioStoreRequest $request)
    {
        Calendario::create($request->validated());
        return redirect()->route('Calendario.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Calendario Registred Sucessfully']);
    }

    
    public function show(Calendario $calendario)
    {
        //
    }

   
    public function edit(Calendario $calendario)
    {
        return view('Calendario.create', compact('calendario'));        
    }

    
    public function update(CalendarioStoreRequest $request, Calendario $calendario)
    {
        $calendario->fill($request->validate());
        $calendario->save();    
        return redirect()->route('Calendario.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Calendario Updated Sucessfully']);
    }

    
    public function destroy(Calendario $calendario)
    {
        try {
            $calendario->delete();
            $result = ['status'=>'Success', 'color' => 'green','message'=>'Calendario Deleted Sucessfully'];
        } catch(Exception $e) {
            $result = ['status'=>'Success', 'color' => 'red','message'=>'Calendario cannot be delete'];
        } 
        return redirect()->route('Calendario.index')->with($result);
    }
}
