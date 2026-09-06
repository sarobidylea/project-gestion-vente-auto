<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehiculeController extends Controller
{
    /**
     * Afficher la liste des véhicules
     */
    public function index(Request $request)
{
    $query = Vehicule::with('marque');

    // Recherche par marque ou modèle
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('modele', 'like', '%' . $search . '%')
              ->orWhereHas('marque', function ($marqueQuery) use ($search) {
                  $marqueQuery->where('nom', 'like', '%' . $search . '%');
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

    // Filtre par statut
    if ($request->filled('statut')) {
        $query->where('statut', $request->statut);
    }

    $vehicules = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    $marques = Marque::orderBy('nom')->get();

    return view('vehicules.index', compact(
        'vehicules',
        'marques'
    ));
}

    /**
     * Afficher le formulaire d'ajout
     */
    public function create()
    {
        $marques = Marque::orderBy('nom')->get();

        return view('vehicules.create', compact('marques'));
    }

    /**
     * Enregistrer un nouveau véhicule
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'marque_id' => 'required|exists:marques,id',
            'modele' => 'required|string|max:255',
            'annee' => 'required|integer|min:1900|max:' . date('Y'),
            'prix' => 'required|numeric|min:0',
            'kilometrage' => 'required|integer|min:0',

            'carburant' => 'required|in:Essence,Diesel,Hybride,Electrique',

            'boite_vitesse' => 'required|in:Manuelle,Automatique',

            'couleur' => 'nullable|string|max:100',

            'puissance' => 'nullable|integer|min:0',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',

            'description' => 'nullable|string',

            'statut' => 'required|in:Disponible,Vendu,Reserve',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload de l'image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('vehicles', 'public');
        }

        /*
         Création du véhicule
        */

        Vehicule::create($validated);

        return redirect()
            ->route('vehicules.index')
            ->with('success', 'Véhicule ajouté avec succès.');
    }

    /**
     * Afficher un véhicule
     */
    public function show(Vehicule $vehicule)
    {
        $vehicule->load('marque');

        return view('vehicules.show', compact('vehicule'));
    }

    /**
     * Afficher le formulaire de modification
     */
    public function edit(Vehicule $vehicule)
    {
        $marques = Marque::orderBy('nom')->get();

        return view('vehicules.edit', compact('vehicule', 'marques'));
    }

    /**
     * Modifier un véhicule
     */
    public function update(Request $request, Vehicule $vehicule)
    {
        $validated = $request->validate([
            'marque_id' => 'required|exists:marques,id',
            'modele' => 'required|string|max:255',
            'annee' => 'required|integer|min:1900|max:' . date('Y'),
            'prix' => 'required|numeric|min:0',
            'kilometrage' => 'required|integer|min:0',

            'carburant' => 'required|in:Essence,Diesel,Hybride,Electrique',

            'boite_vitesse' => 'required|in:Manuelle,Automatique',

            'couleur' => 'nullable|string|max:100',

            'puissance' => 'nullable|integer|min:0',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',

            'description' => 'nullable|string',

            'statut' => 'required|in:Disponible,Vendu,Reserve',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Nouvelle image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            // Supprimer l'ancienne image
            if ($vehicule->image) {
                Storage::disk('public')->delete($vehicule->image);
            }

            // Enregistrer la nouvelle image
            $validated['image'] = $request->file('image')
                ->store('vehicles', 'public');
        }

        /*
        Mise à jour
        */

        $vehicule->update($validated);

        return redirect()
            ->route('vehicules.index')
            ->with('success', 'Véhicule modifié avec succès.');
    }

    /**
     * Supprimer un véhicule
     */
    public function destroy(Vehicule $vehicule)
    {
        // Supprimer l'image associée
        if ($vehicule->image) {
            Storage::disk('public')->delete($vehicule->image);
        }

        $vehicule->delete();

        return redirect()
            ->route('vehicules.index')
            ->with('success', 'Véhicule supprimé avec succès.');
    }
}