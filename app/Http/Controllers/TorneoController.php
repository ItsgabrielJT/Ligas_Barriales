<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamStoreRequest;
use App\Http\Requests\TorneoStoreRequest;
use App\Models\Plantilla;
use App\Models\Torneos;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $torneos = DB::table('torneos')
            ->select('titulo', 'descripcion', 'estado_torneo', 'created_at')
            ->where('titulo', 'LIKE', '%'.$texto.'%')
            ->orderBy('titulo', 'asc')
            ->paginate(10);
        return view('torneos.index', compact('torneos', 'texto')); 
    }

    
    public function create()
    {
        $torneos = new Torneos();
        $users = User::all();
       // $plantillas = Plantilla::all();
        return view('torneos.create', compact('torneos', 'users'));
    }

    
    public function store(TorneoStoreRequest $request)
    {
        Torneos::create($request->validated());
        return redirect()->route('torneos.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Torneos Registred Sucessfully']);
    }

    
    public function show(Torneos $torneos)
    {
        //
    }

   
    public function edit(Torneos $torneos)
    {
        return view('torneos.create', compact('torneos'));        
    }

    
    public function update(TorneoStoreRequest $request, Torneos $team)
    {
        $team->fill($request->validate());
        $team->save();    
        return redirect()->route('torneos.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Torneos Updated Sucessfully']);
    }

    
    public function destroy(Torneos $team)
    {
        try {
            $team->delete();
            $result = ['status'=>'Success', 'color' => 'green','message'=>'Torneos Deleted Sucessfully'];
        } catch(Exception $e) {
            $result = ['status'=>'Success', 'color' => 'red','message'=>'Torneos cannot be delete'];
        } 
        return redirect()->route('torneos.index')->with($result);
    }
}
