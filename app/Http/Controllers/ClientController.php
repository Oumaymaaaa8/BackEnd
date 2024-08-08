<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\ClientResource; // Correction de l'importation
use App\Models\Client;

class ClientController extends Controller
{
    // Liste des clients
    public function index()
    {
        $clients = Client::all(); // Utilisation de all() au lieu de get() pour obtenir tous les clients

        if ($clients->isEmpty()) {
            return response()->json(['message' => 'No record available'], 200);
        }

        return ClientResource::collection($clients);
    }

    // Création d'un nouveau client
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'cin' => 'nullable|string|max:20', // Nullable pour permettre des valeurs nulles
            'lieu_delivrance' => 'required|string|max:255',
            'passeport' => 'nullable|string|max:255', // Nullable pour permettre des valeurs nulles
            'date_delivrance' => 'required|date',
        ]);

        // Formatage de la date de délivrance
        $date_delivrance = Carbon::createFromFormat('Y-m-d', $validatedData['date_delivrance'])->format('Y-m-d');
        $validatedData['date_delivrance'] = $date_delivrance; // Ajout du formatage au tableau de données validées

        // Création du client
        $client = Client::create($validatedData);

        return response()->json([
            'message' => 'Client créé avec succès', // Correction du message
            'data' => new ClientResource($client) // Utilisation correcte de ClientResource
        ], 200);
    }

    // Afficher un client spécifique
    public function show(Client $client)
    {
        return response()->json([
            'data' => new ClientResource($client) // Utilisation de ClientResource pour formater les données
        ], 200);
    }

    // Mettre à jour un client existant
    public function update(Request $request, Client $client)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'cin' => 'nullable|string|max:20', // Nullable pour permettre des valeurs nulles
            'lieu_delivrance' => 'required|string|max:255',
            'passeport' => 'nullable|string|max:255', // Nullable pour permettre des valeurs nulles
            'date_delivrance' => 'required|date',
        ]);

        // Formatage de la date de délivrance
        $date_delivrance = Carbon::createFromFormat('Y-m-d', $validatedData['date_delivrance'])->format('Y-m-d');
        $validatedData['date_delivrance'] = $date_delivrance; // Ajout du formatage au tableau de données validées

        // Mise à jour du client avec les données validées
        $client->update($validatedData);

        return response()->json([
            'message' => 'Client mis à jour avec succès', // Correction du message
            'data' => new ClientResource($client) // Utilisation correcte de ClientResource
        ], 200);
    }

    // Supprimer un client
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json([
            'message' => 'Client effacé avec succès', // Correction du message
        ], 200);
    }
}
