<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalendarioStoreRequest;
use App\Http\Requests\Estadistica_EquiStoreRequest;
use App\Models\EstadisticasEquipo;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $EstadisticasEquipo = DB::table('EstadisticasEquipo')
            ->select('total_disparos', 'asisitencias', 'faltas','tiros_esquina','pases','tiros_fallidos','torneo_id', 'created_at')
            ->where('total_disparos', 'LIKE', '%'.$texto.'%')
            ->orderBy('total_disparos', 'asc')
            ->paginate(10);
        return view('EstadisticasEquipo.index', compact('EstadisticasEquipo', 'texto')); 
    }

    
    public function create()
    {
        $EstadisticasEquipo = new EstadisticasEquipo();
        $users = User::all();
       // $plantillas = Plantilla::all();
        return view('EstadisticasEquipo.create', compact('EstadisticasEquipo', 'users'));
    }

    
    public function store(Estadistica_EquiStoreRequest $request)
    {
        EstadisticasEquipo::create($request->validated());
        return redirect()->route('EstadisticasEquipo.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'EstadisticasEquipo Registred Sucessfully']);
    }

    
    public function show(EstadisticasEquipo $EstadisticasEquipo)
    {
        //
    }

   
    public function edit(EstadisticasEquipo $EstadisticasEquipo)
    {
        return view('EstadisticasEquipo.create', compact('EstadisticasEquipo'));        
    }

    
    public function update(CalendarioStoreRequest $request, EstadisticasEquipo $EstadisticasEquipo)
    {
        $EstadisticasEquipo->fill($request->validate());
        $EstadisticasEquipo->save();    
        return redirect()->route('EstadisticasEquipo.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'EstadisticasEquipo Updated Sucessfully']);
    }

    
    public function destroy(EstadisticasEquipo $EstadisticasEquipo)
    {
        try {
            $EstadisticasEquipo->delete();
            $result = ['status'=>'Success', 'color' => 'green','message'=>'EstadisticasEquipo Deleted Sucessfully'];
        } catch(Exception $e) {
            $result = ['status'=>'Success', 'color' => 'red','message'=>'EstadisticasEquipo cannot be delete'];
        } 
        return redirect()->route('EstadisticasEquipo.index')->with($result);
    }
}
