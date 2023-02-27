<?php

namespace App\Http\Controllers;

use App\Http\Requests\TorneoStoreRequest;
use App\Models\Torneo;
use Exception;
use Illuminate\Http\Request;

class TorneoController extends Controller
{
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));        
        $torneos = Torneo::with('torneos')
        ->select('id', 'titulo', 'trofeo_image', 'estado_torneo','created_at')
        ->where('titulo', 'LIKE','%'.$texto.'%')
        ->orWhere('estado_torneo', 'LIKE', '%'.$texto.'%')
        ->orderBy('id', 'asc')
            ->paginate(3);
        return view('torneos.index', compact('torneos', 'texto'));
    }
    
    public function create()
    {
        $torneo = new Torneo();
        return view('torneos.create', compact('torneo'));
    }
    
    public function store(TorneoStoreRequest $request)
    {
        $Torneo = Torneo::create($request->validated());
        return redirect()->route('Torneo.add_products', ['Torneo'=>$Torneo->id])
            ->with(['status'=>'Success', 'color' => 'green', 'message'=>'Item Added Sucessfully']);
    }
    
    public function show(Torneo $torneo)
    {
        //
    }
    
    public function edit(Torneo $torneo)
    {
        return view('torneos.create', compact('torneo'));
    }
    
    public function update(TorneoStoreRequest $request, Torneo $torneo)
    {
        $torneo->fill($request->validate());
        $torneo->save();
        return redirect()->route('torneo.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Torneo Created Sucessfully']);
    }
    
    public function destroy(Torneo $torneo)
    {
        try {
            $torneo->delete();
            $result = ['status'=>'Success', 'color' => 'green','message'=>'Torneo Deleted Sucessfully'];
        } catch(Exception $e) {
            $result = ['status'=>'Success', 'color' => 'red','message'=>'Torneo cannot be delete'];
        } 
        return redirect()->route('torneo.index')->with($result);
    }

    public function completeSend(Request $request, Torneo $torneo) {
        

        try {           
            $result = ['status' => 'success', 'color' => 'green', 'message' => 'Mail sent successfully'];
        } catch (\Exception $e) {
            $result = ['status' => 'success', 'color' => 'green', 'message' => $e->getMessage()];
        }

        $torneo->estatus = 'complete';
        $torneo->save();

        return redirect()->route('torneo.index')->with($result);
    }
}
