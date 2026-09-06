<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rendez_vous', function (Blueprint $table) {
            $table->id();

            $table->foreignId('client_id')
                  ->constrained('clients')
                  ->cascadeOnDelete();

            $table->foreignId('vehicule_id')
                  ->constrained('vehicules')
                  ->cascadeOnDelete();

            $table->date('date_rendez_vous');
            $table->time('heure');
            $table->text('message')->nullable();

            $table->enum('statut', [
                'En attente',
                'Confirme',
                'Annule'
            ])->default('En attente');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rendez_vous');
    }
};