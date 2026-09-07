@extends('layouts.client')

@section('title', 'Mon compte — LUXORA MOTORS')

@push('styles')
<style>
    .account-page {
        min-height: 100vh;
        padding: 150px 6% 80px;
        background:
            radial-gradient(circle at top right, rgba(229, 9, 20, 0.10), transparent 35%),
            #080808;
    }

    .account-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* =========================
       HEADER
    ========================= */

    .account-header {
        margin-bottom: 45px;
    }

    .account-label {
        display: inline-block;
        color: #e50914;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .account-header h1 {
        font-size: clamp(34px, 5vw, 58px);
        font-weight: 800;
        letter-spacing: -1px;
        margin-bottom: 12px;
    }

    .account-header p {
        color: #888;
        font-size: 15px;
        line-height: 1.8;
    }

    /* =========================
       GRID
    ========================= */

    .account-grid {
        display: grid;
        grid-template-columns: 380px 1fr;
        gap: 30px;
        align-items: start;
    }

    /* =========================
       CARD
    ========================= */

    .account-card {
        background: #101010;
        border: 1px solid rgba(255,255,255,0.08);
        padding: 30px;
    }

    .card-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 28px;
        padding-bottom: 18px;
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }

    .card-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(229, 9, 20, 0.10);
        border: 1px solid rgba(229, 9, 20, 0.25);
        color: #e50914;
        font-size: 18px;
    }

    .card-title h2 {
        font-size: 16px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* =========================
       PROFILE
    ========================= */

    .profile-avatar {
        width: 85px;
        height: 85px;
        margin-bottom: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(
            135deg,
            #e50914,
            #650000
        );
        font-size: 30px;
        font-weight: 800;
        border-radius: 50%;
    }

    .profile-name {
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .profile-email {
        color: #777;
        font-size: 13px;
        margin-bottom: 30px;
    }

    .info-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .info-label {
        color: #666;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-weight: 700;
    }

    .info-value {
        color: #ddd;
        font-size: 13px;
        line-height: 1.5;
        word-break: break-word;
    }

    .profile-actions {
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid rgba(255,255,255,0.08);
    }

    .edit-button {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        padding: 13px 20px;
        background: #e50914;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: 0.3s ease;
    }

    .edit-button:hover {
        background: #b80710;
        transform: translateY(-2px);
    }

    /* =========================
       RENDEZ-VOUS
    ========================= */

    .appointments-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
    }

    .appointment-count {
        color: #777;
        font-size: 12px;
    }

    .appointment-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .appointment-card {
        display: grid;
        grid-template-columns: 190px 1fr auto;
        gap: 25px;
        align-items: center;
        padding: 18px;
        background: #0b0b0b;
        border: 1px solid rgba(255,255,255,0.07);
        transition: 0.3s ease;
    }

    .appointment-card:hover {
        border-color: rgba(229,9,20,0.35);
        transform: translateY(-2px);
    }

    .appointment-image {
        width: 190px;
        height: 125px;
        overflow: hidden;
        background: #151515;
    }

    .appointment-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .appointment-card:hover .appointment-image img {
        transform: scale(1.05);
    }

    .appointment-info {
        min-width: 0;
    }

    .appointment-brand {
        color: #e50914;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    .appointment-model {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .appointment-details {
        display: flex;
        flex-wrap: wrap;
        gap: 18px;
        color: #888;
        font-size: 12px;
    }

    .appointment-detail strong {
        color: #ddd;
        font-weight: 600;
    }

    /* =========================
       STATUS
    ========================= */

    .appointment-status {
        min-width: 100px;
        text-align: center;
    }

    .status {
        display: inline-block;
        padding: 8px 12px;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        white-space: nowrap;
    }

    .status-pending {
        color: #f0ad4e;
        background: rgba(240,173,78,0.10);
        border: 1px solid rgba(240,173,78,0.25);
    }

    .status-confirmed {
        color: #5cb85c;
        background: rgba(92,184,92,0.10);
        border: 1px solid rgba(92,184,92,0.25);
    }

    .status-cancelled {
        color: #e50914;
        background: rgba(229,9,20,0.10);
        border: 1px solid rgba(229,9,20,0.25);
    }

    /* =========================
       EMPTY
    ========================= */

    .empty-state {
        padding: 70px 30px;
        text-align: center;
        background: #0b0b0b;
        border: 1px dashed rgba(255,255,255,0.10);
    }

    .empty-icon {
        font-size: 40px;
        color: #333;
        margin-bottom: 18px;
    }

    .empty-state h3 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .empty-state p {
        color: #666;
        font-size: 13px;
        margin-bottom: 25px;
    }

    .catalogue-button {
        display: inline-flex;
        padding: 12px 22px;
        border: 1px solid #e50914;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: 0.3s ease;
    }

    .catalogue-button:hover {
        background: #e50914;
    }

    /* =========================
       ALERT
    ========================= */

    .success-message {
        margin-bottom: 30px;
        padding: 15px 18px;
        background: rgba(92,184,92,0.08);
        border: 1px solid rgba(92,184,92,0.20);
        color: #7ed67e;
        font-size: 13px;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1100px) {
        .account-grid {
            grid-template-columns: 1fr;
        }

        .appointment-card {
            grid-template-columns: 160px 1fr;
        }

        .appointment-image {
            width: 160px;
        }

        .appointment-status {
            grid-column: 2;
            text-align: left;
        }
    }

    @media (max-width: 700px) {
        .account-page {
            padding: 120px 5% 60px;
        }

        .account-card {
            padding: 22px;
        }

        .appointment-card {
            grid-template-columns: 1fr;
        }

        .appointment-image {
            width: 100%;
            height: 190px;
        }

        .appointment-status {
            grid-column: auto;
            text-align: left;
        }

        .appointment-details {
            flex-direction: column;
            gap: 8px;
        }
    }
</style>
@endpush

@section('content')

<div class="account-page">

    <div class="account-container">

        {{-- HEADER --}}
        <div class="account-header">

            <span class="account-label">
                Espace personnel
            </span>

            <h1>
                Mon compte
            </h1>

            <p>
                Bienvenue dans votre espace personnel LUXORA MOTORS,
                {{ $client->prenom }}.
            </p>

        </div>


        {{-- MESSAGE --}}
        @if(session('success'))

            <div class="success-message">
                {{ session('success') }}
            </div>

        @endif


        <div class="account-grid">

            {{-- =========================
                 INFORMATIONS CLIENT
            ========================= --}}

            <div class="account-card">

                <div class="card-title">

                    <div class="card-icon">
                        👤
                    </div>

                    <h2>
                        Mes informations
                    </h2>

                </div>


                <div class="profile-avatar">

                    {{ strtoupper(substr($client->prenom, 0, 1)) }}

                </div>


                <div class="profile-name">

                    {{ $client->prenom }} {{ $client->nom }}

                </div>

                <div class="profile-email">

                    {{ $client->email }}

                </div>


                <div class="info-list">

                    <div class="info-item">

                        <span class="info-label">
                            Téléphone
                        </span>

                        <span class="info-value">
                            {{ $client->telephone ?: 'Non renseigné' }}
                        </span>

                    </div>


                    <div class="info-item">

                        <span class="info-label">
                            Adresse
                        </span>

                        <span class="info-value">
                            {{ $client->adresse ?: 'Non renseignée' }}
                        </span>

                    </div>


                    <div class="info-item">

                        <span class="info-label">
                            Email
                        </span>

                        <span class="info-value">
                            {{ $client->email }}
                        </span>

                    </div>

                </div>


                <div class="profile-actions">

                    <a href="{{ route('profile.edit') }}" class="edit-button">
                        Modifier mon profil
                    </a>

                </div>

            </div>


            {{-- =========================
                 RENDEZ-VOUS
            ========================= --}}

            <div class="account-card">

                <div class="appointments-header">

                    <div class="card-title" style="margin-bottom: 0; border-bottom: none; padding-bottom: 0;">

                        <div class="card-icon">
                            📅
                        </div>

                        <h2>
                            Mes rendez-vous
                        </h2>

                    </div>

                    <span class="appointment-count">
                        {{ $client->rendezVous->count() }}
                        rendez-vous
                    </span>

                </div>


                @if($client->rendezVous->count() > 0)

                    <div class="appointment-list">

                        @foreach($client->rendezVous as $rendezVous)

                            <div class="appointment-card">

                                {{-- IMAGE --}}
                                <div class="appointment-image">

                                    @if($rendezVous->vehicule && $rendezVous->vehicule->image)

                                        <img
                                            src="{{ asset('storage/' . $rendezVous->vehicule->image) }}"
                                            alt="{{ $rendezVous->vehicule->modele }}"
                                        >

                                    @else

                                        <img
                                            src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?auto=format&fit=crop&w=800&q=80"
                                            alt="Véhicule LUXORA MOTORS"
                                        >

                                    @endif

                                </div>


                                {{-- INFORMATIONS --}}
                                <div class="appointment-info">

                                    @if($rendezVous->vehicule)

                                        <div class="appointment-brand">
                                            {{ $rendezVous->vehicule->marque->nom ?? 'LUXORA MOTORS' }}
                                        </div>

                                        <div class="appointment-model">
                                            {{ $rendezVous->vehicule->modele }}
                                        </div>

                                    @else

                                        <div class="appointment-model">
                                            Véhicule indisponible
                                        </div>

                                    @endif


                                    <div class="appointment-details">

                                        <span class="appointment-detail">
                                            📅
                                            <strong>
                                                {{ $rendezVous->date_rendez_vous->format('d/m/Y') }}
                                            </strong>
                                        </span>

                                        <span class="appointment-detail">
                                            🕐
                                            <strong>
                                                {{ substr($rendezVous->heure, 0, 5) }}
                                            </strong>
                                        </span>

                                    </div>

                                </div>


                                {{-- STATUT --}}
                                <div class="appointment-status">

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

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="empty-state">

                        <div class="empty-icon">
                            📅
                        </div>

                        <h3>
                            Aucun rendez-vous
                        </h3>

                        <p>
                            Vous n'avez encore pris aucun rendez-vous
                            avec LUXORA MOTORS.
                        </p>

                        <a
                            href="{{ route('client.vehicules') }}"
                            class="catalogue-button"
                        >
                            Découvrir nos véhicules
                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection
