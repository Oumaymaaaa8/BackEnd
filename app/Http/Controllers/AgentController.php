<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Resources\AgentResource;
use App\Models\Agent;
use Illuminate\Support\Facades\Validator;
class AgentController extends Controller
{
    public function index()
    {
        $agents = Agent::get();
        if($agents->count()>0){
            return AgentResource::collection($agents);
        }else{
            return response()->json(['message'=>'No record available'],200);

        }
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
        
        $propriete = Agent::create($validatedData);
        return response()->json([
            'message' => 'location créée',
            'data' => new AgentResource($propriete)
        ],200);
      
    }
    
    public function show(Agent   $agent){
        return  new AgentResource($agent);
    }

    public function update(Request $request,Agent $agent)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
        $agent  -> update ([
            'nom' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
        return response()->json([
            'message' => 'infos mises ajour',
            'data' => new AgentResource( $agent)
        ],200);
    }


     public function destroy(Agent   $agent){
          $agent->delete();
     return response()->json([
        'message' => '  agent éffacé',
        'data' => new AgentResource(  $agent)
    ],200);
    }
}
