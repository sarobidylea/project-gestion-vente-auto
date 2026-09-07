<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // Vérifier que le compte appartient à l'administration
            if (!in_array($user->role, [
                'administrateur',
                'gestionnaire',
                'vendeur',
            ])) {

                Auth::logout();

                return back()
                    ->withErrors([
                        'email' => 'Mot de passe ou email incorrect.',
                    ])
                    ->onlyInput('email');
            }

            $request->session()->regenerate();

            return redirect()
                ->intended(route('dashboard'))
                ->with('success', 'Connexion réussie.');
        }

        return back()
            ->withErrors([
                'email' => 'Mot de passe ou email incorrect.',
            ])
            ->onlyInput('email');
    }



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Vous êtes maintenant déconnecté.');
    }
}
