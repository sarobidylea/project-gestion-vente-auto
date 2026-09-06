<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('marque_id')
                  ->constrained('marques')
                  ->cascadeOnDelete();

            $table->string('modele');
            $table->year('annee');
            $table->decimal('prix', 12, 2);
            $table->unsignedInteger('kilometrage')->default(0);

            $table->enum('carburant', [
                'Essence',
                'Diesel',
                'Hybride',
                'Electrique'
            ]);

            $table->enum('boite_vitesse', [
                'Manuelle',
                'Automatique'
            ]);

            $table->string('couleur')->nullable();
            $table->integer('puissance')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();

            $table->enum('statut', [
                'Disponible',
                'Vendu',
                'Reserve'
            ])->default('Disponible');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};