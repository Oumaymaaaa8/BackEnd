<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'prenom',
        'cin',
        'passeport',
        'date_delivrance',
        'lieu_delivrance',
    ];

    public function locations()
    {
        return $this->hasMany(Locations::class);
    }
}
