@extends('layouts.app')

@section('title', 'Détails du client')

@section('content')

<style>
    .client-show {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* HEADER */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
    }

    .page-header-left h1 {
        color: #fff;
        font-size: 30px;
        font-weight: 800;
        margin: 0 0 8px;
    }

    .page-header-left p {
        color: #888;
        margin: 0;
    }

    .header-actions {
        display: flex;
        gap: 10px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 18px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        transition: .2s;
        border: none;
        cursor: pointer;
    }

    .btn-back {
        background: #1c1c1c;
        color: #ccc;
        border: 1px solid #2d2d2d;
    }

    .btn-back:hover {
        background: #272727;
        color: #fff;
    }

    .btn-edit {
        background: #e50914;
        color: #fff;
    }

    .btn-edit:hover {
        background: #c70711;
        transform: translateY(-1px);
    }

    /* PROFILE */
    .profile-card {
        background: #101010;
        border: 1px solid #252525;
        border-radius: 18px;
        padding: 30px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 25px;
        box-shadow: 0 15px 40px rgba(0,0,0,.25);
    }

    .avatar {
        width: 95px;
        height: 95px;
        min-width: 95px;
        border-radius: 50%;
        background: linear-gradient(135deg, #e50914, #650007);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 30px;
        font-weight: 800;
        border: 3px solid #2d2d2d;
        box-shadow: 0 0 30px rgba(229,9,20,.2);
    }

    .profile-info h2 {
        color: #fff;
        font-size: 26px;
        margin: 0 0 8px;
        font-weight: 800;
    }

    .profile-info p {
        color: #888;
        margin: 4px 0;
        font-size: 14px;
    }

    .profile-info .email {
        color: #e50914;
    }

    /* STATISTICS */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: #101010;
        border: 1px solid #252525;
        border-radius: 15px;
        padding: 22px;
        position: relative;
        overflow: hidden;
    }

    .stat-card::after {
        content: "";
        position: absolute;
        width: 80px;
        height: 80px;
        background: rgba(229,9,20,.06);
        border-radius: 50%;
        right: -25px;
        top: -25px;
    }

    .stat-label {
        color: #777;
        font-size: 13px;
        margin-bottom: 8px;
    }

    .stat-value {
        color: #fff;
        font-size: 28px;
        font-weight: 800;
    }

    .stat-icon {
        color: #e50914;
        font-size: 22px;
        margin-bottom: 12px;
    }

    /* GRID */
    .content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    .section-card {
        background: #101010;
        border: 1px solid #252525;
        border-radius: 18px;
        padding: 25px;
        box-shadow: 0 15px 40px rgba(0,0,0,.2);
    }

    .section-card.full {
        grid-column: 1 / -1;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #fff;
        font-size: 18px;
        font-weight: 750;
        margin-bottom: 22px;
        padding-bottom: 15px;
        border-bottom: 1px solid #252525;
    }

    .section-title span {
        width: 4px;
        height: 22px;
        background: #e50914;
        border-radius: 4px;
    }

    /* INFORMATIONS */
    .info-list {
        display: flex;
        flex-direction: column;
        gap: 17px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        padding-bottom: 14px;
        border-bottom: 1px solid #1d1d1d;
    }

    .info-item:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }

    .info-label {
        color: #777;
        font-size: 13px;
    }

    .info-value {
        color: #eee;
        font-size: 14px;
        font-weight: 600;
        text-align: right;
    }

    /* VENTES */
    .sale-item {
        background: #080808;
        border: 1px solid #222;
        border-radius: 12px;
        padding: 17px;
        margin-bottom: 12px;
    }

    .sale-item:last-child {
        margin-bottom: 0;
    }

    .sale-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 12px;
    }

    .vehicle-name {
        color: #fff;
        font-size: 15px;
        font-weight: 700;
    }

    .vehicle-brand {
        color: #888;
        font-size: 12px;
        margin-top: 3px;
    }

    .sale-price {
        color: #e50914;
        font-weight: 800;
        font-size: 16px;
        white-space: nowrap;
    }

    .sale-details {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .badge {
        background: #181818;
        border: 1px solid #2a2a2a;
        color: #aaa;
        padding: 6px 9px;
        border-radius: 7px;
        font-size: 11px;
    }

    .badge-success {
        color: #55d68a;
        border-color: rgba(85,214,138,.25);
        background: rgba(85,214,138,.07);
    }

    .badge-warning {
        color: #f2c94c;
        border-color: rgba(242,201,76,.25);
        background: rgba(242,201,76,.07);
    }

    .badge-danger {
        color: #ff5964;
        border-color: rgba(255,89,100,.25);
        background: rgba(255,89,100,.07);
    }

    /* RENDEZ-VOUS */
    .appointment-item {
        background: #080808;
        border: 1px solid #222;
        border-radius: 12px;
        padding: 17px;
        margin-bottom: 12px;
    }

    .appointment-item:last-child {
        margin-bottom: 0;
    }

    .appointment-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 12px;
    }

    .appointment-date {
        color: #fff;
        font-weight: 700;
        font-size: 14px;
    }

    .appointment-vehicle {
        color: #999;
        font-size: 13px;
        margin-top: 4px;
    }

    .appointment-info {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 10px;
    }

    .appointment-message {
        color: #777;
        font-size: 12px;
        line-height: 1.5;
        background: #111;
        border-radius: 8px;
        padding: 10px;
    }

    /* EMPTY */
    .empty-state {
        text-align: center;
        padding: 35px 15px;
        color: #666;
    }

    .empty-state-icon {
        font-size: 32px;
        margin-bottom: 12px;
        opacity: .6;
    }

    .empty-state p {
        margin: 0;
        font-size: 13px;
    }

    /* RESPONSIVE */
    @media (max-width: 850px) {
        .content-grid {
            grid-template-columns: 1fr;
        }

        .section-card.full {
            grid-column: auto;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .header-actions {
            width: 100%;
        }

        .header-actions .btn {
            flex: 1;
            justify-content: center;
        }
    }

    @media (max-width: 600px) {
        .profile-card {
            flex-direction: column;
            text-align: center;
        }

        .info-item {
            flex-direction: column;
            gap: 5px;
        }

        .info-value {
            text-align: left;
        }

        .sale-top,
        .appointment-top {
            align-items: flex-start;
            flex-direction: column;
        }

        .sale-price {
            font-size: 15px;
        }
    }
</style>

<div class="client-show">

    {{-- HEADER --}}
    <div class="page-header">

        <div class="page-header-left">
            <h1>Détails du client</h1>
            <p>Informations et historique du client.</p>
        </div>

        <div class="header-actions">

            <a href="{{ route('clients.index') }}" class="btn btn-back">
                ← Retour
            </a>

            <a href="{{ route('clients.edit', $client) }}" class="btn btn-edit">
                ✎ Modifier
            </a>

        </div>

    </div>


    {{-- PROFIL --}}
    <div class="profile-card">

        @php
            $initials = strtoupper(
                substr($client->prenom, 0, 1) .
                substr($client->nom, 0, 1)
            );
        @endphp

        <div class="avatar">
            {{ $initials }}
        </div>

        <div class="profile-info">

            <h2>
                {{ $client->prenom }} {{ $client->nom }}
            </h2>

            <p class="email">
                {{ $client->email }}
            </p>

            <p>
                ☎ {{ $client->telephone }}
            </p>

        </div>

    </div>


    {{-- STATISTIQUES --}}
    <div class="stats-grid">

        <div class="stat-card">

            <div class="stat-icon">🚗</div>

            <div class="stat-label">
                Véhicules achetés
            </div>

            <div class="stat-value">
                {{ $client->ventes->count() }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon">📅</div>

            <div class="stat-label">
                Rendez-vous
            </div>

            <div class="stat-value">
                {{ $client->rendezVous->count() }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon">💰</div>

            <div class="stat-label">
                Total des achats
            </div>

            <div class="stat-value">
                {{ number_format($client->ventes->sum('prix_vente'), 0, ',', ' ') }} Ar
            </div>

        </div>

    </div>


    {{-- CONTENU --}}
    <div class="content-grid">


        {{-- INFORMATIONS PERSONNELLES --}}
        <div class="section-card">

            <div class="section-title">
                <span></span>
                Informations personnelles
            </div>

            <div class="info-list">

                <div class="info-item">
                    <div class="info-label">Nom</div>

                    <div class="info-value">
                        {{ $client->nom }}
                    </div>
                </div>


                <div class="info-item">
                    <div class="info-label">Prénom</div>

                    <div class="info-value">
                        {{ $client->prenom }}
                    </div>
                </div>


                <div class="info-item">
                    <div class="info-label">Email</div>

                    <div class="info-value">
                        {{ $client->email }}
                    </div>
                </div>


                <div class="info-item">
                    <div class="info-label">Téléphone</div>

                    <div class="info-value">
                        {{ $client->telephone }}
                    </div>
                </div>


                <div class="info-item">
                    <div class="info-label">Adresse</div>

                    <div class="info-value">
                        {{ $client->adresse ?: 'Non renseignée' }}
                    </div>
                </div>

            </div>

        </div>


        {{-- RÉSUMÉ --}}
        <div class="section-card">

            <div class="section-title">
                <span></span>
                Résumé du client
            </div>

            <div class="info-list">

                <div class="info-item">
                    <div class="info-label">Client depuis</div>

                    <div class="info-value">
                        {{ $client->created_at->format('d/m/Y') }}
                    </div>
                </div>


                <div class="info-item">
                    <div class="info-label">Nombre de ventes</div>

                    <div class="info-value">
                        {{ $client->ventes->count() }}
                    </div>
                </div>


                <div class="info-item">
                    <div class="info-label">Nombre de rendez-vous</div>

                    <div class="info-value">
                        {{ $client->rendezVous->count() }}
                    </div>
                </div>


                <div class="info-item">
                    <div class="info-label">Montant total</div>

                    <div class="info-value" style="color:#e50914;">
                        {{ number_format($client->ventes->sum('prix_vente'), 0, ',', ' ') }} Ar
                    </div>
                </div>

            </div>

        </div>


        {{-- HISTORIQUE DES VENTES --}}
        <div class="section-card full">

            <div class="section-title">
                <span></span>
                Historique des ventes
            </div>

            @forelse($client->ventes as $vente)

                <div class="sale-item">

                    <div class="sale-top">

                        <div>
                            <div class="vehicle-name">

                                @if($vente->vehicule)
                                    {{ $vente->vehicule->modele }}
                                @else
                                    Véhicule supprimé
                                @endif

                            </div>

                            @if($vente->vehicule && $vente->vehicule->marque)
                                <div class="vehicle-brand">
                                    {{ $vente->vehicule->marque->nom }}
                                </div>
                            @endif

                        </div>

                        <div class="sale-price">
                            {{ number_format($vente->prix_vente, 0, ',', ' ') }} Ar
                        </div>

                    </div>


                    <div class="sale-details">

                        <span class="badge">
                            📅
                            {{ $vente->date_vente
                                ? $vente->date_vente->format('d/m/Y')
                                : 'Date inconnue'
                            }}
                        </span>

                        <span class="badge">
                            💳 {{ $vente->mode_paiement }}
                        </span>


                        @if($vente->statut === 'Confirmee')

                            <span class="badge badge-success">
                                ✓ Confirmée
                            </span>

                        @elseif($vente->statut === 'En attente')

                            <span class="badge badge-warning">
                                ⏳ En attente
                            </span>

                        @else

                            <span class="badge badge-danger">
                                ✕ Annulée
                            </span>

                        @endif

                    </div>

                </div>

            @empty

                <div class="empty-state">

                    <div class="empty-state-icon">
                        🚗
                    </div>

                    <p>
                        Ce client n'a encore effectué aucun achat.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- HISTORIQUE DES RENDEZ-VOUS --}}
        <div class="section-card full">

            <div class="section-title">
                <span></span>
                Historique des rendez-vous
            </div>

            @forelse($client->rendezVous as $rendezVous)

                <div class="appointment-item">

                    <div class="appointment-top">

                        <div>

                            <div class="appointment-date">

                                📅
                                {{ $rendezVous->date_rendez_vous
                                    ? $rendezVous->date_rendez_vous->format('d/m/Y')
                                    : 'Date inconnue'
                                }}

                                @if($rendezVous->heure)
                                    — {{ substr($rendezVous->heure, 0, 5) }}
                                @endif

                            </div>


                            <div class="appointment-vehicle">

                                🚘

                                @if($rendezVous->vehicule)

                                    {{ $rendezVous->vehicule->modele }}

                                    @if($rendezVous->vehicule->marque)
                                        — {{ $rendezVous->vehicule->marque->nom }}
                                    @endif

                                @else
                                    Véhicule supprimé
                                @endif

                            </div>

                        </div>


                        @if($rendezVous->statut === 'Confirme')

                            <span class="badge badge-success">
                                ✓ Confirmé
                            </span>

                        @elseif($rendezVous->statut === 'En attente')

                            <span class="badge badge-warning">
                                ⏳ En attente
                            </span>

                        @else

                            <span class="badge badge-danger">
                                ✕ Annulé
                            </span>

                        @endif

                    </div>


                    @if($rendezVous->message)

                        <div class="appointment-message">
                            {{ $rendezVous->message }}
                        </div>

                    @endif

                </div>

            @empty

                <div class="empty-state">

                    <div class="empty-state-icon">
                        📅
                    </div>

                    <p>
                        Ce client n'a encore aucun rendez-vous.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection