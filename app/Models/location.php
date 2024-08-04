<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    use HasFactory;
    protected $fillable = [
        'statut', 
        'date_debut', 
        'date_fin', 
        'taux_remise', 
        'avance', 
        'description', 
        'client_id', 
        'propriete_id', 
        'agent_id'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relation avec la propriété
    public function propriete()
    {
        return $this->belongsTo(Propriete::class);
    }

    // Relation avec le modèle Agent
    public function agent()
    {
        return $this->belongsTo(Agent::class); // Utilisez le bon nom de relation
    }
}
