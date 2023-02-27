<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipoStoreRequest;
use App\Models\Equipo;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipoController extends Controller
{
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $equipos = DB::table('equipos')
            ->select('id', 'nombre_equipo', 'user_id', 'created_at')
            ->where('nombre_equipo', 'LIKE', '%'.$texto.'%')
            ->orderBy('nombre_equipo', 'asc')
            ->paginate(10);
        return view('equipos.index', compact('equipos', 'texto')); 
    }

    
    public function create()
    {
        $equipo = new Equipo();
        return view('equipos.create', compact('equipo'));
    }

    
    public function store(EquipoStoreRequest $request)
    {
        Equipo::create($request->validated());
        return redirect()->route('equipo.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Equipo Registred Sucessfully']);
    }

    
    public function show(Equipo $Equipo)
    {
        //
    }

   
    public function edit(Equipo $equipo)
    {
        return view('equipos.create', compact('equipo'));        
    }

    
    public function update(EquipoStoreRequest $request, Equipo $equipo)
    {
        $equipo->fill($request->validate());
        $equipo->save();    
        return redirect()->route('equipo.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Equipo Updated Sucessfully']);
    }

    
    public function destroy(Equipo $Equipo)
    {
        try {
            $Equipo->delete();
            $result = ['status'=>'Success', 'color' => 'green','message'=>'Equipo Deleted Sucessfully'];
        } catch(Exception $e) {
            $result = ['status'=>'Success', 'color' => 'red','message'=>'Equipo cannot be delete'];
        } 
        return redirect()->route('equipo.index')->with($result);
    }
}
