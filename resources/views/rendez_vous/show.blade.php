@extends('layouts.app')

@section('title', 'Détails du rendez-vous')

@section('styles')
<style>
    .rdv-show {
        max-width: 1400px;
        margin: 0 auto;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
    }

    .page-header h1 {
        margin: 0;
        font-size: 32px;
        font-weight: 800;
        color: #fff;
    }

    .page-header p {
        margin: 8px 0 0;
        color: #888;
    }

    .header-actions {
        display: flex;
        gap: 12px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 18px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 700;
        border: 1px solid #333;
        transition: .2s;
    }

    .btn-secondary {
        color: #ddd;
        background: #111;
    }

    .btn-secondary:hover {
        border-color: #555;
        background: #181818;
    }

    .btn-primary {
        color: #fff;
        background: #e50914;
        border-color: #e50914;
    }

    .btn-primary:hover {
        background: #ff1722;
    }

    .show-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 24px;
    }

    .card {
        background: #0d0d0d;
        border: 1px solid #242424;
        border-radius: 18px;
        overflow: hidden;
    }

    .card-header {
        padding: 22px 24px;
        border-bottom: 1px solid #222;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h2 {
        margin: 0;
        color: #fff;
        font-size: 19px;
    }

    .card-body {
        padding: 24px;
    }

    /* CLIENT */

    .client-profile {
        display: flex;
        align-items: center;
        gap: 18px;
        margin-bottom: 28px;
    }

    .avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: #e50914;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 800;
    }

    .client-profile h3 {
        margin: 0 0 6px;
        color: #fff;
        font-size: 22px;
    }

    .client-profile p {
        margin: 0;
        color: #888;
    }

    .info-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .info-item {
        padding: 16px;
        background: #121212;
        border: 1px solid #222;
        border-radius: 12px;
    }

    .info-label {
        display: block;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #777;
        margin-bottom: 6px;
    }

    .info-value {
        color: #eee;
        font-size: 15px;
    }

    /* RDV */

    .rdv-main {
        position: relative;
    }

    .status {
        display: inline-flex;
        align-items: center;
        padding: 7px 13px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 800;
    }

    .status-pending {
        background: rgba(255, 193, 7, .12);
        color: #ffc107;
    }

    .status-confirmed {
        background: rgba(40, 167, 69, .12);
        color: #28a745;
    }

    .status-cancelled {
        background: rgba(229, 9, 20, .12);
        color: #ff4d58;
    }

    .appointment-box {
        background: linear-gradient(
            135deg,
            rgba(229, 9, 20, .14),
            rgba(229, 9, 20, .02)
        );
        border: 1px solid rgba(229, 9, 20, .3);
        border-radius: 16px;
        padding: 25px;
        margin-bottom: 24px;
    }

    .appointment-date {
        font-size: 30px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 8px;
    }

    .appointment-time {
        color: #e50914;
        font-size: 18px;
        font-weight: 700;
    }

    .appointment-details {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
        margin-top: 22px;
    }

    .detail-box {
        background: #111;
        border: 1px solid #242424;
        border-radius: 12px;
        padding: 15px;
    }

    .detail-box small {
        display: block;
        color: #777;
        margin-bottom: 5px;
    }

    .detail-box strong {
        color: #eee;
    }

    /* VEHICULE */

    .vehicle-card {
        display: grid;
        grid-template-columns: 180px 1fr;
        gap: 20px;
        align-items: center;
        background: #111;
        border: 1px solid #242424;
        border-radius: 14px;
        padding: 14px;
    }

    .vehicle-image {
        width: 180px;
        height: 125px;
        border-radius: 10px;
        overflow: hidden;
        background: #181818;
    }

    .vehicle-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .vehicle-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #555;
        font-size: 35px;
    }

    .vehicle-info h3 {
        margin: 0 0 6px;
        color: #fff;
        font-size: 20px;
    }

    .vehicle-brand {
        color: #e50914;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .vehicle-specs {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .spec {
        padding: 6px 10px;
        background: #1a1a1a;
        border-radius: 7px;
        color: #aaa;
        font-size: 12px;
    }

    /* MESSAGE */

    .message-box {
        margin-top: 24px;
        background: #111;
        border: 1px solid #242424;
        border-radius: 14px;
        padding: 20px;
    }

    .message-box h3 {
        margin: 0 0 12px;
        color: #fff;
        font-size: 16px;
    }

    .message-box p {
        margin: 0;
        color: #aaa;
        line-height: 1.7;
        white-space: pre-line;
    }

    .empty-message {
        color: #555;
        font-style: italic;
    }

    @media (max-width: 1000px) {
        .show-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 650px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .appointment-details {
            grid-template-columns: 1fr;
        }

        .vehicle-card {
            grid-template-columns: 1fr;
        }

        .vehicle-image {
            width: 100%;
            height: 180px;
        }
    }
</style>
@endsection

@section('content')

