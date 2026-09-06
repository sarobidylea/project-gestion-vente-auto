<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\RendezVous;
use App\Models\Vehicule;
use Illuminate\Http\Request;

class RendezVousController extends Controller
{
    /**
     * Liste des rendez-vous
     */
    public function index(Request $request)
    {
        $query = RendezVous::with([
            'client',
            'vehicule.marque'
        ]);

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                // Recherche client
                $q->whereHas('client', function ($clientQuery) use ($search) {
                    $clientQuery->where('nom', 'like', '%' . $search . '%')
                        ->orWhere('prenom', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                })

                // Recherche véhicule
                ->orWhereHas('vehicule', function ($vehiculeQuery) use ($search) {
                    $vehiculeQuery->where('modele', 'like', '%' . $search . '%')
                        ->orWhereHas('marque', function ($marqueQuery) use ($search) {
                            $marqueQuery->where('nom', 'like', '%' . $search . '%');
                        });
                });
            });
        }

        // Filtre statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        // Filtre date
        if ($request->filled('date')) {
            $query->whereDate('date_rendez_vous', $request->date);
        }

        $rendezVous = $query
            ->orderBy('date_rendez_vous')
            ->orderBy('heure')
            ->paginate(10)
            ->withQueryString();

        return view('rendez_vous.index', compact('rendezVous'));
    }


    /**
     * Formulaire de création
     */
    public function create()
    {
        $clients = Client::orderBy('nom')
            ->orderBy('prenom')
            ->get();

        $vehicules = Vehicule::with('marque')
            ->where('statut', 'Disponible')
            ->orderBy('modele')
            ->get();

        return view('rendez_vous.create', compact(
            'clients',
            'vehicules'
        ));
    }


    /**
     * Enregistrer un rendez-vous
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',

            'vehicule_id' => 'required|exists:vehicules,id',

            'date_rendez_vous' => 'required|date',

            'heure' => 'required|date_format:H:i',

            'message' => 'nullable|string',

            'statut' => 'required|in:En attente,Confirme,Annul',
        ]);

        // Vérifier que le véhicule existe toujours
        $vehicule = Vehicule::findOrFail(
            $validated['vehicule_id']
        );

        if ($vehicule->statut === 'Vendu') {
            return back()
                ->withInput()
                ->withErrors([
                    'vehicule_id' =>
                        'Ce véhicule est déjà vendu.'
                ]);
        }

        RendezVous::create($validated);

        return redirect()
            ->route('rendez_vous.index')
            ->with(
                'success',
                'Rendez-vous créé avec succès.'
            );
    }


    /**
     * Afficher un rendez-vous
     */
    public function show(RendezVous $rendezVous)
    {
        $rendezVous->load([
            'client',
            'vehicule.marque'
        ]);

        return view(
            'rendez_vous.show',
            compact('rendezVous')
        );
    }


    /**
     * Formulaire de modification
     */
    public function edit(RendezVous $rendezVous)
    {
        $rendezVous->load([
            'client',
            'vehicule.marque'
        ]);

        $clients = Client::orderBy('nom')
            ->orderBy('prenom')
            ->get();

        $vehicules = Vehicule::with('marque')
            ->where(function ($query) use ($rendezVous) {

                $query->where('statut', 'Disponible')
                    ->orWhere(
                        'id',
                        $rendezVous->vehicule_id
                    );
            })
            ->orderBy('modele')
            ->get();

        return view(
            'rendez_vous.edit',
            compact(
                'rendezVous',
                'clients',
                'vehicules'
            )
        );
    }


    /**
     * Modifier un rendez-vous
     */
    public function update(
        Request $request,
        RendezVous $rendezVous
    ) {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',

            'vehicule_id' => 'required|exists:vehicules,id',

            'date_rendez_vous' => 'required|date',

            'heure' => 'required|date_format:H:i',

            'message' => 'nullable|string',

            'statut' => 'required|in:En attente,Confirme,Annul',
        ]);

        $vehicule = Vehicule::findOrFail(
            $validated['vehicule_id']
        );

        if ($vehicule->statut === 'Vendu') {

            // Autoriser uniquement si c'est
            // le véhicule déjà associé au rendez-vous
            if ($vehicule->id !== $rendezVous->vehicule_id) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'vehicule_id' =>
                            'Ce véhicule est déjà vendu.'
                    ]);
            }
        }

        $rendezVous->update($validated);

        return redirect()
            ->route('rendez_vous.index')
            ->with(
                'success',
                'Rendez-vous modifié avec succès.'
            );
    }


    /**
     * Supprimer un rendez-vous
     */
    public function destroy(RendezVous $rendezVous)
    {
        $rendezVous->delete();

        return redirect()
            ->route('rendez_vous.index')
            ->with(
                'success',
                'Rendez-vous supprimé avec succès.'
            );
    }
}