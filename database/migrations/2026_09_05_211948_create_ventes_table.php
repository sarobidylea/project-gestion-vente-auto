<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vehicule_id')
                  ->constrained('vehicules')
                  ->cascadeOnDelete();

            $table->foreignId('client_id')
                  ->constrained('clients')
                  ->cascadeOnDelete();

            $table->date('date_vente');
            $table->decimal('prix_vente', 12, 2);

            $table->enum('mode_paiement', [
                'Especes',
                'Carte',
                'Virement',
                'Credit'
            ]);

            $table->enum('statut', [
                'En attente',
                'Confirmee',
                'Annulee'
            ])->default('Confirmee');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};