@extends('layouts.app')

@section('title', 'Gestion des rendez-vous')

@section('content')

<style>

/* =========================
   PAGE
========================= */

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

.btn-filter:hover {
    background: #ff1f2a;
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

.btn-reset:hover {
    color: #fff;
    border-color: #444;
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

/* ==================================================
   MODALE SUPPRESSION PREMIUM
================================================== */

.delete-modal {
    position: fixed;
    inset: 0;

    z-index: 99999;

    display: none;

    align-items: center;
    justify-content: center;

    padding: 20px;
}

.delete-modal.show {
    display: flex;
}

.delete-modal-overlay {
    position: absolute;
    inset: 0;

    background: rgba(0, 0, 0, .82);

    backdrop-filter: blur(8px);
}

.delete-modal-content {
    position: relative;
    z-index: 2;

    width: 100%;
    max-width: 500px;

    background: #111;

    border: 1px solid rgba(229, 9, 20, .45);

    border-radius: 18px;

    padding: 35px;

    box-shadow:
        0 25px 80px rgba(0, 0, 0, .75),
        0 0 45px rgba(229, 9, 20, .12);

    text-align: center;

    animation: deleteModalIn .2s ease-out;
}

@keyframes deleteModalIn {

    from {
        opacity: 0;
        transform: scale(.94) translateY(15px);
    }

    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

/* ICONE */

.delete-icon {
    width: 68px;
    height: 68px;

    margin: 0 auto 20px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: rgba(229, 9, 20, .12);

    border: 1px solid rgba(229, 9, 20, .35);

    font-size: 28px;

    box-shadow:
        0 0 25px rgba(229, 9, 20, .12);
}

/* TITRE */

.delete-modal-content h2 {
    margin: 0 0 8px;

    color: #fff;

    font-size: 22px;
    font-weight: 800;
}

.delete-warning {
    margin: 0 0 25px;

    color: #777;

    font-size: 14px;
}

/* INFORMATIONS RDV */

.appointment-preview {
    background: #080808;

    border: 1px solid #252525;

    border-radius: 12px;

    padding: 16px;

    margin-bottom: 25px;

    text-align: left;
}

.preview-row {
    display: flex;

    justify-content: space-between;
    align-items: center;

    gap: 20px;

    padding: 11px 0;

    border-bottom: 1px solid #202020;
}

.preview-row:last-child {
    border-bottom: none;
}

.preview-row span {
    color: #777;
    font-size: 13px;
}

.preview-row strong {
    color: #fff;

    font-size: 13px;

    text-align: right;
}

/* BOUTONS */

.delete-actions {
    display: flex;

    justify-content: flex-end;

    gap: 12px;
}

.modal-btn {
    padding: 12px 18px;

    border-radius: 9px;

    font-size: 13px;
    font-weight: 700;

    cursor: pointer;

    transition: .2s;
}

.cancel-btn {
    background: #222;

    color: #aaa;

    border: 1px solid #333;
}

.cancel-btn:hover {
    background: #2b2b2b;
    color: #fff;
}

.confirm-btn {
    background: #e50914;

    color: #fff;

    border: 1px solid #e50914;

    box-shadow:
        0 8px 20px rgba(229, 9, 20, .18);
}

.confirm-btn:hover {
    background: #ff1f2a;

    border-color: #ff1f2a;

    transform: translateY(-1px);

    box-shadow:
        0 10px 25px rgba(229, 9, 20, .30);
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

    .delete-modal-content {
        padding: 25px 20px;
    }

    .delete-actions {
        flex-direction: column;
    }

    .modal-btn {
        width: 100%;
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

                                        {{-- VOIR --}}

                                        <a
                                            href="{{ route('rendez_vous.show', $rdv) }}"
                                            class="action-btn"
                                            title="Voir"
                                        >

                                            👁

                                        </a>


                                        @if(in_array(auth()->user()->role, ['administrateur', 'gestionnaire']))

                                            {{-- MODIFIER --}}

                                            <a
                                                href="{{ route('rendez_vous.edit', $rdv) }}"
                                                class="action-btn edit"
                                                title="Modifier"
                                            >

                                                ✎

                                            </a>


                                            {{-- SUPPRIMER --}}

                                            <form
                                                method="POST"
                                                action="{{ route('rendez_vous.destroy', $rdv) }}"
                                                class="delete-form"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="button"
                                                    class="action-btn delete"
                                                    title="Supprimer"
                                                    onclick="openDeleteModal(this)"
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


{{-- ==================================================
     MODALE SUPPRESSION
================================================== --}}

<div
    id="deleteModal"
    class="delete-modal"
    aria-hidden="true"
>

    {{-- OVERLAY --}}

    <div
        class="delete-modal-overlay"
        onclick="closeDeleteModal()"
    ></div>


    {{-- CONTENU --}}

    <div
        class="delete-modal-content"
        role="dialog"
        aria-modal="true"
        aria-labelledby="deleteModalTitle"
    >

        <div class="delete-icon">

            🗑️

        </div>


        <h2 id="deleteModalTitle">

            Supprimer le rendez-vous ?

        </h2>


        <p class="delete-warning">

            Cette action est définitive. Vérifiez les informations
            avant de confirmer.

        </p>


        {{-- APERÇU DU RDV --}}

        <div class="appointment-preview">

            <div class="preview-row">

                <span>

                    👤 Client

                </span>

                <strong id="deleteClient">

                    —

                </strong>

            </div>


            <div class="preview-row">

                <span>

                    🚗 Véhicule

                </span>

                <strong id="deleteVehicle">

                    —

                </strong>

            </div>


            <div class="preview-row">

                <span>

                    📅 Date

                </span>

                <strong id="deleteDate">

                    —

                </strong>

            </div>


            <div class="preview-row">

                <span>

                    🕐 Heure

                </span>

                <strong id="deleteHour">

                    —

                </strong>

            </div>

        </div>


        {{-- ACTIONS MODALE --}}

        <div class="delete-actions">

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
            >

                @csrf

                @method('DELETE')

                <button
                    type="submit"
                    class="modal-btn confirm-btn"
                >

                    🗑️ Supprimer définitivement

                </button>

            </form>

        </div>

    </div>

</div>


<script>

let currentDeleteForm = null;


/* =========================
   OUVRIR LA MODALE
========================= */

function openDeleteModal(button) {

    currentDeleteForm = button.closest('.delete-form');

    if (!currentDeleteForm) {
        return;
    }

    /*
     * Récupération de la ligne du tableau
     */

    const row = button.closest('tr');

    if (row) {

        const client =
            row.querySelector('.client-name')?.textContent.trim() || '—';

        const vehicle =
            row.querySelector('.vehicle-name')?.textContent.trim() || '—';

        const date =
            row.querySelector('.date-box')?.textContent.trim() || '—';

        const hour =
            row.querySelector('.time-box')?.textContent.trim() || '—';


        document.getElementById('deleteClient').textContent = client;

        document.getElementById('deleteVehicle').textContent = vehicle;

        document.getElementById('deleteDate').textContent = date;

        document.getElementById('deleteHour').textContent = hour;

    }


    /*
     * Récupération de l'URL du formulaire
     */

    const deleteForm = document.getElementById('deleteForm');

    deleteForm.action = currentDeleteForm.action;


    /*
     * Affichage de la modale
     */

    const modal = document.getElementById('deleteModal');

    modal.classList.add('show');

    modal.setAttribute('aria-hidden', 'false');

    document.body.style.overflow = 'hidden';

}


/* =========================
   FERMER LA MODALE
========================= */

function closeDeleteModal() {

    const modal = document.getElementById('deleteModal');

    modal.classList.remove('show');

    modal.setAttribute('aria-hidden', 'true');

    document.body.style.overflow = '';

    currentDeleteForm = null;

}


/* =========================
   TOUCHE ESC
========================= */

document.addEventListener('keydown', function(event) {

    if (event.key === 'Escape') {

        closeDeleteModal();

    }

});

</script>
@endsection 