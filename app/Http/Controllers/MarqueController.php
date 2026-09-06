<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use Illuminate\Http\Request;

class MarqueController extends Controller
{
    /**
     * Afficher la liste des marques.
     */
    public function index()
    {
        $marques = Marque::withCount('vehicules')
            ->orderBy('nom')
            ->paginate(10);

        return view('marques.index', compact('marques'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        return view('marques.create');
    }

    /**
     * Enregistrer une nouvelle marque.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:marques,nom',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request
                ->file('logo')
                ->store('marques', 'public');
        }

        Marque::create($validated);

        return redirect()
            ->route('marques.index')
            ->with('success', 'Marque ajoutée avec succès.');
    }

    /**
     * Afficher une marque.
     */
    public function show(Marque $marque)
    {
        $marque->load('vehicules');

        return view('marques.show', compact('marque'));
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(Marque $marque)
    {
        return view('marques.edit', compact('marque'));
    }

    /**
     * Modifier une marque.
     */
    public function update(Request $request, Marque $marque)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:marques,nom,' . $marque->id,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {

            if ($marque->logo) {
                \Storage::disk('public')->delete($marque->logo);
            }

            $validated['logo'] = $request
                ->file('logo')
                ->store('marques', 'public');
        }

        $marque->update($validated);

        return redirect()
            ->route('marques.index')
            ->with('success', 'Marque modifiée avec succès.');
    }

    /**
     * Supprimer une marque.
     */
    public function destroy(Marque $marque)
    {
        // Vérifier si des véhicules utilisent cette marque
        if ($marque->vehicules()->exists()) {
            return redirect()
                ->route('marques.index')
                ->with('error', 'Impossible de supprimer cette marque car des véhicules lui sont associés.');
        }

        if ($marque->logo) {
            \Storage::disk('public')->delete($marque->logo);
        }

        $marque->delete();

        return redirect()
            ->route('marques.index')
            ->with('success', 'Marque supprimée avec succès.');
    }
}