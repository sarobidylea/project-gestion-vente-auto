@extends('layouts.client')

@section('title', 'Mes achats — LUXORA MOTORS')

@section('content')

<style>
    .purchases-page {
        min-height: 100vh;
        padding: 70px 25px;
        background: #080808;
    }

    .purchases-container {
        max-width: 1250px;
        margin: 0 auto;
    }

    /* =========================
       HEADER
    ========================= */

    .purchases-header {
        margin-bottom: 40px;
    }

    .purchases-header h1 {
        margin: 0 0 10px;
        color: #fff;
        font-size: 38px;
        font-weight: 800;
    }

    .purchases-header p {
        margin: 0;
        color: #888;
        font-size: 16px;
    }

    .accent {
        color: #e50914;
    }

    /* =========================
       EMPTY STATE
    ========================= */

    .empty-state {
        background: #111;
        border: 1px solid #252525;
        border-radius: 16px;
        padding: 70px 30px;
        text-align: center;
    }

    .empty-icon {
        font-size: 55px;
        margin-bottom: 20px;
        opacity: .7;
    }

    .empty-state h2 {
        color: #fff;
        margin-bottom: 10px;
    }

    .empty-state p {
        max-width: 650px;
        margin: 0 auto 30px;
        color: #888;
        line-height: 1.7;
    }

    /* =========================
       PURCHASE CARD
    ========================= */

    .purchase-card {
        display: grid;
        grid-template-columns: 280px 1fr auto;
        gap: 30px;
        align-items: center;

        background: #111;
        border: 1px solid #252525;
        border-radius: 16px;

        padding: 20px;
        margin-bottom: 20px;

        transition: .25s ease;
    }

    .purchase-card:hover {
        border-color: #3a3a3a;
        transform: translateY(-2px);
    }

    /* =========================
       IMAGE
    ========================= */

    .vehicle-image {
        width: 100%;
        height: 190px;
        object-fit: cover;
        border-radius: 10px;
        background: #181818;
        display: block;
    }

    .no-image {
        display: flex;
        align-items: center;
        justify-content: center;

        color: #555;
        font-size: 14px;
    }

    /* =========================
       VEHICLE INFO
    ========================= */

    .purchase-info h2 {
        margin: 0 0 8px;
        color: #fff;
        font-size: 23px;
        font-weight: 700;
    }

    .vehicle-brand {
        color: #e50914;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(150px, 1fr));
        gap: 14px 25px;
        margin-top: 20px;
    }

    .info-item span {
        display: block;
        color: #777;
        font-size: 12px;
        margin-bottom: 4px;
    }

    .info-item strong {
        color: #ddd;
        font-size: 14px;
        font-weight: 600;
    }

    /* =========================
       PURCHASE SIDE
    ========================= */

    .purchase-side {
        min-width: 200px;
        text-align: right;
    }

    .reference {
        color: #777;
        font-size: 12px;
        margin-bottom: 15px;
    }

    .reference strong {
        color: #ddd;
    }

    .price {
        color: #e50914;
        font-size: 23px;
        font-weight: 800;
        margin-bottom: 15px;
    }

    /* =========================
       STATUS
    ========================= */

    .status {
        display: inline-block;
        padding: 7px 13px;
        border-radius: 20px;

        background: rgba(34, 197, 94, .12);
        color: #22c55e;

        font-size: 12px;
        font-weight: 700;
    }

    .status.pending {
        background: rgba(234, 179, 8, .12);
        color: #eab308;
    }

    .status.cancelled {
        background: rgba(239, 68, 68, .12);
        color: #ef4444;
    }

    /* =========================
       ACTIONS
    ========================= */

    .page-actions {
        margin-top: 35px;

        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .action-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 14px 24px;

        border-radius: 8px;

        text-decoration: none;
        font-weight: 700;

        transition: .25s ease;
    }

    .action-primary {
        background: #e50914;
        color: #fff;
        border: 1px solid #e50914;
    }

    .action-primary:hover {
        background: #b80710;
        border-color: #b80710;
        color: #fff;
        transform: translateY(-2px);
    }

    .action-secondary {
        background: transparent;
        color: #fff;
        border: 1px solid #444;
    }

    .action-secondary:hover {
        color: #e50914;
        border-color: #e50914;
        transform: translateY(-2px);
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 950px) {

        .purchase-card {
            grid-template-columns: 220px 1fr;
        }

        .purchase-side {
            grid-column: 2;
            text-align: left;
        }
    }

    @media (max-width: 650px) {

        .purchases-page {
            padding: 45px 15px;
        }

        .purchases-header h1 {
            font-size: 30px;
        }

        .purchase-card {
            grid-template-columns: 1fr;
        }

        .vehicle-image {
            height: 220px;
        }

        .purchase-side {
            grid-column: auto;
            text-align: left;
            min-width: 0;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .page-actions {
            flex-direction: column;
        }

        .action-button {
            width: 100%;
        }
    }
</style>


<div class="purchases-page">

    <div class="purchases-container">

        {{-- =========================
             HEADER
        ========================= --}}

        <div class="purchases-header">

            <h1>
                Mes <span class="accent">achats</span>
            </h1>

            <p>
                Retrouvez ici l'historique de vos véhicules achetés
                chez LUXORA MOTORS.
            </p>

        </div>


        {{-- =========================
             AUCUN ACHAT
        ========================= --}}

        @if($achats->isEmpty())

            <div class="empty-state">

                <div class="empty-icon">
                    🚗
                </div>

                <h2>
                    Aucun achat pour le moment
                </h2>

                <p>
                    Vous n'avez encore acheté aucun véhicule.
                    Découvrez notre catalogue et trouvez votre prochaine automobile.
                </p>

                <a
                    href="{{ route('client.vehicules') }}"
                    class="action-button action-primary"
                >
                    Découvrir le catalogue
                </a>

            </div>


        @else


            {{-- =========================
                 LISTE DES ACHATS
            ========================= --}}

            @foreach($achats as $achat)

                @php
                    $vehicule = $achat->vehicule;
                @endphp


                <div class="purchase-card">

                    {{-- =========================
                         IMAGE VEHICULE
                    ========================= --}}

                    <div>

                        @if($vehicule && $vehicule->image)

                            <img
                                src="{{ asset('storage/' . $vehicule->image) }}"
                                alt="{{ $vehicule->marque->nom ?? '' }} {{ $vehicule->modele }}"
                                class="vehicle-image"
                            >

                        @else

                            <div class="vehicle-image no-image">
                                Aucune image disponible
                            </div>

                        @endif

                    </div>


                    {{-- =========================
                         INFORMATIONS VEHICULE
                    ========================= --}}

                    <div class="purchase-info">

                        <div class="vehicle-brand">
                            {{ $vehicule->marque->nom ?? 'Automobile' }}
                        </div>

                        <h2>
                            {{ $vehicule->modele ?? 'Véhicule' }}
                        </h2>


                        <div class="info-grid">

                            {{-- Année --}}
                            <div class="info-item">

                                <span>
                                    Année
                                </span>

                                <strong>
                                    {{ $vehicule->annee ?? '—' }}
                                </strong>

                            </div>


                            {{-- Kilométrage --}}
                            <div class="info-item">

                                <span>
                                    Kilométrage
                                </span>

                                <strong>

                                    @if($vehicule && $vehicule->kilometrage !== null)

                                        {{ number_format(
                                            $vehicule->kilometrage,
                                            0,
                                            ',',
                                            ' '
                                        ) }}
                                        km

                                    @else

                                        —

                                    @endif

                                </strong>

                            </div>


                            {{-- Carburant --}}
                            <div class="info-item">

                                <span>
                                    Carburant
                                </span>

                                <strong>
                                    {{ $vehicule->carburant ?? '—' }}
                                </strong>

                            </div>


                            {{-- Boîte --}}
                            <div class="info-item">

                                <span>
                                    Boîte
                                </span>

                                <strong>
                                    {{ $vehicule->boite_vitesse ?? '—' }}
                                </strong>

                            </div>


                            {{-- Date achat --}}
                            <div class="info-item">

                                <span>
                                    Date d'achat
                                </span>

                                <strong>

                                    @if($achat->date_achat)

                                        {{ $achat->date_achat->format('d/m/Y') }}

                                    @else

                                        —

                                    @endif

                                </strong>

                            </div>


                            {{-- Paiement --}}
                            <div class="info-item">

                                <span>
                                    Paiement
                                </span>

                                <strong>

                                    @switch($achat->mode_paiement)

                                        @case('carte')
                                            Carte bancaire
                                            @break

                                        @case('mobile_money')
                                            Mobile Money
                                            @break

                                        @case('livraison')
                                            Paiement à la livraison
                                            @break

                                        @default
                                            {{ $achat->mode_paiement ?? '—' }}

                                    @endswitch

                                </strong>

                            </div>

                        </div>

                    </div>


                    {{-- =========================
                         PRIX / STATUT
                    ========================= --}}

                    <div class="purchase-side">

                        <div class="reference">

                            Référence :

                            <strong>
                                #LXM-{{ str_pad($achat->id, 6, '0', STR_PAD_LEFT) }}
                            </strong>

                        </div>


                        <div class="price">

                            {{ number_format(
                                $achat->prix,
                                0,
                                ',',
                                ' '
                            ) }}

                            Ar

                        </div>


                        @if($achat->statut === 'paid')

                            <span class="status">
                                Achat confirmé
                            </span>

                        @elseif($achat->statut === 'pending')

                            <span class="status pending">
                                En attente
                            </span>

                        @elseif($achat->statut === 'cancelled')

                            <span class="status cancelled">
                                Annulé
                            </span>

                        @else

                            <span class="status">
                                {{ ucfirst($achat->statut ?? 'Inconnu') }}
                            </span>

                        @endif

                    </div>

                </div>

            @endforeach


            {{-- =========================
                 ACTIONS
            ========================= --}}

            <div class="page-actions">

                <a
                    href="{{ route('client.vehicules') }}"
                    class="action-button action-primary"
                >
                    Acheter un autre véhicule
                </a>

                <a
                    href="{{ route('client.vehicules') }}"
                    class="action-button action-secondary"
                >
                    Retour au catalogue
                </a>

            </div>

        @endif

    </div>

</div>

@endsection