<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;

    protected $fillable = ['intitule'];

    // Define the many-to-many relationship with Propriete
    public function proprietes()
    {
        return $this->belongsToMany(Propriete::class, 'proprietesequipements', 'equipement_id', 'propriete_id');
    }
}
