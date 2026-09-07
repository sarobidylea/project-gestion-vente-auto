<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use App\Models\RendezVous;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientRendezVousController extends Controller
{
    /**
     * Formulaire de prise de rendez-vous.
     */
    public function create(Vehicule $vehicule)
    {
        abort_if($vehicule->statut !== 'Disponible', 404);

        $vehicule->load('marque');

        return view(
            'client.rendez-vous-create',
            compact('vehicule')
        );
    }

    /**
     * Enregistrer le rendez-vous.
     */
    public function store(Request $request, Vehicule $vehicule)
    {
        abort_if($vehicule->statut !== 'Disponible', 404);

        $validated = $request->validate([
            'date_rendez_vous' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'heure' => [
                'required',
                'date_format:H:i',
            ],

            'message' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        RendezVous::create([
            'client_id' => Auth::user()->client_id,
            'vehicule_id' => $vehicule->id,
            'date_rendez_vous' => $validated['date_rendez_vous'],
            'heure' => $validated['heure'],
            'message' => $validated['message'] ?? null,
            'statut' => 'En attente',
        ]);

        return redirect()
            ->route('client.vehicule.show', $vehicule)
            ->with(
                'success',
                'Votre demande de rendez-vous a bien été envoyée.'
            );
    }
}

