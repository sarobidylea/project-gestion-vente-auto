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
        Schema::create('achats', function (Blueprint $table) {
            $table->id();

            // Client ayant effectué l'achat
            $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnDelete();

            // Véhicule acheté
            $table->foreignId('vehicule_id')
                ->constrained('vehicules')
                ->cascadeOnDelete();

            // Prix du véhicule au moment de l'achat
            $table->decimal('prix', 12, 2);

            // Date et heure de l'achat
            $table->dateTime('date_achat');

            // Mode de paiement
            $table->enum('mode_paiement', [
                'carte',
                'mobile_money',
                'livraison'
            ]);

            // Statut de l'achat
            $table->enum('statut', [
                'pending',
                'paid',
                'cancelled'
            ])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achats');
    }
};