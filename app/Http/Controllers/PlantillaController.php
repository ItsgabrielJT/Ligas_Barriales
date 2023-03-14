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
        
        $plantilla = Plantilla::join("users","users.id", "=", "plantillas.jugador_id")
                ->select('*')
                ->where('users.name', 'LIKE', '%'.$texto.'%')
                ->orWhere('users.email', 'LIKE', '%'.$texto.'%')
                ->paginate(6);
            
        return view('plantillas.index', compact('plantilla', 'texto')); 
    }

    
    public function create()
    {
        $plantillas = Plantilla::with('user')
            ->get();

        $plantilla = new Plantilla();
        $users = User::all();
        $equipo = Equipo::all();
        return view('plantillas.create', compact('plantilla', 'plantillas','users', 'equipo'));
    }

    
    public function store(PlantillaStoreRequest $request)
    {
        Plantilla::create($request->validated());
        return redirect()->route('plantilla.create')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Jugador Registred Sucessfully']);
    }

    
    public function show(Plantilla $plantilla)
    {
        //
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

    public function completeSend(Request $request) {

        try {           
            $result = ['status' => 'success', 'color' => 'green', 'message' => 'Players add successfully'];
        } catch (\Exception $e) {
            $result = ['status' => 'success', 'color' => 'red', 'message' => $e->getMessage()];
        }

        return redirect()->route('plantilla.index')->with($result);
    }
}
