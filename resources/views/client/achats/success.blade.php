@extends('layouts.client')

@section('title', 'Achat confirmé — LUXORA MOTORS')

@section('content')

<style>
    .success-page {
        min-height: 80vh;
        padding: 80px 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #080808;
    }

    .success-card {
        width: 100%;
        max-width: 850px;
        background: #111;
        border: 1px solid #252525;
        border-radius: 18px;
        padding: 45px;
        box-shadow: 0 25px 60px rgba(0,0,0,.45);
    }

    .success-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 25px;
        border-radius: 50%;
        background: rgba(229, 9, 20, .12);
        border: 2px solid #e50914;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #e50914;
        font-size: 38px;
    }

    .success-title {
        text-align: center;
        color: #fff;
        font-size: 34px;
        font-weight: 800;
        margin-bottom: 12px;
    }

    .success-message {
        text-align: center;
        color: #999;
        font-size: 16px;
        margin-bottom: 35px;
    }

    .reference {
        text-align: center;
        background: #181818;
        border: 1px solid #292929;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 30px;
    }

    .reference span {
        display: block;
        color: #888;
        font-size: 13px;
        margin-bottom: 5px;
    }

    .reference strong {
        color: #e50914;
        font-size: 20px;
    }

    .purchase-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        margin-bottom: 30px;
    }

    .purchase-section {
        background: #181818;
        border: 1px solid #252525;
        border-radius: 12px;
        padding: 25px;
    }

    .purchase-section h3 {
        color: #fff;
        font-size: 17px;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #292929;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 13px;
    }

    .info-label {
        color: #888;
    }

    .info-value {
        color: #fff;
        font-weight: 600;
        text-align: right;
    }

    .price {
        color: #e50914 !important;
        font-size: 20px;
    }

    .status {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        background: rgba(34, 197, 94, .12);
        color: #22c55e;
        font-size: 13px;
    }

    .actions {
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .action-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 190px;
        padding: 14px 22px;
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
        transform: translateY(-2px);
    }

    .action-secondary {
        background: transparent;
        color: #fff;
        border: 1px solid #444;
    }

    .action-secondary:hover {
        border-color: #e50914;
        color: #e50914;
        transform: translateY(-2px);
    }

    @media (max-width: 700px) {
        .success-card {
            padding: 30px 20px;
        }

        .success-title {
            font-size: 27px;
        }

        .purchase-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="success-page">

    <div class="success-card">

        {{-- Icône --}}
        <div class="success-icon">
            ✓
        </div>

        {{-- Titre --}}
        <h1 class="success-title">
            Achat confirmé !
        </h1>

        <p class="success-message">
            Félicitations ! Votre achat a été enregistré avec succès.
            Merci de votre confiance envers LUXORA MOTORS.
        </p>

        {{-- Référence --}}
        <div class="reference">
            <span>Référence de votre achat</span>
            <strong>
                #LXM-{{ str_pad($achat->id, 6, '0', STR_PAD_LEFT) }}
            </strong>
        </div>

        {{-- Informations --}}
        <div class="purchase-grid">

            {{-- Véhicule --}}
            <div class="purchase-section">

                <h3>Véhicule acheté</h3>

                <div class="info-row">
                    <span class="info-label">Marque</span>
                    <span class="info-value">
                        {{ $achat->vehicule->marque->nom ?? '—' }}
                    </span>
                </div>

                <div class="info-row">
                    <span class="info-label">Modèle</span>
                    <span class="info-value">
                        {{ $achat->vehicule->modele }}
                    </span>
                </div>

                <div class="info-row">
                    <span class="info-label">Année</span>
                    <span class="info-value">
                        {{ $achat->vehicule->annee }}
                    </span>
                </div>

                <div class="info-row">
                    <span class="info-label">Prix</span>
                    <span class="info-value price">
                        {{ number_format($achat->prix, 0, ',', ' ') }} Ar
                    </span>
                </div>

            </div>

            {{-- Achat --}}
            <div class="purchase-section">

                <h3>Détails de l'achat</h3>

                <div class="info-row">
                    <span class="info-label">Date</span>
                    <span class="info-value">
                        {{ $achat->date_achat->format('d/m/Y à H:i') }}
                    </span>
                </div>

                <div class="info-row">
                    <span class="info-label">Paiement</span>
                    <span class="info-value">
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
                                {{ $achat->mode_paiement }}
                        @endswitch
                    </span>
                </div>

                <div class="info-row">
                    <span class="info-label">Statut</span>
                    <span class="info-value">
                        <span class="status">
                            Achat confirmé
                        </span>
                    </span>
                </div>

            </div>

        </div>

        {{-- Actions --}}
        <div class="actions">

            <a
                href="{{ route('client.achats.index') }}"
                class="action-primary"
            >
                Voir mes achats
            </a>

            <a
                href="{{ route('client.vehicules') }}"
                class="action-secondary"
            >
                Retour au catalogue
            </a>
   

        </div>

    </div>

</div>

@endsection