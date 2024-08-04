<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proprietes', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->string("nom"); // Nom de la propriété
            $table->integer("nb_chambres"); // Nombre de chambres
            $table->integer("nb_salles_de_bain"); // Nombre de salles de bain
          
            $table->integer("etage"); // Étage
            $table->decimal("surface"); 
            $table->decimal("prix_jour"); // Prix par jour avec 2 décimales pour plus de précision
            $table->decimal("frais_agence"); // Frais d'agence avec 2 décimales pour plus de précision
            $table->text('description')->nullable(); // Description de la propriété, nullable si non obligatoire
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proprietes');
    }
};
