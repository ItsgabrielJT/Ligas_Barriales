<?php

namespace App\Http\Controllers;

use App\Http\Requests\TorneoStoreRequest;
use App\Models\Calendario;
use App\Models\Torneo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TorneoController extends Controller
{
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));                                
        $torneos = DB::table('torneos')
                    ->select('*')
                    ->where('titulo', 'LIKE', '%'.$texto.'%')
                    ->orWhere('estado_torneo', 'LIKE', '%'.$texto.'%')
                    ->paginate(4);
        return view('torneos.index', compact('torneos', 'texto'));
    }
    
    public function create()
    {
        $torneo = new Torneo();
        return view('torneos.create', compact('torneo'));
    }
    
    public function store(TorneoStoreRequest $request)
    {
        $data = $request->all();
        if($request->has('trofeo_image')) {
            $img_path = $request->file('trofeo_image')->store('medias');
            $data['trofeo_image'] = $img_path;
        }
        Torneo::create($data);
        return redirect()->route('calendario.create')
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
        $torneo->fill($request->validated());
        $torneo->save();
        return redirect()->route('calendario.create', ['torneo'=>$torneo])
            ->with(['status'=>'Success', 'color' => 'green', 'message'=>'Torneo update Sucessfully']);
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

    public function completeSend(Request $request) {

        try {           
            $result = ['status' => 'success', 'color' => 'green', 'message' => 'Fechas saved successfully'];
        } catch (\Exception $e) {
            $result = ['status' => 'success', 'color' => 'red', 'message' => $e->getMessage()];
        }

        return redirect()->route('torneo.index')->with($result);
    }
}
