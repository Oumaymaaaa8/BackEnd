<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipementPropriete extends Model
{
    use HasFactory;

    protected $table = 'proprietesequipements';

    protected $fillable = ['equipement_id', 'propriete_id'];
}
