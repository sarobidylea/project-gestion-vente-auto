<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    /**
     * Autoriser uniquement les utilisateurs
     * ayant accès à l'administration.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $role = auth()->user()->role;

        if (!in_array($role, [
            'administrateur',
            'gestionnaire',
            'vendeur',
        ])) {
            abort(403, 'Accès interdit.');
        }

        return $next($request);
    }
}

