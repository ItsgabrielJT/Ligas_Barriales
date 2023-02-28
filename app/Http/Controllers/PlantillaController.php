<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlantillaStoreRequest;
use App\Models\Equipo;
use App\Models\Plantilla;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlantillaController extends Controller
{
    
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $plantilla = DB::table('plantillas')
            ->select('id', 'jugador_id', 'equipo_id','created_at')
            ->where('jugador_id', 'LIKE', '%'.$texto.'%')
            ->orderBy('jugador_id', 'asc')
            ->paginate(10);
        return view('plantillas.index', compact('plantilla', 'texto')); 
    }

    
    public function create(User $user)
    {
        $plantilla = new Plantilla();
        $users = User::all();
        $equipo = DB::table('equipos')->where('user_id', 1 )->get();
        return view('plantillas.create', compact('plantilla', 'users', 'equipo'));
    }

    
    public function store(PlantillaStoreRequest $request)
    {
        Plantilla::create($request->validated());
        return redirect()->route('plantilla.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Jugador Registred Sucessfully']);
    }

    
    public function show(Plantilla $plantilla)
    {
        //
    }

   
    public function edit(Plantilla $plantilla)
    {
        $users = User::all();
        return view('plantillas.create', compact('plantilla', 'users'));        
    }

    
    public function update(PlantillaStoreRequest $request, Plantilla $plantilla)
    {
        $plantilla->fill($request->validated());
        $plantilla->save();    
        return redirect()->route('plantilla.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Jugador Updated Sucessfully']);
    }

    
    public function destroy(Plantilla $plantilla)
    {
        try {
            $plantilla->delete();
            $result = ['status'=>'Success', 'color' => 'green','message'=>'Jugador Deleted Sucessfully'];
        } catch(Exception $e) {
            $result = ['status'=>'Success', 'color' => 'red','message'=>'Jugador cannot be delete'];
        } 
        return redirect()->route('plantilla.index')->with($result);
    }

    public function complete(Request $request) {
        

        return redirect()->route('plantilla.index');
    }
}