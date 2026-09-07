@extends('layouts.app')

@section('title', 'Détails de la vente')

@section('content')

<style>
    .sale-show {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* =========================
       HEADER
    ========================= */

    .sale-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 20px;
        margin-bottom: 30px;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #999;
        text-decoration: none;
        font-size: 14px;
        margin-bottom: 18px;
        transition: 0.2s ease;
    }

    .back-link:hover {
        color: #e50914;
    }

    .sale-header h1 {
        margin: 0;
        font-size: 32px;
        font-weight: 800;
        color: #fff;
    }

    .sale-header p {
        margin: 8px 0 0;
        color: #777;
        font-size: 14px;
    }

    /* =========================
       STATUS
    ========================= */

    .status {
        display: inline-flex;
        align-items: center;
        padding: 8px 15px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status.confirmed {
        background: rgba(34, 197, 94, 0.12);
        color: #22c55e;
        border: 1px solid rgba(34, 197, 94, 0.25);
    }

    .status.pending {
        background: rgba(245, 158, 11, 0.12);
        color: #f59e0b;
        border: 1px solid rgba(245, 158, 11, 0.25);
    }

    .status.cancelled {
        background: rgba(239, 68, 68, 0.12);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.25);
    }

    /* =========================
       GRID
    ========================= */

    .details-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .card {
        background: #0d0d0d;
        border: 1px solid #202020;
        border-radius: 18px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
    }

    .card.full {
        grid-column: 1 / -1;
    }

    .card-title {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 22px;
        padding-bottom: 15px;
        border-bottom: 1px solid #222;
    }

    /* =========================
       INFORMATIONS
    ========================= */

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        padding: 13px 0;
        border-bottom: 1px solid #181818;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: #777;
        font-size: 13px;
    }

    .info-value {
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        text-align: right;
    }

    .price-value {
        color: #e50914;
        font-size: 20px;
        font-weight: 800;
    }

    /* =========================
       CLIENT
    ========================= */

    .client-profile {
        display: flex;
        align-items: center;
        gap: 18px;
        margin-bottom: 20px;
    }

    .client-avatar {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        background: linear-gradient(135deg, #e50914, #7a0007);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 21px;
        font-weight: 800;
        flex-shrink: 0;
    }

    .client-name {
        color: #fff;
        font-size: 19px;
        font-weight: 700;
        margin: 0;
    }

    .client-email {
        color: #777;
        font-size: 13px;
        margin-top: 5px;
    }

    /* =========================
       VEHICULE
    ========================= */

    .vehicle-box {
        display: flex;
        gap: 25px;
        align-items: center;
    }

    .vehicle-image {
        width: 260px;
        height: 170px;
        object-fit: cover;
        border-radius: 14px;
        background: #151515;
        border: 1px solid #252525;
        flex-shrink: 0;
    }

    .vehicle-placeholder {
        width: 260px;
        height: 170px;
        border-radius: 14px;
        background: linear-gradient(135deg, #171717, #0b0b0b);
        border: 1px solid #252525;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #555;
        font-size: 50px;
        flex-shrink: 0;
    }

    .vehicle-info {
        flex: 1;
    }

    .vehicle-info h3 {
        margin: 0 0 12px;
        color: #fff;
        font-size: 24px;
        font-weight: 800;
    }

    .vehicle-info p {
        margin: 7px 0;
        color: #888;
        font-size: 14px;
    }

    .vehicle-price {
        color: #e50914 !important;
        font-size: 24px !important;
        font-weight: 800;
        margin-top: 15px !important;
    }

    .vehicle-link {
        display: inline-flex;
        margin-top: 15px;
        color: #e50914;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
    }

    .vehicle-link:hover {
        text-decoration: underline;
    }

    /* =========================
       PAYMENT
    ========================= */

    .payment-box {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }

    .payment-item {
        background: #131313;
        border: 1px solid #222;
        border-radius: 12px;
        padding: 18px;
    }

    .payment-item span {
        display: block;
        color: #777;
        font-size: 12px;
        margin-bottom: 8px;
    }

    .payment-item strong {
        color: #fff;
        font-size: 15px;
    }

    /* =========================
       ACTIONS
    ========================= */

    .actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 25px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 20px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .btn-primary {
        background: #e50914;
        color: #fff;
    }

    .btn-primary:hover {
        background: #c70812;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #1a1a1a;
        color: #aaa;
        border: 1px solid #292929;
    }

    .btn-secondary:hover {
        color: #fff;
        border-color: #444;
    }

    .btn-print {
        background: #151515;
        color: #fff;
        border: 1px solid #333;
    }

    .btn-print:hover {
        border-color: #e50914;
        color: #e50914;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 900px) {
        .details-grid {
            grid-template-columns: 1fr;
        }

        .card.full {
            grid-column: auto;
        }

        .payment-box {
            grid-template-columns: 1fr;
        }

        .vehicle-box {
            flex-direction: column;
            align-items: flex-start;
        }

        .vehicle-image,
        .vehicle-placeholder {
            width: 100%;
            height: 220px;
        }
    }

    @media (max-width: 600px) {
        .sale-header {
            flex-direction: column;
        }

        .sale-header h1 {
            font-size: 25px;
        }

        .info-row {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }

        .info-value {
            text-align: left;
        }

        .actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }

    /* =========================
       IMPRESSION
    ========================= */

    @media print {

        body {
            background: #fff !important;
            color: #000 !important;
        }

        .sidebar,
        .top-header,
        .back-link,
        .actions {
            display: none !important;
        }

        .sale-show {
            max-width: 100%;
        }

        .card {
            background: #fff !important;
            border: 1px solid #ddd !important;
            box-shadow: none !important;
            color: #000 !important;
            break-inside: avoid;
        }

        .card-title,
        .info-value,
        .vehicle-info h3,
        .client-name {
            color: #000 !important;
        }

        .info-label,
        .vehicle-info p,
        .client-email {
            color: #555 !important;
        }

        .price-value,
        .vehicle-price {
            color: #c00 !important;
        }
    }
</style>


<div class="sale-show">

    {{-- RETOUR --}}
    <a href="{{ route('ventes.index') }}" class="back-link">
        ← Retour aux ventes
    </a>


    {{-- HEADER --}}
    <div class="sale-header">

        <div>
            <h1>Détails de la vente</h1>
            <p>
                Vente #{{ $vente->id }}
                · Enregistrée le {{ $vente->created_at->format('d/m/Y à H:i') }}
            </p>
        </div>

        @if($vente->statut === 'Confirmee')

            <span class="status confirmed">
                ✓ Vente confirmée
            </span>

        @elseif($vente->statut === 'En attente')

            <span class="status pending">
                ◷ En attente
            </span>

        @else

            <span class="status cancelled">
                ✕ Annulée
            </span>

        @endif

    </div>


    <div class="details-grid">


        {{-- =========================
             CLIENT
        ========================== --}}

        <div class="card">

            <div class="card-title">
                👤 Informations du client
            </div>

            <div class="client-profile">

                <div class="client-avatar">
                    {{ strtoupper(substr($vente->client->prenom, 0, 1) . substr($vente->client->nom, 0, 1)) }}
                </div>

                <div>
                    <h3 class="client-name">
                        {{ $vente->client->prenom }}
                        {{ $vente->client->nom }}
                    </h3>

                    <div class="client-email">
                        {{ $vente->client->email }}
                    </div>
                </div>

            </div>


            <div class="info-row">
                <span class="info-label">
                    Téléphone
                </span>

                <span class="info-value">
                    {{ $vente->client->telephone }}
                </span>
            </div>


            <div class="info-row">
                <span class="info-label">
                    Email
                </span>

                <span class="info-value">
                    {{ $vente->client->email }}
                </span>
            </div>


            @if($vente->client->adresse)

                <div class="info-row">
                    <span class="info-label">
                        Adresse
                    </span>

                    <span class="info-value">
                        {{ $vente->client->adresse }}
                    </span>
                </div>

            @endif

        </div>


        {{-- =========================
             INFORMATIONS VENTE
        ========================== --}}

        <div class="card">

            <div class="card-title">
                💰 Informations de la vente
            </div>


            <div class="info-row">

                <span class="info-label">
                    Numéro de vente
                </span>

                <span class="info-value">
                    #{{ $vente->id }}
                </span>

            </div>


            <div class="info-row">

                <span class="info-label">
                    Date de vente
                </span>

                <span class="info-value">
                    {{ $vente->date_vente->format('d/m/Y') }}
                </span>

            </div>


            <div class="info-row">

                <span class="info-label">
                    Mode de paiement
                </span>

                <span class="info-value">
                    {{ $vente->mode_paiement }}
                </span>

            </div>


            <div class="info-row">

                <span class="info-label">
                    Statut
                </span>

                <span class="info-value">
                    {{ $vente->statut }}
                </span>

            </div>


            <div class="info-row">

                <span class="info-label">
                    Prix de vente
                </span>

                <span class="info-value price-value">
                    {{ number_format($vente->prix_vente, 0, ',', ' ') }} Ar
                </span>

            </div>

        </div>


        {{-- =========================
             VEHICULE
        ========================== --}}

        <div class="card full">

            <div class="card-title">
                🚗 Véhicule vendu
            </div>


            <div class="vehicle-box">

                @if($vente->vehicule->image)

                    <img
                        src="{{ asset('storage/' . $vente->vehicule->image) }}"
                        alt="{{ $vente->vehicule->marque->nom }} {{ $vente->vehicule->modele }}"
                        class="vehicle-image"
                    >

                @else

                    <div class="vehicle-placeholder">
                        🚗
                    </div>

                @endif


                <div class="vehicle-info">

                    <h3>
                        {{ $vente->vehicule->marque->nom }}
                        {{ $vente->vehicule->modele }}
                    </h3>


                    <p>
                        <strong>Année :</strong>
                        {{ $vente->vehicule->annee }}
                    </p>


                    <p>
                        <strong>Kilométrage :</strong>
                        {{ number_format($vente->vehicule->kilometrage, 0, ',', ' ') }}
                        km
                    </p>


                    <p>
                        <strong>Carburant :</strong>
                        {{ $vente->vehicule->carburant }}
                    </p>


                    <p>
                        <strong>Boîte :</strong>
                        {{ $vente->vehicule->boite_vitesse }}
                    </p>


                    @if($vente->vehicule->couleur)

                        <p>
                            <strong>Couleur :</strong>
                            {{ $vente->vehicule->couleur }}
                        </p>

                    @endif


                    @if($vente->vehicule->puissance)

                        <p>
                            <strong>Puissance :</strong>
                            {{ number_format($vente->vehicule->puissance, 0, ',', ' ') }}
                            CV
                        </p>

                    @endif


                    <p class="vehicle-price">
                        {{ number_format($vente->prix_vente, 0, ',', ' ') }} Ar
                    </p>


                    <a
                        href="{{ route('vehicules.show', $vente->vehicule) }}"
                        class="vehicle-link"
                    >
                        Voir les détails du véhicule →
                    </a>

                </div>

            </div>

        </div>


        {{-- =========================
             PAIEMENT
        ========================== --}}

        <div class="card full">

            <div class="card-title">
                💳 Résumé du paiement
            </div>


            <div class="payment-box">

                <div class="payment-item">

                    <span>
                        Montant total
                    </span>

                    <strong>
                        {{ number_format($vente->prix_vente, 0, ',', ' ') }} Ar
                    </strong>

                </div>


                <div class="payment-item">

                    <span>
                        Mode de paiement
                    </span>

                    <strong>
                        {{ $vente->mode_paiement }}
                    </strong>

                </div>


                <div class="payment-item">

                    <span>
                        État de la transaction
                    </span>

                    <strong>

                        @if($vente->statut === 'Confirmee')
                            ✓ Confirmée
                        @elseif($vente->statut === 'En attente')
                            ◷ En attente
                        @else
                            ✕ Annulée
                        @endif

                    </strong>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
         ACTIONS
    ========================== --}}

    <div class="actions">

        <button
            type="button"
            onclick="window.print()"
            class="btn btn-print"
        >
            🖨️ Imprimer
        </button>


        <a
            href="{{ route('ventes.edit', $vente) }}"
            class="btn btn-primary"
        >
            ✏️ Modifier
        </a>


        <a
            href="{{ route('ventes.index') }}"
            class="btn btn-secondary"
        >
            ← Retour
        </a>

        <a
                href="{{ route('ventes.facture', $vente) }}"
                class="btn btn-primary"
            >
                🧾 Voir la facture
        </a>

    </div>

</div>

@endsection