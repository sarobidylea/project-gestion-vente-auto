<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientAuthController extends Controller
{
    /**
     * Afficher la page de connexion client.
     */
    public function showLogin(Request $request)
    {
        if ($request->filled('redirect')) {
            session(['url.intended' => $request->redirect]);
        }

        return view('auth.client-login');
    }

    /**
     * Connexion client.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'role' => 'client',
        ])) {
            $request->session()->regenerate();

            return redirect()
                ->intended(route('client.home'))
                ->with('success', 'Bienvenue chez LUXORA MOTORS.');
        }

        return back()
            ->withErrors([
                'email' => 'Email ou mot de passe incorrect.',
            ])
            ->withInput($request->only('email'));
    }

    /**
     * Afficher le formulaire d'inscription.
     */
    public function showRegister()
    {
        return view('auth.client-register');
    }

    /**
     * Créer un compte client.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:100'],
            'prenom' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'telephone' => ['required', 'string', 'max:30'],
            'adresse' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Création du client
        $client = Client::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'adresse' => $validated['adresse'] ?? null,
        ]);

        // Création du compte utilisateur
        $user = User::create([
            'name' => $validated['prenom'] . ' ' . $validated['nom'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role' => 'client',
            'client_id' => $client->id,
        ]);

        // Connexion automatique
        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->intended(route('client.home'))
            ->with(
                'success',
                'Votre compte client a été créé avec succès.'
            );
    }

    /**
     * Déconnexion client.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('client.home')
            ->with('success', 'Vous êtes maintenant déconnecté.');
    }
}

