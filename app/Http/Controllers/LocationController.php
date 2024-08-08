<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\http\Resources\LocationResource;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {             
        $locations = Location::with(['client', 'user', 'propriete'])->get();

        if($locations->count()>0){
            return LocationResource::collection($locations);
        }else{
            return response()->json(['message'=>'No record available'],200);

        }
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'statut' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'taux_remise' => 'nullable|numeric|min:0',
            'avance' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
            'propriete_id' => 'required|exists:proprietes,id',
            'user_id' => 'required|exists:users,id',
        ]);
        
        $propriete = Location::create($validatedData);
        return response()->json([
            'message' => 'location créée',
            'data' => new LocationResource($propriete)
        ],200);
      
    }
    
    public function show(Location $location)
    {
        $location = Location::with(['client', 'propriete'])->find($location->id);
    
        if (!$location) {
            return response()->json(['message' => 'Location not found'], 404);
        }
    
        return response()->json([
            'data' => $location
        ], 200);
    }
    
    public function update(Request $request,Location $location)
    {
        $validatedData = $request->validate([
            'statut' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'taux_remise' => 'nullable|numeric|min:0',
            'avance' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'client_id' => 'required|exists:clients,id',
            'propriete_id' => 'required|exists:proprietes,id',
            'user_id' => 'required|exists:users,id',
        ]);
        $location  -> update ([
            'statut' => $request->statut,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'taux_remise' => $request->taux_remise,
            'avance' =>$request->avance,
            'description' => $request->description,
            'client_id' =>$request->client_id,
            'propriete_id' =>$request->propriete_id,
            'user_id' => $request->user_id,

        ]);
        return response()->json([
            'message' => 'location mise ajour',
            'data' => new LocationResource($location)
        ],200);
    }


     public function destroy(Location $location){
        $location->delete();
     return response()->json([
        'message' => 'location éffacée',
        'data' => new LocationResource($location)
    ],200);
    }
}
