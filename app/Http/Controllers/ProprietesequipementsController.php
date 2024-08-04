<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Resources\ProprieteEquipementResource;
use App\Models\proprietesequipements;
class ProprietesequipementsController extends Controller
{
    public function index()
    {
        $proprietesequipements = proprietesequipements::get();
        if($proprietesequipements->count()>0){
            return ProprieteEquipementResource::collection($proprietesequipements);
        }else{
            return response()->json(['message'=>'No record available'],200);

        }
    }

   
    public function store(Request $request)
    {
            

    $data = $request->all();
    
    foreach ($data as $item) {
        EquipementPropriete::create($item);
    }
    
    return response()->json(['message' => 'Équipements associés avec succès']);


    }
    public function show(proprietesequipements    $proprietesequipement){
        return  new ProprieteEquipementResource($proprietesequipement);
    }
   

     public function destroy(proprietesequipements $proprietesequipement){
        $proprietesequipement->delete();
     return response()->json([
        'message' => 'equipement éffacé',
        'data' => new ProprieteEquipementResource($proprietesequipement)
    ],200);
    }
}
