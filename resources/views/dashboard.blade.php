@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
<style>
    .dashboard-page {
        max-width: 1600px;
        margin: 0 auto;
    }

    /* =========================
       HEADER
    ========================= */

    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
    }

    .dashboard-title h1 {
        margin: 0 0 8px;
        font-size: 32px;
        font-weight: 800;
        color: #fff;
        letter-spacing: -0.5px;
    }

    .dashboard-title h1 span {
        color: #ed101b;
    }

    .dashboard-title p {
        margin: 0;
        color: #8d8d8d;
        font-size: 14px;
    }

    .dashboard-date {
        padding: 12px 18px;
        background: #111;
        border: 1px solid #252525;
        border-radius: 12px;
        color: #aaa;
        font-size: 13px;
    }

    .dashboard-date strong {
        color: #fff;
    }

    /* =========================
       STAT CARDS
    ========================= */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 24px;
    }

    .stat-card {
        position: relative;
        overflow: hidden;
        background: linear-gradient(145deg, #151515, #0c0c0c);
        border: 1px solid #242424;
        border-radius: 16px;
        padding: 22px;
        transition: 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        border-color: #e50914;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.35);
    }

    .stat-card::after {
        content: "";
        position: absolute;
        width: 100px;
        height: 100px;
        right: -40px;
        top: -40px;
        border-radius: 50%;
        background: rgba(229, 9, 20, 0.08);
    }

    .stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .stat-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(229, 9, 20, 0.12);
        color: #e50914;
        font-size: 20px;
    }

    .stat-label {
        color: #8d8d8d;
        font-size: 13px;
        margin-bottom: 7px;
    }

    .stat-value {
        color: #fff;
        font-size: 26px;
        font-weight: 800;
    }

    .stat-footer {
        margin-top: 14px;
        color: #666;
        font-size: 12px;
    }

    /* =========================
       GRID PRINCIPALE
    ========================= */

    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .dashboard-grid-bottom {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .panel {
        background: #101010;
        border: 1px solid #242424;
        border-radius: 16px;
        overflow: hidden;
    }

    .panel-header {
        padding: 20px 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #222;
    }

    .panel-header h2 {
        margin: 0;
        color: #fff;
        font-size: 17px;
        font-weight: 700;
    }

    .panel-header span {
        color: #666;
        font-size: 12px;
    }

    .panel-body {
        padding: 22px;
    }

    /* =========================
       GRAPHIQUE
    ========================= */

    .chart-container {
        height: 300px;
        display: flex;
        align-items: stretch;
        gap: 14px;
        padding-top: 15px;
    }

    .chart-column {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: center;
        min-width: 0;
    }

    .bar-wrapper {
        width: 100%;
        height: 230px;
        display: flex;
        justify-content: center;
        align-items: flex-end;
    }

    .bar {
        width: min(45px, 70%);
        min-height: 4px;
        background: linear-gradient(to top, #e50914, #ff3b44);
        border-radius: 7px 7px 2px 2px;
        position: relative;
        transition: height 0.5s ease;
    }

    .bar:hover {
        filter: brightness(1.2);
    }

    .bar-value {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        top: -25px;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .chart-month {
        margin-top: 12px;
        color: #777;
        font-size: 11px;
        text-transform: uppercase;
    }

    /* =========================
       VEHICULES STATUS
    ========================= */

    .status-item {
        margin-bottom: 24px;
    }

    .status-item:last-child {
        margin-bottom: 0;
    }

    .status-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 9px;
    }

    .status-name {
        color: #ccc;
        font-size: 13px;
    }

    .status-number {
        color: #fff;
        font-size: 13px;
        font-weight: 700;
    }

    .progress {
        width: 100%;
        height: 8px;
        background: #252525;
        border-radius: 20px;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        width: 0;
        border-radius: 20px;
        transition: width 0.6s ease;
    }

    .progress-bar.available {
        background: #28a745;
    }

    .progress-bar.sold {
        background: #e50914;
    }

    .progress-bar.reserved {
        background: #ffc107;
    }

    /* =========================
       SALES SUMMARY
    ========================= */

    .sales-summary {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .sales-summary-item {
        background: #151515;
        border: 1px solid #242424;
        border-radius: 12px;
        padding: 16px;
        text-align: center;
    }

    .sales-summary-item .number {
        color: #fff;
        font-size: 23px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .sales-summary-item .label {
        color: #777;
        font-size: 11px;
    }

    .sales-summary-item.confirmed .number {
        color: #28a745;
    }

    .sales-summary-item.pending .number {
        color: #ffc107;
    }

    .sales-summary-item.cancelled .number {
        color: #e50914;
    }

    /* =========================
       APPOINTMENTS
    ========================= */

    .appointment-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .appointment-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 13px;
        background: #151515;
        border: 1px solid #242424;
        border-radius: 12px;
    }

    .appointment-date {
        width: 48px;
        min-width: 48px;
        height: 48px;
        background: rgba(229, 9, 20, 0.12);
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .appointment-date .day {
        color: #fff;
        font-size: 17px;
        font-weight: 800;
    }

    .appointment-date .month {
        color: #e50914;
        font-size: 9px;
        text-transform: uppercase;
        font-weight: 700;
    }

    .appointment-info {
        flex: 1;
        min-width: 0;
    }

    .appointment-client {
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .appointment-vehicle {
        color: #777;
        font-size: 11px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .appointment-time {
        color: #aaa;
        font-size: 12px;
    }

    .empty-state {
        text-align: center;
        padding: 35px 15px;
        color: #666;
        font-size: 13px;
    }

    /* =========================
       DERNIERES VENTES
    ========================= */

    .sales-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .sale-item {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 12px;
        background: #151515;
        border: 1px solid #242424;
        border-radius: 12px;
    }

    .sale-image {
        width: 55px;
        height: 45px;
        border-radius: 8px;
        overflow: hidden;
        background: #222;
        flex-shrink: 0;
    }

    .sale-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .sale-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #555;
        font-size: 18px;
    }

    .sale-info {
        flex: 1;
        min-width: 0;
    }

    .sale-vehicle {
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sale-client {
        color: #777;
        font-size: 11px;
        margin-top: 4px;
    }

    .sale-price {
        color: #e50914;
        font-size: 13px;
        font-weight: 800;
        white-space: nowrap;
    }

    /* =========================
       MEILLEURS VEHICULES
    ========================= */

    .top-vehicle-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .top-vehicle {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 12px;
        background: #151515;
        border: 1px solid #242424;
        border-radius: 12px;
    }

    .rank {
        width: 30px;
        height: 30px;
        min-width: 30px;
        border-radius: 8px;
        background: #222;
        color: #aaa;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 12px;
    }

    .rank.first {
        background: rgba(229, 9, 20, 0.15);
        color: #e50914;
    }

    .top-vehicle-info {
        flex: 1;
        min-width: 0;
    }

    .top-vehicle-name {
        color: #fff;
        font-size: 13px;
        font-weight: 700;
    }

    .top-vehicle-brand {
        color: #777;
        font-size: 11px;
        margin-top: 3px;
    }

    .top-vehicle-sales {
        color: #e50914;
        font-size: 12px;
        font-weight: 800;
    }

    /* =========================
       BOUTONS
    ========================= */

    .btn-dashboard {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 14px;
        border-radius: 8px;
        background: #e50914;
        color: #fff;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        transition: 0.2s;
    }

    .btn-dashboard:hover {
        background: #c80712;
        color: #fff;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-grid-bottom {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .sales-summary {
            grid-template-columns: 1fr;
        }

        .dashboard-title h1 {
            font-size: 25px;
        }

        .panel-body {
            padding: 15px;
        }

        .chart-container {
            gap: 7px;
        }
    }
</style>
@endsection

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | Sécurisation des valeurs
    |--------------------------------------------------------------------------
    */

    $totalVehiculesStat = max(
        $vehiculesDisponibles + $vehiculesVendus + $vehiculesReserves,
        1
    );

    $maxVentes = $evolutionVentes->max('ventes');
    $maxVentes = max($maxVentes, 1);

    $pourcentageDisponibles = round(
        ($vehiculesDisponibles / $totalVehiculesStat) * 100,
        1
    );

    $pourcentageVendus = round(
        ($vehiculesVendus / $totalVehiculesStat) * 100,
        1
    );

    $pourcentageReserves = round(
        ($vehiculesReserves / $totalVehiculesStat) * 100,
        1
    );
@endphp

<div class="dashboard-page">

    {{-- =========================
         HEADER
    ========================== --}}

    <div class="dashboard-header">

        <div class="dashboard-title">

            <h1>
                Notre <span>Dashboard</span>
            </h1>

            <p>
                Pilotez efficacement votre activité et suivez les performances de votre concession.
            </p>

        </div>

        <div class="dashboard-date">
            <strong>
                {{ now()->translatedFormat('l d F Y') }}
            </strong>
        </div>

    </div>


    {{-- =========================
         STATISTIQUES
    ========================== --}}

    <div class="stats-grid">

        {{-- Chiffre d'affaires --}}
        <div class="stat-card">

            <div class="stat-top">

                <div>

                    <div class="stat-label">
                        Chiffre d'affaires
                    </div>

                    <div class="stat-value">
                        {{ number_format($chiffreAffaires, 0, ',', ' ') }}
                        <small style="font-size: 12px; color: #777;">
                            Ar
                        </small>
                    </div>

                </div>

                <div class="stat-icon">
                    $
                </div>

            </div>

            <div class="stat-footer">
                Ventes confirmées
            </div>

        </div>


        {{-- Véhicules --}}
        <div class="stat-card">

            <div class="stat-top">

                <div>

                    <div class="stat-label">
                        Véhicules
                    </div>

                    <div class="stat-value">
                        {{ $totalVehicules }}
                    </div>

                </div>

                <div class="stat-icon">
                    🚗
                </div>

            </div>

            <div class="stat-footer">
                {{ $vehiculesDisponibles }} disponibles
            </div>

        </div>


        {{-- Clients --}}
        <div class="stat-card">

            <div class="stat-top">

                <div>

                    <div class="stat-label">
                        Clients
                    </div>

                    <div class="stat-value">
                        {{ $totalClients }}
                    </div>

                </div>

                <div class="stat-icon">
                    👤
                </div>

            </div>

            <div class="stat-footer">
                Clients enregistrés
            </div>

        </div>


        {{-- Rendez-vous --}}
        <div class="stat-card">

            <div class="stat-top">

                <div>

                    <div class="stat-label">
                        Rendez-vous
                    </div>

                    <div class="stat-value">
                        {{ $totalRendezVous }}
                    </div>

                </div>

                <div class="stat-icon">
                    📅
                </div>

            </div>

            <div class="stat-footer">
                {{ $prochainsRendezVous->count() }} prochains rendez-vous
            </div>

        </div>

    </div>


    {{-- =========================
         GRAPHIQUE + STATUS
    ========================== --}}

    <div class="dashboard-grid">

        {{-- Evolution des ventes --}}
        <div class="panel">

            <div class="panel-header">

                <h2>
                    Évolution des ventes
                </h2>

                <span>
                    6 derniers mois
                </span>

            </div>

            <div class="panel-body">

                <div class="chart-container">

                    @foreach($evolutionVentes as $mois)

                        @php
                            $hauteurBarre = round(
                                ($mois['ventes'] / $maxVentes) * 100,
                                1
                            );

                            $hauteurBarre = max($hauteurBarre, 2);
                        @endphp

                        <div class="chart-column">

                            <div class="bar-wrapper">

                                <div
                                    class="bar"
                                    data-height="{{ $hauteurBarre }}"
                                >
                                    <span class="bar-value">
                                        {{ $mois['ventes'] }}
                                    </span>
                                </div>

                            </div>

                            <div class="chart-month">
                                {{ $mois['mois'] }}
                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>


        {{-- Etat des véhicules --}}
        <div class="panel">

            <div class="panel-header">

                <h2>
                    État des véhicules
                </h2>

                <span>
                    {{ $totalVehicules }} total
                </span>

            </div>

            <div class="panel-body">

                {{-- Disponible --}}
                <div class="status-item">

                    <div class="status-header">

                        <span class="status-name">
                            Disponibles
                        </span>

                        <span class="status-number">
                            {{ $vehiculesDisponibles }}
                        </span>

                    </div>

                    <div class="progress">

                        <div
                            class="progress-bar available"
                            data-width="{{ $pourcentageDisponibles }}"
                        ></div>

                    </div>

                </div>


                {{-- Vendus --}}
                <div class="status-item">

                    <div class="status-header">

                        <span class="status-name">
                            Vendus
                        </span>

                        <span class="status-number">
                            {{ $vehiculesVendus }}
                        </span>

                    </div>

                    <div class="progress">

                        <div
                            class="progress-bar sold"
                            data-width="{{ $pourcentageVendus }}"
                        ></div>

                    </div>

                </div>


                {{-- Réservés --}}
                <div class="status-item">

                    <div class="status-header">

                        <span class="status-name">
                            Réservés
                        </span>

                        <span class="status-number">
                            {{ $vehiculesReserves }}
                        </span>

                    </div>

                    <div class="progress">

                        <div
                            class="progress-bar reserved"
                            data-width="{{ $pourcentageReserves }}"
                        ></div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
         VENTES
    ========================== --}}

    <div class="dashboard-grid">

        {{-- Résumé ventes --}}
        <div class="panel">

            <div class="panel-header">

                <h2>
                    Résumé des ventes
                </h2>

                <span>
                    {{ $totalVentes }} ventes
                </span>

            </div>

            <div class="panel-body">

                <div class="sales-summary">

                    <div class="sales-summary-item confirmed">

                        <div class="number">
                            {{ $ventesConfirmees }}
                        </div>

                        <div class="label">
                            Confirmées
                        </div>

                    </div>


                    <div class="sales-summary-item pending">

                        <div class="number">
                            {{ $ventesEnAttente }}
                        </div>

                        <div class="label">
                            En attente
                        </div>

                    </div>


                    <div class="sales-summary-item cancelled">

                        <div class="number">
                            {{ $ventesAnnulees }}
                        </div>

                        <div class="label">
                            Annulées
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Rendez-vous --}}
        <div class="panel">

            <div class="panel-header">

                <h2>
                    Prochains rendez-vous
                </h2>

                <a
                    href="{{ route('rendez_vous.index') }}"
                    class="btn-dashboard"
                >
                    Voir tout
                </a>

            </div>

            <div class="panel-body">

                @if($prochainsRendezVous->count())

                    <div class="appointment-list">

                        @foreach($prochainsRendezVous as $rdv)

                            <div class="appointment-item">

                                <div class="appointment-date">

                                    <div class="day">
                                        {{ $rdv->date_rendez_vous->format('d') }}
                                    </div>

                                    <div class="month">
                                        {{ $rdv->date_rendez_vous->translatedFormat('M') }}
                                    </div>

                                </div>


                                <div class="appointment-info">

                                    <div class="appointment-client">

                                        {{ $rdv->client->prenom }}
                                        {{ $rdv->client->nom }}

                                    </div>

                                    <div class="appointment-vehicle">

                                        {{ $rdv->vehicule->marque->nom }}
                                        {{ $rdv->vehicule->modele }}

                                    </div>

                                </div>


                                <div class="appointment-time">

                                    {{ \Carbon\Carbon::parse($rdv->heure)->format('H:i') }}

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="empty-state">
                        Aucun prochain rendez-vous.
                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- =========================
         DERNIERES VENTES + TOP VEHICULES
    ========================== --}}

    <div class="dashboard-grid-bottom">

        {{-- Dernières ventes --}}
        <div class="panel">

            <div class="panel-header">

                <h2>
                    Dernières ventes
                </h2>

                <a
                    href="{{ route('ventes.index') }}"
                    class="btn-dashboard"
                >
                    Voir tout
                </a>

            </div>

            <div class="panel-body">

                @if($dernieresVentes->count())

                    <div class="sales-list">

                        @foreach($dernieresVentes as $vente)

                            <div class="sale-item">

                                <div class="sale-image">

                                    @if($vente->vehicule->image)

                                        <img
                                            src="{{ asset('storage/' . $vente->vehicule->image) }}"
                                            alt="{{ $vente->vehicule->modele }}"
                                        >

                                    @else

                                        <div class="sale-image-placeholder">
                                            🚗
                                        </div>

                                    @endif

                                </div>


                                <div class="sale-info">

                                    <div class="sale-vehicle">

                                        {{ $vente->vehicule->marque->nom }}
                                        {{ $vente->vehicule->modele }}

                                    </div>

                                    <div class="sale-client">

                                        {{ $vente->client->prenom }}
                                        {{ $vente->client->nom }}

                                    </div>

                                </div>


                                <div class="sale-price">

                                    {{ number_format($vente->prix_vente, 0, ',', ' ') }}
                                    Ar

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="empty-state">
                        Aucune vente enregistrée.
                    </div>

                @endif

            </div>

        </div>


        {{-- Meilleurs véhicules --}}
        <div class="panel">

            <div class="panel-header">

                <h2>
                    Véhicules les plus vendus
                </h2>

                <span>
                    Top 5
                </span>

            </div>

            <div class="panel-body">

                @if($meilleursVehicules->count())

                    <div class="top-vehicle-list">

                        @foreach($meilleursVehicules as $index => $item)

                            <div class="top-vehicle">

                                <div
                                    class="rank {{ $index === 0 ? 'first' : '' }}"
                                >
                                    {{ $index + 1 }}
                                </div>


                                <div class="top-vehicle-info">

                                    <div class="top-vehicle-name">

                                        {{ $item->vehicule->modele }}

                                    </div>

                                    <div class="top-vehicle-brand">

                                        {{ $item->vehicule->marque->nom }}
                                        •
                                        {{ $item->vehicule->annee }}

                                    </div>

                                </div>


                                <div class="top-vehicle-sales">

                                    {{ $item->total_ventes }}
                                    vente{{ $item->total_ventes > 1 ? 's' : '' }}

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="empty-state">
                        Aucune vente confirmée pour le moment.
                    </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================
     JAVASCRIPT
========================== --}}

<script>

    /*
     * Graphique des ventes
     */

    document.querySelectorAll('.bar[data-height]').forEach(function (bar) {

        var height = parseFloat(bar.dataset.height);

        if (!isNaN(height)) {
            bar.style.height = height + '%';
        }

    });


    /*
     * Barres de progression
     */

    document.querySelectorAll('.progress-bar[data-width]').forEach(function (bar) {

        var width = parseFloat(bar.dataset.width);

        if (!isNaN(width)) {
            bar.style.width = width + '%';
        }

    });

</script>

@endsection