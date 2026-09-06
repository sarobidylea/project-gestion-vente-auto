@extends('layouts.app')

@section('title', 'Gestion des ventes')

@section('content')

<style>

    .sales-page {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* =========================
       HERO
    ========================= */

    .hero {
        position: relative;
        min-height: 190px;
        display: flex;
        align-items: center;
        overflow: hidden;

        margin: 0 -42px 30px;
        padding: 30px 42px;

        background:
            linear-gradient(
                90deg,
                #050505 25%,
                rgba(5, 5, 5, .75) 55%,
                rgba(40, 0, 6, .35) 100%
            ),
            url("{{ asset('images/fond2.jpeg') }}");

        background-size: cover;
        background-position: right center;
        background-repeat: no-repeat;
    }

    .hero::after {
        content: "";
        position: absolute;
        right: -100px;
        top: -80px;
        width: 600px;
        height: 280px;

        background:
            radial-gradient(
                ellipse,
                rgba(255, 20, 30, .25),
                transparent 65%
            );

        transform: rotate(-8deg);
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .breadcrumb {
        color: #777;
        font-size: 11px;
        margin-bottom: 15px;
    }

    .breadcrumb span {
        color: #ddd;
    }

    .hero h1 {
        margin: 0;
        color: #fff;
        font-size: 36px;
        font-weight: 800;
        letter-spacing: -1px;
    }

    .hero h1 span {
        color: #ed101b;
    }

    .hero p {
        margin: 5px 0 15px;
        color: #aaa;
        font-size: 14px;
    }

    .hero-line {
        width: 60px;
        height: 3px;
        background: #ed101b;
    }

    .hero-button {
        position: absolute;
        z-index: 5;
        right: 42px;
        top: 58px;

        padding: 13px 22px;
        border-radius: 7px;

        background: #ed101b;
        color: white;

        font-weight: 700;
        font-size: 13px;
        text-decoration: none;

        transition: .2s;
    }

    .hero-button:hover {
        background: #ff2630;
        transform: translateY(-2px);
    }

    /* =========================
       ALERTS
    ========================= */

    .alert {
        padding: 14px 17px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .alert-success {
        background: rgba(46, 204, 113, .08);
        border: 1px solid rgba(46, 204, 113, .25);
        color: #55d68a;
    }

    .alert-error {
        background: rgba(229, 9, 20, .08);
        border: 1px solid rgba(229, 9, 20, .25);
        color: #ff5964;
    }

    /* =========================
       STATS
    ========================= */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .stat-card {
        position: relative;
        overflow: hidden;

        background: #101010;
        border: 1px solid #252525;
        border-radius: 16px;

        padding: 22px;
    }

    .stat-card::after {
        content: "";

        position: absolute;

        width: 90px;
        height: 90px;

        border-radius: 50%;

        right: -30px;
        top: -30px;

        background: rgba(229, 9, 20, .05);
    }

    .stat-icon {
        font-size: 22px;
        margin-bottom: 12px;
    }

    .stat-label {
        color: #777;
        font-size: 12px;
        margin-bottom: 7px;
    }

    .stat-value {
        color: #fff;
        font-size: 25px;
        font-weight: 800;
    }

    .stat-value.red {
        color: #e50914;
    }

    /* =========================
       FILTERS
    ========================= */

    .filters-card {
        background: #101010;
        border: 1px solid #252525;
        border-radius: 16px;

        padding: 20px;
        margin-bottom: 25px;
    }

    .filters-form {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr auto;
        gap: 12px;
        align-items: end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .filter-group label {
        color: #888;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .filter-group input,
    .filter-group select {
        width: 100%;
        box-sizing: border-box;

        background: #080808;

        border: 1px solid #292929;
        border-radius: 9px;

        color: #fff;

        padding: 12px 13px;

        outline: none;
        font-size: 13px;
    }

    .filter-group input:focus,
    .filter-group select:focus {
        border-color: #e50914;
        box-shadow: 0 0 0 3px rgba(229, 9, 20, .08);
    }

    .filter-group select option {
        background: #101010;
        color: #fff;
    }

    .filter-buttons {
        display: flex;
        gap: 8px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;

        padding: 12px 18px;

        border-radius: 10px;
        text-decoration: none;

        border: none;
        cursor: pointer;

        font-size: 13px;
        font-weight: 700;

        transition: .2s;
    }

    .btn-filter {
        background: #e50914;
        color: #fff;
        height: 41px;
    }

    .btn-reset {
        background: #1c1c1c;
        color: #aaa;
        height: 41px;
    }

    .btn-reset:hover {
        background: #292929;
        color: #fff;
    }

    /* =========================
       TABLE CARD
    ========================= */

    .table-card {
        background: #101010;
        border: 1px solid #252525;
        border-radius: 16px;
        overflow: hidden;
    }

    .table-header {
        padding: 20px 22px;

        display: flex;
        justify-content: space-between;
        align-items: center;

        border-bottom: 1px solid #252525;
    }

    .table-title {
        display: flex;
        align-items: center;
        gap: 10px;

        color: #fff;

        font-size: 17px;
        font-weight: 750;
    }

    .table-title span {
        width: 4px;
        height: 21px;

        background: #e50914;

        border-radius: 5px;
    }

    .sales-count {
        color: #777;
        font-size: 12px;
    }

    .table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    table {
        width: 100%;
        min-width: 950px;
        border-collapse: collapse;
    }

    th {
        text-align: left;

        padding: 14px 20px;

        color: #666;
        background: #0c0c0c;

        font-size: 10px;
        font-weight: 800;

        text-transform: uppercase;
        letter-spacing: .6px;

        white-space: nowrap;
    }

    td {
        padding: 16px 20px;

        border-top: 1px solid #1e1e1e;

        color: #ccc;
        font-size: 13px;

        vertical-align: middle;
    }

    tbody tr {
        transition: .2s;
    }

    tbody tr:hover {
        background: rgba(255,255,255,.015);
    }

    /* =========================
       VEHICLE
    ========================= */

    .vehicle-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .vehicle-image {
        width: 58px;
        height: 42px;

        border-radius: 7px;

        object-fit: cover;

        background: #1b1b1b;
        border: 1px solid #292929;
    }

    .vehicle-placeholder {
        width: 58px;
        height: 42px;

        border-radius: 7px;

        background: #1b1b1b;
        border: 1px solid #292929;

        display: flex;
        align-items: center;
        justify-content: center;

        color: #555;
        font-size: 17px;
    }

    .vehicle-name {
        color: #fff;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .vehicle-brand {
        color: #777;
        font-size: 11px;
    }

    /* =========================
       CLIENT
    ========================= */

    .client-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .client-avatar {
        width: 34px;
        height: 34px;
        min-width: 34px;

        border-radius: 50%;

        background: linear-gradient(
            135deg,
            #e50914,
            #620008
        );

        color: #fff;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 11px;
        font-weight: 800;
    }

    .client-name {
        color: #eee;
        font-weight: 600;
    }

    .client-email {
        color: #666;
        font-size: 10px;
        margin-top: 3px;
    }

    /* =========================
       PRICE
    ========================= */

    .price {
        color: #e50914;
        font-weight: 800;
        white-space: nowrap;
    }

    /* =========================
       BADGES
    ========================= */

    .badge {
        display: inline-flex;
        align-items: center;

        padding: 6px 9px;

        border-radius: 7px;

        font-size: 10px;
        font-weight: 700;

        white-space: nowrap;
    }

    .badge-success {
        color: #55d68a;
        background: rgba(85, 214, 138, .08);
        border: 1px solid rgba(85, 214, 138, .2);
    }

    .badge-warning {
        color: #f2c94c;
        background: rgba(242, 201, 76, .08);
        border: 1px solid rgba(242, 201, 76, .2);
    }

    .badge-danger {
        color: #ff5964;
        background: rgba(255, 89, 100, .08);
        border: 1px solid rgba(255, 89, 100, .2);
    }

    .badge-payment {
        color: #aaa;
        background: #191919;
        border: 1px solid #292929;
    }

    /* =========================
       ACTIONS
    ========================= */

    .actions {
        display: flex;
        gap: 6px;
    }

    .action-btn {
        width: 34px;
        height: 34px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 8px;

        text-decoration: none;

        border: 1px solid #292929;

        background: #171717;
        color: #999;

        cursor: pointer;

        transition: .2s;
    }

    .action-btn:hover {
        color: #fff;
        background: #252525;
    }

    .action-btn.edit:hover {
        color: #e50914;
        border-color: rgba(229, 9, 20, .4);
    }

    .action-btn.delete:hover {
        color: #ff5964;
        border-color: rgba(255, 89, 100, .4);
    }

    /* =========================
       EMPTY
    ========================= */

    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-icon {
        font-size: 40px;
        opacity: .5;
        margin-bottom: 15px;
    }

    .empty-state h3 {
        color: #ddd;
        margin: 0 0 7px;
        font-size: 16px;
    }

    .empty-state p {
        color: #666;
        font-size: 13px;
        margin: 0;
    }

    /* =========================
       PAGINATION
    ========================= */

    .pagination-wrapper {
        padding: 20px;
        border-top: 1px solid #252525;
    }

    .pagination-wrapper nav {
        display: flex;
        justify-content: center;
    }

    .pagination-wrapper svg {
        width: 18px;
        height: 18px;
    }

    .pagination-wrapper a,
    .pagination-wrapper span {
        color: #aaa;
    }

    /* =========================
       MODAL
    ========================= */

    .modal-overlay {
        display: none;

        position: fixed;

        z-index: 9999;

        inset: 0;

        background: rgba(0,0,0,.75);

        align-items: center;
        justify-content: center;

        padding: 20px;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal {
        width: 100%;
        max-width: 430px;

        background: #111;

        border: 1px solid #2c2c2c;
        border-radius: 16px;

        padding: 25px;

        box-shadow: 0 25px 70px rgba(0,0,0,.6);
    }

    .modal h3 {
        color: #fff;
        margin: 0 0 10px;
        font-size: 19px;
    }

    .modal p {
        color: #888;
        line-height: 1.6;

        font-size: 13px;

        margin-bottom: 22px;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;

        gap: 10px;
    }

    .modal-cancel {
        background: #222;
        color: #bbb;
    }

    .modal-delete {
        background: #e50914;
        color: #fff;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1100px) {

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .filters-form {
            grid-template-columns: 1fr 1fr;
        }

        .filter-buttons {
            grid-column: 1 / -1;
        }

    }

    @media (max-width: 700px) {

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .filters-form {
            grid-template-columns: 1fr;
        }

        .filter-buttons {
            grid-column: auto;
        }

        .filter-buttons .btn {
            flex: 1;
        }

        .hero {
            margin-left: -25px;
            margin-right: -25px;

            padding-left: 25px;
            padding-right: 25px;
        }

        .hero-button {
            position: static;
            margin-left: auto;
        }

    }

    @media (max-width: 500px) {

        .hero {
            min-height: 220px;
            align-items: flex-start;
        }

        .hero-button {
            position: absolute;

            left: 25px;
            right: auto;

            top: auto;
            bottom: 25px;
        }

    }

</style>


<div class="sales-page">

    {{-- =========================
         HERO
    ========================= --}}

    <div class="hero">

        <div class="hero-content">

            <div class="breadcrumb">
                Accueil &nbsp;›&nbsp;
                <span>Ventes</span>
            </div>

            <h1>
                Nos <span>ventes</span>
            </h1>

            <p>
                Suivez les ventes et les transactions de vos véhicules.
            </p>

            <div class="hero-line"></div>

        </div>

        <a
            href="{{ route('ventes.create') }}"
            class="hero-button"
        >
            ＋ &nbsp; Nouvelle vente
        </a>

    </div>


    {{-- ALERT SUCCESS --}}

    @if(session('success'))

        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>

    @endif


    {{-- ALERT ERROR --}}

    @if(session('error'))

        <div class="alert alert-error">
            ⚠ {{ session('error') }}
        </div>

    @endif


    {{-- =========================
         STATISTIQUES
    ========================= --}}

    @php

        $totalVentes = $ventes->total();

        $ventesConfirmees =
            \App\Models\Vente::where(
                'statut',
                'Confirmee'
            )->count();

        $ventesAttente =
            \App\Models\Vente::where(
                'statut',
                'En attente'
            )->count();

        $chiffreAffaires =
            \App\Models\Vente::where(
                'statut',
                'Confirmee'
            )->sum('prix_vente');

    @endphp


    <div class="stats-grid">

        <div class="stat-card">

            <div class="stat-icon">
                💰
            </div>

            <div class="stat-label">
                Chiffre d'affaires
            </div>

            <div class="stat-value red">
                {{ number_format($chiffreAffaires, 0, ',', ' ') }} Ar
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon">
                🚗
            </div>

            <div class="stat-label">
                Ventes confirmées
            </div>

            <div class="stat-value">
                {{ $ventesConfirmees }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon">
                ⏳
            </div>

            <div class="stat-label">
                En attente
            </div>

            <div class="stat-value">
                {{ $ventesAttente }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-icon">
                📊
            </div>

            <div class="stat-label">
                Total des ventes
            </div>

            <div class="stat-value">
                {{ $totalVentes }}
            </div>

        </div>

    </div>


    {{-- =========================
         FILTRES
    ========================= --}}

    <div class="filters-card">

        <form
            action="{{ route('ventes.index') }}"
            method="GET"
            class="filters-form"
        >

            {{-- Recherche --}}

            <div class="filter-group">

                <label for="search">
                    Recherche
                </label>

                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Client, véhicule, marque..."
                >

            </div>


            {{-- Statut --}}

            <div class="filter-group">

                <label for="statut">
                    Statut
                </label>

                <select
                    name="statut"
                    id="statut"
                >

                    <option value="">
                        Tous les statuts
                    </option>

                    <option
                        value="Confirmee"
                        {{ request('statut') === 'Confirmee' ? 'selected' : '' }}
                    >
                        Confirmée
                    </option>

                    <option
                        value="En attente"
                        {{ request('statut') === 'En attente' ? 'selected' : '' }}
                    >
                        En attente
                    </option>

                    <option
                        value="Annulee"
                        {{ request('statut') === 'Annulee' ? 'selected' : '' }}
                    >
                        Annulée
                    </option>

                </select>

            </div>


            {{-- Paiement --}}

            <div class="filter-group">

                <label for="mode_paiement">
                    Paiement
                </label>

                <select
                    name="mode_paiement"
                    id="mode_paiement"
                >

                    <option value="">
                        Tous les paiements
                    </option>

                    <option
                        value="Especes"
                        {{ request('mode_paiement') === 'Especes' ? 'selected' : '' }}
                    >
                        Espèces
                    </option>

                    <option
                        value="Carte"
                        {{ request('mode_paiement') === 'Carte' ? 'selected' : '' }}
                    >
                        Carte
                    </option>

                    <option
                        value="Virement"
                        {{ request('mode_paiement') === 'Virement' ? 'selected' : '' }}
                    >
                        Virement
                    </option>

                    <option
                        value="Credit"
                        {{ request('mode_paiement') === 'Credit' ? 'selected' : '' }}
                    >
                        Crédit
                    </option>

                </select>

            </div>


            {{-- Boutons --}}

            <div class="filter-buttons">

                <button
                    type="submit"
                    class="btn btn-filter"
                >
                    🔎 Filtrer
                </button>

                <a
                    href="{{ route('ventes.index') }}"
                    class="btn btn-reset"
                >
                    Réinitialiser
                </a>

            </div>

        </form>

    </div>


    {{-- =========================
         TABLE
    ========================= --}}

    <div class="table-card">

        <div class="table-header">

            <div class="table-title">

                <span></span>

                Liste des ventes

            </div>

            <div class="sales-count">

                {{ $ventes->total() }} vente(s)

            </div>

        </div>


        @if($ventes->count() > 0)

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>

                            <th>Véhicule</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Prix</th>
                            <th>Paiement</th>
                            <th>Statut</th>
                            <th>Actions</th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($ventes as $vente)

                            <tr>

                                {{-- VÉHICULE --}}

                                <td>

                                    <div class="vehicle-cell">

                                        @if($vente->vehicule && $vente->vehicule->image)

                                            <img
                                                src="{{ asset('storage/' . $vente->vehicule->image) }}"
                                                alt="{{ $vente->vehicule->modele }}"
                                                class="vehicle-image"
                                            >

                                        @else

                                            <div class="vehicle-placeholder">
                                                🚗
                                            </div>

                                        @endif


                                        <div>

                                            @if($vente->vehicule)

                                                <div class="vehicle-name">
                                                    {{ $vente->vehicule->modele }}
                                                </div>

                                                @if($vente->vehicule->marque)

                                                    <div class="vehicle-brand">
                                                        {{ $vente->vehicule->marque->nom }}
                                                    </div>

                                                @endif

                                            @else

                                                <div class="vehicle-name">
                                                    Véhicule supprimé
                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- CLIENT --}}

                                <td>

                                    @if($vente->client)

                                        @php

                                            $initials = strtoupper(
                                                substr($vente->client->prenom, 0, 1) .
                                                substr($vente->client->nom, 0, 1)
                                            );

                                        @endphp

                                        <div class="client-cell">

                                            <div class="client-avatar">
                                                {{ $initials }}
                                            </div>

                                            <div>

                                                <div class="client-name">

                                                    {{ $vente->client->prenom }}
                                                    {{ $vente->client->nom }}

                                                </div>

                                                <div class="client-email">

                                                    {{ $vente->client->email }}

                                                </div>

                                            </div>

                                        </div>

                                    @else

                                        <span style="color:#666;">
                                            Client supprimé
                                        </span>

                                    @endif

                                </td>


                                {{-- DATE --}}

                                <td>

                                    <span style="color:#bbb;">

                                        {{
                                            $vente->date_vente
                                                ? $vente->date_vente->format('d/m/Y')
                                                : '—'
                                        }}

                                    </span>

                                </td>


                                {{-- PRIX --}}

                                <td>

                                    <div class="price">

                                        {{
                                            number_format(
                                                $vente->prix_vente,
                                                0,
                                                ',',
                                                ' '
                                            )
                                        }} Ar

                                    </div>

                                </td>


                                {{-- PAIEMENT --}}

                                <td>

                                    @php

                                        $paiement = [
                                            'Especes' => 'Espèces',
                                            'Carte' => 'Carte',
                                            'Virement' => 'Virement',
                                            'Credit' => 'Crédit',
                                        ];

                                    @endphp

                                    <span class="badge badge-payment">

                                        {{
                                            $paiement[$vente->mode_paiement]
                                            ?? $vente->mode_paiement
                                        }}

                                    </span>

                                </td>


                                {{-- STATUT --}}

                                <td>

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

                                </td>


                                {{-- ACTIONS --}}

                                <td>

                                    <div class="actions">

                                        {{-- Voir --}}

                                        <a
                                            href="{{ route('ventes.show', $vente) }}"
                                            class="action-btn"
                                            title="Voir"
                                        >
                                            👁
                                        </a>


                                        {{-- Modifier / Supprimer --}}

                                        @if(in_array(auth()->user()->role, ['administrateur', 'gestionnaire']))

                                            <a
                                                href="{{ route('ventes.edit', $vente) }}"
                                                class="action-btn edit"
                                                title="Modifier"
                                            >
                                                ✎
                                            </a>


                                            <button
                                                type="button"
                                                class="action-btn delete"
                                                title="Supprimer"

                                                onclick="openDeleteModal(
                                                    '{{ $vente->id }}',
                                                    '{{ $vente->vehicule ? addslashes($vente->vehicule->modele) : 'cette vente' }}'
                                                )"
                                            >
                                                🗑
                                            </button>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}

            <div class="pagination-wrapper">

                {{ $ventes->links() }}

            </div>

        @else

            <div class="empty-state">

                <div class="empty-icon">
                    💰
                </div>

                <h3>
                    Aucune vente trouvée
                </h3>

                <p>
                    Aucune vente ne correspond aux critères sélectionnés.
                </p>

            </div>

        @endif

    </div>

</div>


{{-- =========================
     MODAL SUPPRESSION
========================= --}}

<div
    class="modal-overlay"
    id="deleteModal"
>

    <div class="modal">

        <h3>
            Supprimer cette vente ?
        </h3>

        <p>

            Vous êtes sur le point de supprimer la vente

            <strong
                id="vehicleToDelete"
                style="color:#fff;"
            ></strong>.

            Cette action est irréversible.

        </p>


        <div class="modal-actions">

            <button
                type="button"
                class="btn modal-cancel"
                onclick="closeDeleteModal()"
            >
                Annuler
            </button>


            <form
                id="deleteForm"
                method="POST"
                style="display:inline;"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn modal-delete"
                >
                    Supprimer
                </button>

            </form>

        </div>

    </div>

</div>


<script>

    function openDeleteModal(id, vehicleName) {

        const modal =
            document.getElementById('deleteModal');

        const form =
            document.getElementById('deleteForm');

        const vehicle =
            document.getElementById('vehicleToDelete');

        form.action =
            "{{ url('ventes') }}/" + id;

        vehicle.textContent =
            vehicleName;

        modal.classList.add('active');
    }


    function closeDeleteModal() {

        const modal =
            document.getElementById('deleteModal');

        modal.classList.remove('active');
    }


    // Fermer en cliquant à l'extérieur

    document
        .getElementById('deleteModal')
        .addEventListener('click', function(event) {

            if (event.target === this) {

                closeDeleteModal();

            }

        });


    // Fermer avec la touche Escape

    document.addEventListener('keydown', function(event) {

        if (event.key === 'Escape') {

            closeDeleteModal();

        }

    });

</script>

@endsection