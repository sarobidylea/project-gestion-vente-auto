<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ClientAccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $client = $user->client;

        abort_if(!$client, 404);

        $client->load([
            'rendezVous' => function ($query) {
                $query->with('vehicule.marque')
                    ->latest('date_rendez_vous');
            }
        ]);

        return view('client.account', compact('user', 'client'));
    }
}
