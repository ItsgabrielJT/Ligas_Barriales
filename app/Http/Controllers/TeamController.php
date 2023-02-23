<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamStoreRequest;
use App\Models\Plantilla;
use App\Models\Team;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    
    public function index(Request $request)
    {
        $texto = trim($request->get('texto'));
        $teams = DB::table('teams')
            ->select('id', 'nombre_equipo', 'user_id', 'created_at')
            ->where('nombre_equipo', 'LIKE', '%'.$texto.'%')
            ->orderBy('nombre_equipo', 'asc')
            ->paginate(10);
        return view('teams.index', compact('teams', 'texto')); 
    }

    
    public function create()
    {
        $teams = new Team();
        $users = User::all();
       // $plantillas = Plantilla::all();
        return view('teams.create', compact('teams', 'users'));
    }

    
    public function store(TeamStoreRequest $request)
    {
        Team::create($request->validated());
        return redirect()->route('teams.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Team Registred Sucessfully']);
    }

    
    public function show(Team $team)
    {
        //
    }

   
    public function edit(Team $team)
    {
        return view('teams.create', compact('team'));        
    }

    
    public function update(TeamStoreRequest $request, Team $team)
    {
        $team->fill($request->validate());
        $team->save();    
        return redirect()->route('teams.index')->with(['status'=>'Success', 'color' => 'green', 'message'=>'Team Updated Sucessfully']);
    }

    
    public function destroy(Team $team)
    {
        try {
            $team->delete();
            $result = ['status'=>'Success', 'color' => 'green','message'=>'Team Deleted Sucessfully'];
        } catch(Exception $e) {
            $result = ['status'=>'Success', 'color' => 'red','message'=>'Team cannot be delete'];
        } 
        return redirect()->route('teams.index')->with($result);
    }
}
