<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propriete extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'nb_chambres',
        'nb_salles_de_bain',
        'etage',
        'surface',
        'prix_jour',
        'frais_agence',
        'description',
    ];

    // Define the many-to-many relationship with Equipement
    public function equipements()
    {
        return $this->belongsToMany(Equipement::class, 'proprietesequipements', 'propriete_id', 'equipement_id');
    }

    // Define the one-to-many relationship with Location
    public function locations()
    {
        return $this->hasMany(Location::class);
    }
}
