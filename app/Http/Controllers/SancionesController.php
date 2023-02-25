<?php

namespace App\Http\Controllers;

use App\Http\Requests\SancionesStoreRequest;
use App\Models\Sanciones;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $sanciones = DB::table('sanciones')
            ->select('tipo', 'created_at')
            ->where('tipo', 'LIKE', '%'.$texto.'%')
            ->orderBy('tipo', 'asc')
            ->paginate(10);
        return view('sanciones.index', compact('sanciones', 'texto')); 
    }

    
    public function create()
    {
        $sanciones = new Sanciones();
        $users = User::all();
       // $plantillas = Sanciones::all();
        return view('sanciones.create', compact('sanciones', 'users'));
    }

    
    public function store(SancionesStoreRequest $request)
    {
        Sanciones::create($request->validated());
        return redirect()->route('sanciones.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Sanciones Registred Sucessfully']);
    }

    
    public function show(Sanciones $sanciones)
    {
        //
    }

   
    public function edit(Sanciones $sanciones)
    {
        return view('sanciones.create', compact('sanciones'));        
    }

    
    public function update(SancionesStoreRequest $request, Sanciones $sanciones)
    {
        $sanciones->fill($request->validate());
        $sanciones->save();    
        return redirect()->route('sanciones.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Sanciones Updated Sucessfully']);
    }

    
    public function destroy(Sanciones $sanciones)
    {
        try {
            $sanciones->delete();
            $result = ['status'=>'Success', 'color' => 'green','message'=>'Sanciones Deleted Sucessfully'];
        } catch(Exception $e) {
            $result = ['status'=>'Success', 'color' => 'red','message'=>'Sanciones cannot be delete'];
        } 
        return redirect()->route('sanciones.index')->with($result);
    }
}
