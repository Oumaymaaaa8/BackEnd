<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Resources\EquipementtResource;
use App\Models\Equipement;

class EquipementController extends Controller
{
    public function index()
    {
        $equipements = Equipement::get();
        if($equipements->count()>0){
            return EquipementtResource::collection($equipements);
        }else{
            return response()->json(['message'=>'No record available'],200);

        }
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'intitule' => 'required|string|max:255',
       
        ]);
        
        $equipement = Equipement::create($validatedData);
        return response()->json([
            'message' => 'équipement créée',
            'data' => new EquipementtResource($equipement)
        ],200);
      
    }
    public function show(Equipement    $equipement){
        return  new EquipementtResource($equipement);
    }
    public function update(Request $request,Equipement $equipement)
    {
        $validatedData = $request->validate([
            'intitule' => 'required|string|max:255',

        ]);
        $equipement  -> update ([
            'intitule' =>  $request->intitule,
            
        ]);
        return response()->json([
            'message' => 'equipement mise ajour',
            'data' => new EquipementtResource($equipement)
        ],200);
    }


     public function destroy(Equipement $equipement){
        $equipement->delete();
     return response()->json([
        'message' => 'equipement éffacé',
        'data' => new EquipementtResource($equipement)
    ],200);
    }
}
