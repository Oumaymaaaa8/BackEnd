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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('statut'); // Statut de la location (par ex. "en cours", "terminée")
            $table->date('date_debut'); // Date de début de la location
            $table->date('date_fin'); // Date de fin de la location
            $table->decimal('taux_remise', 5, 2); // Taux de remise (5 chiffres au total, 2 après la virgule)
            $table->decimal('avance'); // Avance en monnaie (10 chiffres au total, 2 après la virgule)
            $table->text('description')->nullable(); // Description de la location, nullable si non obligatoire
            $table->timestamps(); // Colonnes created_at et updated_at
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('propriete_id')->constrained('proprietes')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
