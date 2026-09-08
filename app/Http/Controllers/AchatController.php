<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Vente;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AchatController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ÉTAPE 1 : CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function checkout(Vehicule $vehicule)
    {
        // Vérifier si le véhicule est déjà vendu
        $dejaVendu = Vente::where('vehicule_id', $vehicule->id)
            ->where('statut', 'Confirmee')
            ->exists();

        // Vérifier également le statut du véhicule
        if ($dejaVendu || $vehicule->statut === 'Vendu') {
            return redirect()
                ->route('client.vehicule.show', $vehicule)
                ->with('error', 'Ce véhicule a déjà été vendu.');
        }

        return view(
            'client.achats.checkout',
            compact('vehicule')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ÉTAPE 2 : TRAITEMENT DU CHECKOUT
    |--------------------------------------------------------------------------
    */

    public function process(Request $request, Vehicule $vehicule)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:30',
            'adresse' => 'required|string|max:255',
            'mode_paiement' => [
                'required',
                'in:carte,mobile_money,livraison',
            ],
        ]);

        // Vérifier une nouvelle fois que le véhicule est disponible
        $dejaVendu = Vente::where('vehicule_id', $vehicule->id)
            ->where('statut', 'Confirmee')
            ->exists();

        if ($dejaVendu || $vehicule->statut === 'Vendu') {
            return redirect()
                ->route('client.vehicule.show', $vehicule)
                ->with(
                    'error',
                    'Ce véhicule n\'est plus disponible à la vente.'
                );
        }

        return view('client.achats.payment', [
            'vehicule' => $vehicule,
            'informations' => $validated,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | ÉTAPE 3 : CONFIRMATION DE L'ACHAT
    |--------------------------------------------------------------------------
    */

    public function confirm(Request $request, Vehicule $vehicule)
    {
        /*
        |--------------------------------------------------------------------------
        | Vérification du paiement
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'mode_paiement' => [
                'required',
                'in:carte,mobile_money,livraison',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Vérification de l'utilisateur
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();

        if (!$user || !$user->client_id) {
            abort(
                403,
                'Aucun client associé à ce compte.'
            );
        }

        $clientId = $user->client_id;


        /*
        |--------------------------------------------------------------------------
        | TRANSACTION
        |--------------------------------------------------------------------------
        */

        $achat = DB::transaction(function () use (
            $vehicule,
            $clientId,
            $validated
        ) {

            /*
            |--------------------------------------------------------------------------
            | Verrouillage du véhicule
            |--------------------------------------------------------------------------
            */

            $vehicule = Vehicule::where(
                'id',
                $vehicule->id
            )
                ->lockForUpdate()
                ->firstOrFail();


            /*
            |--------------------------------------------------------------------------
            | Vérifier le statut du véhicule
            |--------------------------------------------------------------------------
            */

            if ($vehicule->statut === 'Vendu') {
                abort(
                    409,
                    'Ce véhicule a déjà été vendu.'
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Vérifier si le véhicule possède déjà une vente confirmée
            |--------------------------------------------------------------------------
            */

            $venteExistante = Vente::where(
                'vehicule_id',
                $vehicule->id
            )
                ->where(
                    'statut',
                    'Confirmee'
                )
                ->first();

            if ($venteExistante) {

                /*
                | Le client possède déjà cette vente
                */

                if ($venteExistante->client_id == $clientId) {

                    $achatExistant = Achat::where(
                        'vehicule_id',
                        $vehicule->id
                    )
                        ->where(
                            'client_id',
                            $clientId
                        )
                        ->where(
                            'statut',
                            'paid'
                        )
                        ->latest()
                        ->first();

                    if ($achatExistant) {
                        return $achatExistant;
                    }
                }

                abort(
                    409,
                    'Ce véhicule a déjà été vendu.'
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Vérifier si un achat existe déjà
            |--------------------------------------------------------------------------
            */

            $achatExistant = Achat::where(
                'vehicule_id',
                $vehicule->id
            )
                ->whereIn(
                    'statut',
                    [
                        'pending',
                        'paid'
                    ]
                )
                ->first();

            if ($achatExistant) {

                /*
                | Si l'achat appartient au même client,
                | on retourne simplement cet achat.
                */

                if ($achatExistant->client_id == $clientId) {
                    return $achatExistant;
                }

                abort(
                    409,
                    'Ce véhicule est déjà en cours de vente.'
                );
            }


            /*
            |--------------------------------------------------------------------------
            | CRÉATION DE L'ACHAT
            |--------------------------------------------------------------------------
            */

            $achat = Achat::create([
                'client_id' => $clientId,

                'vehicule_id' => $vehicule->id,

                'prix' => $vehicule->prix,

                'date_achat' => now(),

                'mode_paiement' =>
                    $validated['mode_paiement'],

                'statut' => 'paid',
            ]);


            /*
            |--------------------------------------------------------------------------
            | Conversion du mode de paiement
            |--------------------------------------------------------------------------
            |
            | ACHATS                 VENTES
            |
            | carte          --->    Carte
            | mobile_money   --->    Virement
            | livraison      --->    Especes
            |
            */

            $modePaiementVente = match (
                $validated['mode_paiement']
            ) {

                'carte' =>
                    'Carte',

                'mobile_money' =>
                    'Virement',

                'livraison' =>
                    'Especes',
            };


            /*
            |--------------------------------------------------------------------------
            | Génération du numéro de facture
            |--------------------------------------------------------------------------
            */

            $numeroFacture =
                'LXM-' .
                now()->format('YmdHis') .
                '-' .
                $achat->id;


            /*
            |--------------------------------------------------------------------------
            | CRÉATION AUTOMATIQUE DE LA VENTE
            |--------------------------------------------------------------------------
            */

            Vente::create([

                'numero_facture' =>
                    $numeroFacture,

                'vehicule_id' =>
                    $vehicule->id,

                'client_id' =>
                    $clientId,

                'date_vente' =>
                    now()->toDateString(),

                'prix_vente' =>
                    $vehicule->prix,

                'mode_paiement' =>
                    $modePaiementVente,

                'statut' =>
                    'Confirmee',
            ]);


            /*
            |--------------------------------------------------------------------------
            | MARQUER LE VÉHICULE COMME VENDU
            |--------------------------------------------------------------------------
            */

            $vehicule->update([
                'statut' => 'Vendu',
            ]);


            /*
            |--------------------------------------------------------------------------
            | Retourner l'achat
            |--------------------------------------------------------------------------
            */

            return $achat;
        });


        /*
        |--------------------------------------------------------------------------
        | REDIRECTION VERS LA PAGE DE SUCCÈS
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'client.achat.success',
                $achat
            )
            ->with(
                'success',
                'Votre achat a été confirmé et le véhicule a été marqué comme vendu.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | PAGE DE SUCCÈS
    |--------------------------------------------------------------------------
    */

    public function success(Achat $achat)
    {
        $user = Auth::user();

        if (!$user || !$user->client_id) {
            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | Empêcher un client de consulter l'achat d'un autre client
        |--------------------------------------------------------------------------
        */

        if ($achat->client_id != $user->client_id) {
            abort(
                403,
                'Vous n\'êtes pas autorisé à consulter cet achat.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Charger les relations
        |--------------------------------------------------------------------------
        */

        $achat->load([
            'vehicule.marque',
            'client',
        ]);


        return view(
            'client.achats.success',
            compact('achat')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | HISTORIQUE DES ACHATS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->client_id) {
            abort(
                403,
                'Aucun client associé à ce compte.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Récupérer les achats du client connecté
        |--------------------------------------------------------------------------
        */

        $achats = Achat::with([
            'vehicule.marque'
        ])
            ->where(
                'client_id',
                $user->client_id
            )
            ->latest('date_achat')
            ->get();


        return view(
            'client.achats.index',
            compact('achats')
        );
    }
}
