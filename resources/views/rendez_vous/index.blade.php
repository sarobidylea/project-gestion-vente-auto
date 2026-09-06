@extends('layouts.app')

@section('title', 'Gestion des rendez-vous')

@section('content')

<style>

    .rdv-page {
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
       STATISTIQUES
    ========================= */

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: #0d0d0d;
        border: 1px solid #252525;
        border-radius: 16px;
        padding: 20px;
    }

    .stat-label {
        color: #777;
        font-size: 13px;
        margin-bottom: 10px;
    }

    .stat-value {
        color: #fff;
        font-size: 28px;
        font-weight: 800;
    }

    .stat-card.red .stat-value {
        color: #e50914;
    }

    .stat-card.yellow .stat-value {
        color: #ffc107;
    }

    .stat-card.green .stat-value {
        color: #28a745;
    }

    /* =========================
       ALERTES
    ========================= */

    .alert {
        padding: 15px 18px;
        border-radius: 10px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .alert-success {
        background: rgba(40, 167, 69, .12);
        border: 1px solid rgba(40, 167, 69, .3);
        color: #55d875;
    }

    .alert-error {
        background: rgba(229, 9, 20, .12);
        border: 1px solid rgba(229, 9, 20, .3);
        color: #ff5963;
    }

    /* =========================
       FILTRES
    ========================= */

    .filters {
        background: #0d0d0d;
        border: 1px solid #252525;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 25px;
    }

    .filters form {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr auto;
        gap: 12px;
    }

    .input,
    .select {
        width: 100%;
        box-sizing: border-box;
        padding: 12px 14px;

        background: #080808;
        color: #fff;

        border: 1px solid #292929;
        border-radius: 9px;
        outline: none;
    }

    .input:focus,
    .select:focus {
        border-color: #e50914;
    }

    .btn-filter {
        padding: 12px 20px;
        border: none;
        border-radius: 9px;

        background: #e50914;
        color: #fff;

        font-weight: 700;
        cursor: pointer;
    }

    .btn-reset {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 12px 15px;

        background: #181818;
        border: 1px solid #292929;

        color: #aaa;
        border-radius: 9px;

        text-decoration: none;
    }

    /* =========================
       TABLEAU
    ========================= */

    .table-card {
        background: #0d0d0d;
        border: 1px solid #252525;
        border-radius: 16px;
        overflow: hidden;
    }

    .table-header {
        padding: 20px 22px;

        border-bottom: 1px solid #222;

        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-header h2 {
        color: #fff;
        margin: 0;
        font-size: 18px;
    }

    .table-header span {
        color: #666;
        font-size: 13px;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 950px;
    }

    th {
        text-align: left;
        padding: 15px 18px;

        color: #666;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .7px;

        border-bottom: 1px solid #222;
    }

    td {
        padding: 17px 18px;

        color: #ccc;

        border-bottom: 1px solid #181818;

        vertical-align: middle;
    }

    tbody tr {
        transition: .2s;
    }

    tbody tr:hover {
        background: #111;
    }

    .client-name {
        color: #fff;
        font-weight: 700;
    }

    .client-email {
        color: #666;
        font-size: 12px;
        margin-top: 4px;
    }

    .vehicle-name {
        color: #fff;
        font-weight: 700;
    }

    .vehicle-brand {
        color: #777;
        font-size: 12px;
        margin-top: 4px;
    }

    .date-box {
        color: #fff;
        font-weight: 700;
    }

    .time-box {
        color: #e50914;
        font-size: 13px;
        margin-top: 4px;
        font-weight: 700;
    }

    /* =========================
       STATUT
    ========================= */

    .status {
        display: inline-block;

        padding: 7px 12px;

        border-radius: 20px;

        font-size: 11px;
        font-weight: 800;
    }

    .status.pending {
        color: #ffc107;
        background: rgba(255, 193, 7, .1);
    }

    .status.confirmed {
        color: #28a745;
        background: rgba(40, 167, 69, .1);
    }

    .status.cancelled {
        color: #e50914;
        background: rgba(229, 9, 20, .1);
    }

    /* =========================
       ACTIONS
    ========================= */

    .actions {
        display: flex;
        gap: 7px;
    }

    .action-btn {
        width: 34px;
        height: 34px;

        display: inline-flex;
        justify-content: center;
        align-items: center;

        border-radius: 8px;

        text-decoration: none;

        background: #181818;
        color: #aaa;

        border: 1px solid #292929;

        cursor: pointer;

        transition: .2s;
    }

    .action-btn:hover {
        color: #fff;
        border-color: #555;
    }

    .action-btn.edit:hover {
        color: #ffc107;
    }

    .action-btn.delete:hover {
        color: #e50914;
    }

    /* =========================
       EMPTY
    ========================= */

    .empty {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .empty-icon {
        font-size: 45px;
        margin-bottom: 15px;
    }

    .empty h3 {
        color: #aaa;
        margin-bottom: 8px;
    }

    /* =========================
       PAGINATION
    ========================= */

    .pagination-wrapper {
        padding: 20px;
        border-top: 1px solid #222;
    }

    /* =========================
       MODAL
    ========================= */

    .modal {
        display: none;

        position: fixed;
        inset: 0;

        background: rgba(0, 0, 0, .75);

        z-index: 9999;

        align-items: center;
        justify-content: center;

        padding: 20px;
    }

    .modal.show {
        display: flex;
    }

    .modal-content {
        width: 100%;
        max-width: 430px;

        background: #111;

        border: 1px solid #333;
        border-radius: 16px;

        padding: 25px;
    }

    .modal-content h3 {
        color: #fff;
        margin-top: 0;
    }

    .modal-content p {
        color: #888;
        line-height: 1.6;
    }

    .modal-actions {
        display: flex;
        justify-content: flex-end;

        gap: 10px;

        margin-top: 25px;
    }

    .modal-btn {
        padding: 11px 17px;

        border-radius: 8px;
        border: none;

        cursor: pointer;
        font-weight: 700;
    }

    .cancel-btn {
        background: #222;
        color: #aaa;
    }

    .confirm-btn {
        background: #e50914;
        color: #fff;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1000px) {

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .filters form {
            grid-template-columns: 1fr 1fr;
        }

    }

    @media (max-width: 650px) {

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .filters form {
            grid-template-columns: 1fr;
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


<div class="rdv-page">

    {{-- =========================
         HERO
    ========================= --}}

    <div class="hero">

        <div class="hero-content">

            <div class="breadcrumb">
                Accueil &nbsp;›&nbsp;
                <span>Rendez-vous</span>
            </div>

            <h1>
                Nos <span>rendez-vous</span>
            </h1>

            <p>
                Gérez les rendez-vous clients et les visites de véhicules.
            </p>

            <div class="hero-line"></div>

        </div>

        <a
            href="{{ route('rendez_vous.create') }}"
            class="hero-button"
        >
            ＋ &nbsp; Nouveau rendez-vous
        </a>

    </div>


    {{-- =========================
         ALERTES
    ========================= --}}

    @if(session('success'))

        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-error">
            ⚠ {{ session('error') }}
        </div>

    @endif


    {{-- =========================
         STATISTIQUES
    ========================= --}}

    @php

        $totalRdv = \App\Models\RendezVous::count();

        $attente = \App\Models\RendezVous::where(
            'statut',
            'En attente'
        )->count();

        $confirmes = \App\Models\RendezVous::where(
            'statut',
            'Confirme'
        )->count();

        $annules = \App\Models\RendezVous::where(
            'statut',
            'Annul'
        )->count();

    @endphp


    <div class="stats-grid">

        <div class="stat-card">

            <div class="stat-label">
                TOTAL RENDEZ-VOUS
            </div>

            <div class="stat-value">
                {{ $totalRdv }}
            </div>

        </div>


        <div class="stat-card yellow">

            <div class="stat-label">
                EN ATTENTE
            </div>

            <div class="stat-value">
                {{ $attente }}
            </div>

        </div>


        <div class="stat-card green">

            <div class="stat-label">
                CONFIRMÉS
            </div>

            <div class="stat-value">
                {{ $confirmes }}
            </div>

        </div>


        <div class="stat-card red">

            <div class="stat-label">
                ANNULÉS
            </div>

            <div class="stat-value">
                {{ $annules }}
            </div>

        </div>

    </div>


    {{-- =========================
         FILTRES
    ========================= --}}

    <div class="filters">

        <form
            action="{{ route('rendez_vous.index') }}"
            method="GET"
        >

            <input
                type="text"
                name="search"
                class="input"
                placeholder="Rechercher un client, véhicule ou marque..."
                value="{{ request('search') }}"
            >


            <select
                name="statut"
                class="select"
            >

                <option value="">
                    Tous les statuts
                </option>

                <option
                    value="En attente"
                    {{ request('statut') === 'En attente' ? 'selected' : '' }}
                >
                    En attente
                </option>

                <option
                    value="Confirme"
                    {{ request('statut') === 'Confirme' ? 'selected' : '' }}
                >
                    Confirmé
                </option>

                <option
                    value="Annul"
                    {{ request('statut') === 'Annul' ? 'selected' : '' }}
                >
                    Annulé
                </option>

            </select>


            <input
                type="date"
                name="date"
                class="input"
                value="{{ request('date') }}"
            >


            <button
                type="submit"
                class="btn-filter"
            >
                Rechercher
            </button>

        </form>


        @if(request()->hasAny(['search', 'statut', 'date']))

            <div style="margin-top: 12px;">

                <a
                    href="{{ route('rendez_vous.index') }}"
                    class="btn-reset"
                >
                    Réinitialiser les filtres
                </a>

            </div>

        @endif

    </div>


    {{-- =========================
         TABLEAU
    ========================= --}}

    <div class="table-card">

        <div class="table-header">

            <h2>
                Liste des rendez-vous
            </h2>

            <span>
                {{ $rendezVous->total() }} rendez-vous
            </span>

        </div>


        @if($rendezVous->count())

            <div class="table-wrapper">

                <table>

                    <thead>

                        <tr>
                            <th>Client</th>
                            <th>Véhicule</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>

                    </thead>


                    <tbody>

                        @foreach($rendezVous as $rdv)

                            <tr>

                                {{-- CLIENT --}}

                                <td>

                                    <div class="client-name">
                                        {{ $rdv->client->nom }}
                                        {{ $rdv->client->prenom }}
                                    </div>

                                    <div class="client-email">
                                        {{ $rdv->client->email }}
                                    </div>

                                </td>


                                {{-- VEHICULE --}}

                                <td>

                                    <div class="vehicle-name">
                                        {{ $rdv->vehicule->modele }}
                                    </div>

                                    <div class="vehicle-brand">
                                        {{ $rdv->vehicule->marque->nom }}
                                    </div>

                                </td>


                                {{-- DATE --}}

                                <td>

                                    <div class="date-box">
                                        {{ $rdv->date_rendez_vous->format('d/m/Y') }}
                                    </div>

                                </td>


                                {{-- HEURE --}}

                                <td>

                                    <div class="time-box">
                                        {{ \Carbon\Carbon::parse($rdv->heure)->format('H:i') }}
                                    </div>

                                </td>


                                {{-- STATUT --}}

                                <td>

                                    @if($rdv->statut === 'En attente')

                                        <span class="status pending">
                                            En attente
                                        </span>

                                    @elseif($rdv->statut === 'Confirme')

                                        <span class="status confirmed">
                                            Confirmé
                                        </span>

                                    @else

                                        <span class="status cancelled">
                                            Annulé
                                        </span>

                                    @endif

                                </td>


                                {{-- ACTIONS --}}

                                <td>

                                    <div class="actions">

                                        {{-- Voir --}}

                                        <a
                                            href="{{ route('rendez_vous.show', $rdv) }}"
                                            class="action-btn"
                                            title="Voir"
                                        >
                                            👁
                                        </a>


                                        @if(in_array(auth()->user()->role, ['administrateur', 'gestionnaire']))

                                            {{-- Modifier --}}

                                            <a
                                                href="{{ route('rendez_vous.edit', $rdv) }}"
                                                class="action-btn edit"
                                                title="Modifier"
                                            >
                                                ✎
                                            </a>


                                            {{-- Supprimer --}}

                                            <form
                                                method="POST"
                                                action="{{ route('rendez_vous.destroy', $rdv) }}"
                                                onsubmit="return confirm('Voulez-vous vraiment supprimer ce rendez-vous ?');"
                                                style="display:inline;"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="action-btn delete"
                                                    title="Supprimer"
                                                >
                                                    🗑
                                                </button>

                                            </form>

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
                {{ $rendezVous->links() }}
            </div>

        @else

            <div class="empty">

                <div class="empty-icon">
                    📅
                </div>

                <h3>
                    Aucun rendez-vous trouvé
                </h3>

                <p>
                    Aucun rendez-vous ne correspond à votre recherche.
                </p>

                <a
                    href="{{ route('rendez_vous.create') }}"
                    class="hero-button"
                    style="position:static; display:inline-flex; margin-top:15px;"
                >
                    ＋ Créer un rendez-vous
                </a>

            </div>

        @endif

    </div>

</div>


{{-- =========================
     MODAL SUPPRESSION
========================= --}}

<div id="deleteModal" class="modal">

    <div class="modal-content">

        <h3>
            Supprimer le rendez-vous ?
        </h3>

        <p>
            Cette action est irréversible.
            Voulez-vous vraiment supprimer ce rendez-vous ?
        </p>

        <div class="modal-actions">

            <button
                type="button"
                class="modal-btn cancel-btn"
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
                    class="modal-btn confirm-btn"
                >
                    Supprimer
                </button>

            </form>

        </div>

    </div>

</div>


<script>

    function openDeleteModal(id) {

        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');

        form.action = `/rendez-vous/${id}`;

        modal.classList.add('show');
    }


    function closeDeleteModal() {

        document
            .getElementById('deleteModal')
            .classList.remove('show');

    }


    document
        .getElementById('deleteModal')
        .addEventListener('click', function(event) {

            if (event.target === this) {
                closeDeleteModal();
            }

        });

</script>

@endsection