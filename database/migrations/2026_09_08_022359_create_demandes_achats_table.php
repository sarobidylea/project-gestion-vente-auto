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
        Schema::create('demandes_achats', function (Blueprint $table) {
            $table->id();

            // Client qui effectue la demande
            $table->foreignId('client_id')
                ->constrained('clients')
                ->onDelete('cascade');

            // Véhicule concerné par la demande
            $table->foreignId('vehicule_id')
                ->constrained('vehicules')
                ->onDelete('cascade');

            // Informations sur la demande
            $table->date('date_demande');

            $table->text('message')->nullable();

            // pending, accepted, refused, cancelled
            $table->enum('statut', [
                'pending',
                'accepted',
                'refused',
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
        Schema::dropIfExists('demandes_achats');
    }
};