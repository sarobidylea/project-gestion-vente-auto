<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Models\Marque;
use Illuminate\Http\Request;

class ClientVehiculeController extends Controller
{
    /**
     * Catalogue public des véhicules
     */
    public function index(Request $request)
    {
        $query = Vehicule::with('marque')
            ->where('statut', 'Disponible');

        // Recherche modèle ou marque
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('modele', 'like', '%' . $search . '%')
                  ->orWhereHas('marque', function ($marque) use ($search) {
                      $marque->where('nom', 'like', '%' . $search . '%');
                  });
            });
        }

        // Filtre par marque
        if ($request->filled('marque_id')) {
            $query->where('marque_id', $request->marque_id);
        }

        // Filtre par carburant
        if ($request->filled('carburant')) {
            $query->where('carburant', $request->carburant);
        }

        // Filtre par boîte de vitesse
        if ($request->filled('boite_vitesse')) {
            $query->where('boite_vitesse', $request->boite_vitesse);
        }

        $vehicules = $query
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $marques = Marque::orderBy('nom')->get();

        return view('client.vehicules', compact(
            'vehicules',
            'marques'
        ));
    }

    /**
     * Détail d'un véhicule
     */
    public function show(Vehicule $vehicule)
    {
        // Un véhicule vendu ou réservé ne doit pas être visible
        // dans le catalogue public.
        abort_if($vehicule->statut !== 'Disponible', 404);

        $vehicule->load('marque');

        return view('client.vehicule-show', compact('vehicule'));
    }
}
