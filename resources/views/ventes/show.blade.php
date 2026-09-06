@extends('layouts.app')

@section('title', 'Détails du rendez-vous')

@section('content')

<style>
    .appointment-show {
        max-width: 1200px;
        margin: 0 auto;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #999;
        text-decoration: none;
        margin-bottom: 25px;
        transition: 0.3s;
    }

    .back-link:hover {
        color: #e50914;
    }

    .appointment-header {
        background: linear-gradient(135deg, #111, #080808);
        border: 1px solid #252525;
        border-radius: 18px;
        padding: 30px;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .appointment-header h1 {
        margin: 0 0 8px;
        font-size: 30px;
        color: #fff;
    }

    .appointment-header p {
        margin: 0;
        color: #888;
    }

    .status {
        padding: 9px 16px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .status.pending {
        background: rgba(255, 193, 7, .12);
        color: #ffc107;
    }

    .status.confirmed {
        background: rgba(40, 167, 69, .12);
        color: #28a745;
    }

    .status.cancelled {
        background: rgba(229, 9, 20, .12);
        color: #e50914;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .card {
        background: #0d0d0d;
        border: 1px solid #252525;
        border-radius: 18px;
        padding: 25px;
    }

    .card.full {
        grid-column: 1 / -1;
    }

    .card-title {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #e50914;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #222;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        padding: 13px 0;
        border-bottom: 1px solid #181818;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        color: #777;
    }

    .info-value {
        color: #fff;
        font-weight: 600;
        text-align: right;
    }

    .vehicle-box {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .vehicle-image {
        width: 180px;
        height: 120px;
        object-fit: cover;
        border-radius: 12px;
        background: #151515;
    }

    .vehicle-info h3 {
        color: #fff;
        margin: 0 0 8px;
        font-size: 22px;
    }

    .vehicle-info p {
        margin: 5px 0;
        color: #888;
    }

    .vehicle-price {
        color: #e50914 !important;
        font-size: 20px;
        font-weight: 800;
        margin-top: 12px !important;
    }

    .message {
        color: #aaa;
        line-height: 1.7;
        background: #080808;
        border-radius: 12px;
        padding: 18px;
    }

    .actions {
        display: flex;
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
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: .3s;
    }

    .btn-primary {
        background: #e50914;
        color: #fff;
    }

    .btn-primary:hover {
        background: #ff1a25;
        transform: translateY(-2px);
    }

    .btn-secondary {
        background: #1a1a1a;
        color: #ccc;
        border: 1px solid #292929;
    }

    .btn-secondary:hover {
        color: #fff;
        border-color: #444;
    }

    @media (max-width: 800px) {
        .details-grid {
            grid-template-columns: 1fr;
        }

        .card.full {
            grid-column: auto;
        }

        .appointment-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .vehicle-box {
            flex-direction: column;
            align-items: flex-start;
        }

        .vehicle-image {
            width: 100%;
            height: 200px;
        }
    }
</style>

<div class="appointment-show">

    <a href="{{ route('rendez_vous.index') }}" class="back-link">
        ← Retour aux rendez-vous
    </a>

    <div class="appointment-header">
        <div>
            <h1>Détails du rendez-vous</h1>

            <p>
                Rendez-vous #{{ $rendezVous->id }}
            </p>
        </div>

        @if($rendezVous->statut === 'En attente')
            <span class="status pending">
                En attente
            </span>
        @elseif($rendezVous->statut === 'Confirme')
            <span class="status confirmed">
                Confirmé
            </span>
        @else
            <span class="status cancelled">
                Annulé
            </span>
        @endif
    </div>

    <div class="details-grid">

        {{-- CLIENT --}}
        <div class="card">

            <div class="card-title">
                👤 Informations du client
            </div>

            <div class="info-row">
                <span class="info-label">Nom</span>

                <span class="info-value">
                    {{ $rendezVous->client->nom }}
                    {{ $rendezVous->client->prenom }}
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">Email</span>

                <span class="info-value">
                    {{ $rendezVous->client->email }}
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">Téléphone</span>

                <span class="info-value">
                    {{ $rendezVous->client->telephone }}
                </span>
            </div>

            @if($rendezVous->client->adresse)
                <div class="info-row">
                    <span class="info-label">Adresse</span>

                    <span class="info-value">
                        {{ $rendezVous->client->adresse }}
                    </span>
                </div>
            @endif

        </div>


        {{-- DATE --}}
        <div class="card">

            <div class="card-title">
                📅 Informations du rendez-vous
            </div>

            <div class="info-row">
                <span class="info-label">Date</span>

                <span class="info-value">
                    {{ $rendezVous->date_rendez_vous->format('d/m/Y') }}
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">Heure</span>

                <span class="info-value">
                    {{ \Carbon\Carbon::parse($rendezVous->heure)->format('H:i') }}
                </span>
            </div>

            <div class="info-row">
                <span class="info-label">Statut</span>

                <span class="info-value">
                    {{ $rendezVous->statut }}
                </span>
            </div>

        </div>


        {{-- VEHICULE --}}
        <div class="card full">

            <div class="card-title">
                🚗 Véhicule concerné
            </div>

            <div class="vehicle-box">

                @if($rendezVous->vehicule->image)

                    <img
                        src="{{ asset('storage/' . $rendezVous->vehicule->image) }}"
                        alt="{{ $rendezVous->vehicule->modele }}"
                        class="vehicle-image"
                    >

                @else

                    <div class="vehicle-image"></div>

                @endif

                <div class="vehicle-info">

                    <h3>
                        {{ $rendezVous->vehicule->marque->nom }}
                        {{ $rendezVous->vehicule->modele }}
                    </h3>

                    <p>
                        Année : {{ $rendezVous->vehicule->annee }}
                    </p>

                    <p>
                        Kilométrage :
                        {{ number_format($rendezVous->vehicule->kilometrage, 0, ',', ' ') }}
                        km
                    </p>

                    <p class="vehicle-price">
                        {{ number_format($rendezVous->vehicule->prix, 0, ',', ' ') }} Ar
                    </p>

                </div>

            </div>

        </div>


        {{-- MESSAGE --}}
        @if($rendezVous->message)

            <div class="card full">

                <div class="card-title">
                    💬 Message du client
                </div>

                <div class="message">
                    {{ $rendezVous->message }}
                </div>

            </div>

        @endif

    </div>


    {{-- ACTIONS --}}
    <div class="actions">

        <a
            href="{{ route('rendez_vous.edit', $rendezVous) }}"
            class="btn btn-primary"
        >
            ✏️ Modifier
        </a>

        <a
            href="{{ route('rendez_vous.index') }}"
            class="btn btn-secondary"
        >
            ← Retour
        </a>

    </div>

</div>

@endsection