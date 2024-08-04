<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProprieteResource;
use App\Models\Propriete;
use App\Models\Equipement;

class ProprieteController extends Controller
{
    public function index()
    {
        $proprietes = Propriete::with('equipements')->get(); // Charger les équipements associés
        if ($proprietes->count() > 0) {
            return ProprieteResource::collection($proprietes);
        } else {
            return response()->json(['message' => 'No record available'], 200);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'nb_chambres' => 'required|integer|min:0',
            'nb_salles_de_bain' => 'required|integer|min:0',
            'etage' => 'required|numeric|min:0',
            'surface' => 'required|numeric|min:0',
            'prix_jour' => 'required|numeric|min:0',
            'frais_agence' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'equipements' => 'array', // Valider le tableau des équipements
            'equipements.*' => 'exists:equipements,id', // Vérifier que l'équipement existe
        ]);

        // Créez la propriété
        $propriete = Propriete::create($validatedData);

        // Associez les équipements à la propriété
        if ($request->has('equipements')) {
            $propriete->equipements()->attach($request->input('equipements'));
        }

        return response()->json([
            'message' => 'Propriété créée',
            'data' => new ProprieteResource($propriete->load('equipements')), // Charger les équipements pour la réponse
        ], 201);
    }

    public function show(Propriete $propriete)
    {
        $propriete->load('equipements');

        return response()->json([
            'data' => new ProprieteResource($propriete),
        ], 200);
    }

    public function update(Request $request, Propriete $propriete)
    {
        $validatedData = $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'nb_chambres' => 'sometimes|required|integer|min:0',
            'nb_salles_de_bain' => 'sometimes|required|integer|min:0',
            'etage' => 'sometimes|required|numeric|min:0',
            'surface' => 'sometimes|required|numeric|min:0',
            'prix_jour' => 'sometimes|required|numeric|min:0',
            'frais_agence' => 'sometimes|required|numeric|min:0',
            'description' => 'nullable|string',
            'equipements' => 'array',
            'equipements.*' => 'exists:equipements,id',
        ]);

        $propriete->update($validatedData);

        // Mettre à jour les équipements
        if ($request->has('equipements')) {
            $propriete->equipements()->sync($request->input('equipements')); // Synchroniser les équipements
        }

        return response()->json([
            'message' => 'Propriété mise à jour',
            'data' => new ProprieteResource($propriete->load('equipements')),
        ], 200);
    }

    public function destroy(Propriete $propriete)
    {
        $propriete->equipements()->detach(); // Supprimer les associations d'équipements
        $propriete->delete();

        return response()->json([
            'message' => 'Propriété effacée',
            'data' => new ProprieteResource($propriete),
        ], 200);
    }
}
