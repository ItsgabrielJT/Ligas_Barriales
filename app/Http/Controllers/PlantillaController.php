<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlantillaStoreRequest;
use App\Models\Plantilla;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $plantilla = DB::table('plantilla')
            ->select('user_id', 'created_at')
            ->where('user_id', 'LIKE', '%'.$texto.'%')
            ->orderBy('user_id', 'asc')
            ->paginate(10);
        return view('plantilla.index', compact('plantilla', 'texto')); 
    }

    
    public function create()
    {
        $plantilla = new Plantilla();
        $users = User::all();
       // $plantillas = Plantilla::all();
        return view('plantilla.create', compact('plantilla', 'users'));
    }

    
    public function store(PlantillaStoreRequest $request)
    {
        Plantilla::create($request->validated());
        return redirect()->route('plantilla.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Plantilla Registred Sucessfully']);
    }

    
    public function show(Plantilla $plantilla)
    {
        //
    }

   
    public function edit(Plantilla $plantilla)
    {
        return view('plantilla.create', compact('plantilla'));        
    }

    
    public function update(PlantillaStoreRequest $request, Plantilla $plantilla)
    {
        $plantilla->fill($request->validate());
        $plantilla->save();    
        return redirect()->route('plantilla.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Plantilla Updated Sucessfully']);
    }

    
    public function destroy(Plantilla $plantilla)
    {
        try {
            $plantilla->delete();
            $result = ['status'=>'Success', 'color' => 'green','message'=>'Plantilla Deleted Sucessfully'];
        } catch(Exception $e) {
            $result = ['status'=>'Success', 'color' => 'red','message'=>'Plantilla cannot be delete'];
        } 
        return redirect()->route('plantilla.index')->with($result);
    }
}
