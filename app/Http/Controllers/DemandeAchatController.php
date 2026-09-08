<?php

namespace App\Http\Controllers;

use App\Models\DemandeAchat;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeAchatController extends Controller
{
    /**
     * Afficher le formulaire de demande d'achat.
     */
    public function create(Vehicule $vehicule)
    {
        return view('client.demandes_achats.create', compact('vehicule'));
    }

    /**
     * Enregistrer une demande d'achat.
     */
    public function store(Request $request, Vehicule $vehicule)
    {
        $validated = $request->validate([
            'message' => 'nullable|string|max:1000',
        ]);

        DemandeAchat::create([
            'client_id' => Auth::id(),
            'vehicule_id' => $vehicule->id,
            'date_demande' => now()->toDateString(),
            'message' => $validated['message'] ?? null,
            'statut' => 'pending',
        ]);

        return redirect()
            ->route('client.demandes-achat.index')
            ->with('success', 'Votre demande d’achat a été envoyée avec succès.');
    }

    /**
     * Afficher l'historique des demandes du client.
     */
    public function index()
    {
        $demandes = DemandeAchat::with('vehicule')
            ->where('client_id', Auth::id())
            ->latest()
            ->get();

        return view('client.demandes_achats.index', compact('demandes'));
    }
}