<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Vehicule;
use App\Models\Vente;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    /**
     * Afficher la liste des ventes.
     */
    public function index(Request $request)
    {
        $query = Vente::with([
            'vehicule.marque',
            'client'
        ]);

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                // Recherche sur le véhicule
                $q->whereHas('vehicule', function ($vehiculeQuery) use ($search) {
                    $vehiculeQuery
                        ->where('modele', 'like', '%' . $search . '%')
                        ->orWhereHas('marque', function ($marqueQuery) use ($search) {
                            $marqueQuery->where('nom', 'like', '%' . $search . '%');
                        });
                })

                // Recherche sur le client
                ->orWhereHas('client', function ($clientQuery) use ($search) {
                    $clientQuery
                        ->where('nom', 'like', '%' . $search . '%')
                        ->orWhere('prenom', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            });
        }

        // Filtre par statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        // Filtre par mode de paiement
        if ($request->filled('mode_paiement')) {
            $query->where('mode_paiement', $request->mode_paiement);
        }

        // Tri par date de vente
        $ventes = $query
            ->orderByDesc('date_vente')
            ->paginate(10)
            ->withQueryString();

        return view('ventes.index', compact('ventes'));
    }


    /**
     * Afficher le formulaire d'ajout.
     */
    public function create()
    {
        // Seuls les véhicules disponibles peuvent être vendus
        $vehicules = Vehicule::with('marque')
            ->where('statut', 'Disponible')
            ->orderBy('modele')
            ->get();

        // Clients disponibles
        $clients = Client::orderBy('nom')
            ->orderBy('prenom')
            ->get();

        return view('ventes.create', compact(
            'vehicules',
            'clients'
        ));
    }


    /**
     * Enregistrer une nouvelle vente.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicule_id' => 'required|exists:vehicules,id',
            'client_id' => 'required|exists:clients,id',
            'date_vente' => 'required|date',
            'prix_vente' => 'required|numeric|min:0',
            'mode_paiement' => 'required|in:Especes,Carte,Virement,Credit',
            'statut' => 'required|in:En attente,Confirmee,Annulee',
        ]);

        // Vérifier que le véhicule est toujours disponible
        $vehicule = Vehicule::findOrFail(
            $validated['vehicule_id']
        );

        if ($vehicule->statut !== 'Disponible') {
            return back()
                ->withInput()
                ->withErrors([
                    'vehicule_id' => 'Ce véhicule n’est plus disponible.'
                ]);
        }

        // Génération automatique du numéro de facture
        $validated['numero_facture'] = 'LUX-' . date('Y') . '-' . str_pad(
            (Vente::max('id') ?? 0) + 1,
            6,
            '0',
            STR_PAD_LEFT
        );

        // Création de la vente
        $vente = Vente::create($validated);

        // Si la vente est confirmée,
        // le véhicule devient automatiquement vendu.
        if ($vente->statut === 'Confirmee') {
            $vehicule->update([
                'statut' => 'Vendu'
            ]);
        }

        return redirect()
            ->route('ventes.index')
            ->with('success', 'Vente enregistrée avec succès.');
    }


    /**
     * Afficher les détails d'une vente.
     */
    public function show(Vente $vente)
    {
        $vente->load([
            'vehicule.marque',
            'client'
        ]);

        return view('ventes.show', compact('vente'));
    }


    /**
     * Afficher la facture d'une vente.
     */
    public function facture(Vente $vente)
    {
        $vente->load([
            'vehicule.marque',
            'client'
        ]);

        return view('ventes.facture', compact('vente'));
    }


    /**
     * Afficher le formulaire de modification.
     */
    public function edit(Vente $vente)
    {
        $vente->load([
            'vehicule.marque',
            'client'
        ]);

        // Véhicule actuel + véhicules disponibles
        $vehicules = Vehicule::with('marque')
            ->where(function ($query) use ($vente) {
                $query->where('statut', 'Disponible')
                    ->orWhere('id', $vente->vehicule_id);
            })
            ->orderBy('modele')
            ->get();

        $clients = Client::orderBy('nom')
            ->orderBy('prenom')
            ->get();

        return view('ventes.edit', compact(
            'vente',
            'vehicules',
            'clients'
        ));
    }


    /**
     * Mettre à jour une vente.
     */
    public function update(Request $request, Vente $vente)
    {
        $validated = $request->validate([
            'vehicule_id' => 'required|exists:vehicules,id',
            'client_id' => 'required|exists:clients,id',
            'date_vente' => 'required|date',
            'prix_vente' => 'required|numeric|min:0',
            'mode_paiement' => 'required|in:Especes,Carte,Virement,Credit',
            'statut' => 'required|in:En attente,Confirmee,Annulee',
        ]);

        $ancienVehicule = $vente->vehicule;

        $nouveauVehicule = Vehicule::findOrFail(
            $validated['vehicule_id']
        );

        // Vérifier la disponibilité du nouveau véhicule
        if (
            $nouveauVehicule->id !== $vente->vehicule_id &&
            $nouveauVehicule->statut !== 'Disponible'
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'vehicule_id' => 'Ce véhicule n’est plus disponible.'
                ]);
        }

        // Mettre à jour la vente
        $vente->update($validated);

        /*
         * Gestion automatique des statuts des véhicules
         */

        // Si on change de véhicule,
        // l'ancien redevient disponible.
        if (
            $ancienVehicule &&
            $ancienVehicule->id !== $nouveauVehicule->id
        ) {
            $ancienVehicule->update([
                'statut' => 'Disponible'
            ]);
        }

        // Si la vente est confirmée,
        // le nouveau véhicule devient vendu.
        if ($vente->statut === 'Confirmee') {
            $nouveauVehicule->update([
                'statut' => 'Vendu'
            ]);
        } else {
            // Si la vente n'est pas confirmée,
            // le véhicule redevient disponible.
            $nouveauVehicule->update([
                'statut' => 'Disponible'
            ]);
        }

        return redirect()
            ->route('ventes.index')
            ->with('success', 'Vente modifiée avec succès.');
    }


    /**
     * Supprimer une vente.
     */
    public function destroy(Vente $vente)
    {
        $vehicule = $vente->vehicule;

        // Suppression de la vente
        $vente->delete();

        // Le véhicule redevient disponible
        if ($vehicule) {
            $vehicule->update([
                'statut' => 'Disponible'
            ]);
        }

        return redirect()
            ->route('ventes.index')
            ->with('success', 'Vente supprimée avec succès.');
    }
}