<div class="rdv-show">

    {{-- HEADER --}}
    <div class="page-header">

        <div>
            <h1>Détails du rendez-vous</h1>
            <p>Informations complètes sur ce rendez-vous</p>
        </div>

        <div class="header-actions">

            <a href="{{ route('rendez_vous.index') }}"
               class="btn btn-secondary">
                ← Retour
            </a>

            <a href="{{ route('rendez_vous.edit', $rendezVous) }}"
               class="btn btn-primary">
                ✏️ Modifier
            </a>

        </div>

    </div>


    <div class="show-grid">

        {{-- ================= CLIENT ================= --}}
        <div class="card">

            <div class="card-header">
                <h2>👤 Client</h2>
            </div>

            <div class="card-body">

                <div class="client-profile">

                    <div class="avatar">
                        {{ strtoupper(substr($rendezVous->client->prenom, 0, 1)) }}{{ strtoupper(substr($rendezVous->client->nom, 0, 1)) }}
                    </div>

                    <div>
                        <h3>
                            {{ $rendezVous->client->prenom }}
                            {{ $rendezVous->client->nom }}
                        </h3>

                        <p>Client LUXORA MOTORS</p>
                    </div>

                </div>


                <div class="info-list">

                    <div class="info-item">
                        <span class="info-label">Nom complet</span>

                        <div class="info-value">
                            {{ $rendezVous->client->prenom }}
                            {{ $rendezVous->client->nom }}
                        </div>
                    </div>


                    <div class="info-item">
                        <span class="info-label">Email</span>

                        <div class="info-value">
                            {{ $rendezVous->client->email }}
                        </div>
                    </div>


                    <div class="info-item">
                        <span class="info-label">Téléphone</span>

                        <div class="info-value">
                            {{ $rendezVous->client->telephone }}
                        </div>
                    </div>


                    @if($rendezVous->client->adresse)

                        <div class="info-item">

                            <span class="info-label">Adresse</span>

                            <div class="info-value">
                                {{ $rendezVous->client->adresse }}
                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- ================= RENDEZ-VOUS ================= --}}
        <div class="card">

            <div class="card-header">

                <h2>📅 Rendez-vous</h2>

                @if($rendezVous->statut === 'En attente')

                    <span class="status status-pending">
                        En attente
                    </span>

                @elseif($rendezVous->statut === 'Confirme')

                    <span class="status status-confirmed">
                        Confirmé
                    </span>

                @else

                    <span class="status status-cancelled">
                        Annulé
                    </span>

                @endif

            </div>


            <div class="card-body">

                <div class="appointment-box">

                    <div class="appointment-date">

                        {{ $rendezVous->date_rendez_vous->translatedFormat('l d F Y') }}

                    </div>

                    <div class="appointment-time">

                        🕐 {{ \Carbon\Carbon::parse($rendezVous->heure)->format('H:i') }}

                    </div>


                    <div class="appointment-details">

                        <div class="detail-box">

                            <small>Date</small>

                            <strong>
                                {{ $rendezVous->date_rendez_vous->format('d/m/Y') }}
                            </strong>

                        </div>


                        <div class="detail-box">

                            <small>Heure</small>

                            <strong>
                                {{ \Carbon\Carbon::parse($rendezVous->heure)->format('H:i') }}
                            </strong>

                        </div>


                        <div class="detail-box">

                            <small>Statut</small>

                            <strong>
                                {{ $rendezVous->statut }}
                            </strong>

                        </div>


                        <div class="detail-box">

                            <small>ID du rendez-vous</small>

                            <strong>
                                #{{ $rendezVous->id }}
                            </strong>

                        </div>

                    </div>

                </div>


                {{-- VEHICULE --}}

                <h2 style="color:#fff;font-size:18px;margin:0 0 14px;">
                    🚘 Véhicule concerné
                </h2>

                <div class="vehicle-card">

                    <div class="vehicle-image">

                        @if($rendezVous->vehicule->image)

                            <img
                                src="{{ asset('storage/' . $rendezVous->vehicule->image) }}"
                                alt="{{ $rendezVous->vehicule->modele }}"
                            >

                        @else

                            <div class="vehicle-placeholder">
                                🚘
                            </div>

                        @endif

                    </div>


                    <div class="vehicle-info">

                        <div class="vehicle-brand">
                            {{ $rendezVous->vehicule->marque->nom }}
                        </div>

                        <h3>
                            {{ $rendezVous->vehicule->modele }}
                        </h3>


                        <div class="vehicle-specs">

                            <span class="spec">
                                📅 {{ $rendezVous->vehicule->annee }}
                            </span>

                            <span class="spec">
                                ⛽ {{ $rendezVous->vehicule->carburant }}
                            </span>

                            <span class="spec">
                                ⚙️ {{ $rendezVous->vehicule->boite_vitesse }}
                            </span>

                            <span class="spec">
                                🎨 {{ $rendezVous->vehicule->couleur ?? 'N/A' }}
                            </span>

                        </div>

                    </div>

                </div>


                {{-- MESSAGE --}}

                <div class="message-box">

                    <h3>💬 Message du client</h3>

                    @if($rendezVous->message)

                        <p>{{ $rendezVous->message }}</p>

                    @else

                        <p class="empty-message">
                            Aucun message n'a été ajouté pour ce rendez-vous.
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection