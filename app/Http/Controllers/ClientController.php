<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Afficher la liste des clients.
     */
    public function index(Request $request)
    {
        $query = Client::withCount(['ventes', 'rendezVous']);

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', '%' . $search . '%')
                    ->orWhere('prenom', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('telephone', 'like', '%' . $search . '%');
            });
        }

        $clients = $query
            ->orderBy('nom')
            ->orderBy('prenom')
            ->paginate(10)
            ->withQueryString();

        return view('clients.index', compact('clients'));
    }

    /**
     * Formulaire d'ajout.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Enregistrer un client.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:clients,email',
            'telephone' => 'required|string|max:30',
            'adresse' => 'nullable|string',
        ]);

        Client::create($validated);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client ajouté avec succès.');
    }

    /**
     * Afficher les détails d'un client.
     */
    public function show(Client $client)
    {
        $client->load([
            'ventes.vehicule.marque',
            'rendezVous.vehicule.marque',
        ]);

        return view('clients.show', compact('client'));
    }

    /**
     * Formulaire de modification.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Modifier un client.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|max:255|unique:clients,email,' . $client->id,
            'telephone' => 'required|string|max:30',
            'adresse' => 'nullable|string',
        ]);

        $client->update($validated);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client modifié avec succès.');
    }

    /**
     * Supprimer un client.
     */
    public function destroy(Client $client)
    {
        // Vérifier si le client possède des ventes
        if ($client->ventes()->exists()) {
            return redirect()
                ->route('clients.index')
                ->with(
                    'error',
                    'Impossible de supprimer ce client car il possède une ou plusieurs ventes.'
                );
        }

        // Vérifier s'il possède des rendez-vous
        if ($client->rendezVous()->exists()) {
            return redirect()
                ->route('clients.index')
                ->with(
                    'error',
                    'Impossible de supprimer ce client car il possède un ou plusieurs rendez-vous.'
                );
        }

        $client->delete();

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client supprimé avec succès.');
    }
}