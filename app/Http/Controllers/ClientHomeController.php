<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;

class ClientHomeController extends Controller
{
    /**
     * Page d'accueil publique LUXORA MOTORS
     */
    public function index()
    {
        // Afficher uniquement les véhicules disponibles
        $vehicules = Vehicule::with('marque')
            ->where('statut', 'Disponible')
            ->latest()
            ->take(6)
            ->get();

        return view('client.home', compact('vehicules'));
    }
}

