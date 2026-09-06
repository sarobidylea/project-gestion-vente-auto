```blade
@extends('layouts.app')

@section('title', 'Véhicules - Luxora Motors')

@section('styles')

<style>

    /* =========================================================
       HERO
    ========================================================= */

    .hero {
        position: relative;
        min-height: 190px;

        display: flex;
        align-items: center;

        overflow: hidden;

        margin: 0 -42px;
        padding: 30px 42px;

        background:
            linear-gradient(
                90deg,
                #050505 25%,
                rgba(5,5,5,.75) 55%,
                rgba(40,0,6,.35) 100%
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
                rgba(255,20,30,.25),
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


    /* =========================================================
       FILTERS
    ========================================================= */

    .filters {
        margin-top: 20px;

        background: #080b0d;

        border: 1px solid #1d2529;
        border-radius: 9px;

        padding: 14px;

        display: grid;

        grid-template-columns:
            1.4fr
            1fr
            1fr
            1fr;

        gap: 14px;
    }

    .filter-search {
        display: flex;
        align-items: center;

        gap: 10px;

        width: 100%;
        height: 43px;

        background: #111518;

        border: 1px solid #252c30;
        border-radius: 7px;

        padding: 0 14px;

        color: #666;
    }

    .filter-search:focus-within {
        border-color: #a6000a;
    }

    .filter-search span {
        flex-shrink: 0;
        font-size: 13px;
    }

    .filter-search input {
        flex: 1;

        width: 100%;

        height: 100%;

        background: transparent;

        border: none;
        outline: none;

        color: #ddd;

        font-size: 13px;
    }

    .filter-search input::placeholder {
        color: #666;
    }

    .filters select {
        width: 100%;
        height: 43px;

        background: #111518;

        border: 1px solid #252c30;
        border-radius: 7px;

        color: #aaa;

        padding: 0 14px;

        outline: none;

        cursor: pointer;
    }

    .filters select:focus {
        border-color: #a6000a;
    }

    .filter-button {
        height: 48px;

        padding: 0 20px;

        background: #e50914;

        color: white;

        border: none;
        border-radius: 7px;

        font-weight: 700;

        cursor: pointer;

        transition: .2s;
    }

    .filter-button:hover {
        background: #ff1e2d;
    }

    .reset-button {
        height: 48px;

        padding: 0 18px;

        display: inline-flex;

        align-items: center;
        justify-content: center;

        background: #1b2022;

        color: #bbb;

        border: 1px solid #303638;
        border-radius: 7px;

        text-decoration: none;

        font-size: 13px;
        font-weight: 600;
    }

    .reset-button:hover {
        color: white;
        background: #272d30;
    }


    /* =========================================================
       ALERT
    ========================================================= */

    .alert {
        margin-top: 15px;

        background: #0c321b;

        border: 1px solid #17652f;

        color: #6df39b;

        padding: 12px 15px;

        border-radius: 7px;

        font-size: 13px;
    }


    /* =========================================================
       VEHICLES GRID
    ========================================================= */

    .vehicles-grid {
        margin-top: 14px;

        display: grid;

        grid-template-columns: repeat(4, 1fr);

        gap: 12px;
    }

    .vehicle-card {
        background:
            linear-gradient(
                180deg,
                #0b1013 0%,
                #07090a 100%
            );

        border: 1px solid #242b2f;

        border-radius: 9px;

        overflow: hidden;

        transition: .25s;
    }

    .vehicle-card:hover {
        border-color: #7d0008;

        transform: translateY(-3px);

        box-shadow:
            0 10px 35px rgba(0,0,0,.5);
    }


    /* =========================================================
       IMAGE
    ========================================================= */

    .vehicle-image {
        height: 145px;

        position: relative;

        overflow: hidden;

        background:
            radial-gradient(
                ellipse at center,
                #30383d,
                #101416 65%,
                #050505
            );
    }

    .vehicle-image img {
        width: 100%;
        height: 100%;

        object-fit: cover;

        display: block;

        transition: .3s;
    }

    .vehicle-card:hover .vehicle-image img {
        transform: scale(1.04);
    }

    .image-placeholder {
        width: 100%;
        height: 100%;

        display: flex;

        align-items: center;
        justify-content: center;

        font-size: 45px;

        opacity: .25;
    }

    .favorite {
        position: absolute;

        left: 12px;
        top: 10px;

        width: 28px;
        height: 28px;

        border-radius: 50%;

        background: rgba(0,0,0,.6);

        border: 1px solid #444;

        display: flex;

        align-items: center;
        justify-content: center;

        color: white;
    }

    .status {
        position: absolute;

        right: 10px;
        top: 10px;

        padding: 5px 10px;

        border-radius: 20px;

        font-size: 10px;

        font-weight: 700;
    }

    .status-disponible {
        background: #087332;
        color: #b6ffd0;
    }

    .status-reserve {
        background: #9a6900;
        color: #ffe7a0;
    }

    .status-vendu {
        background: #9d0711;
        color: #ffd0d3;
    }


    /* =========================================================
       CARD BODY
    ========================================================= */

    .vehicle-body {
        padding: 12px;
    }

    .vehicle-title {
        display: flex;

        justify-content: space-between;
        align-items: flex-start;
    }

    .vehicle-brand {
        font-size: 13px;

        font-weight: 700;

        color: #fff;
    }

    .vehicle-model {
        color: #aaa;

        font-size: 12px;

        margin-top: 3px;
    }

    .vehicle-year {
        color: #aaa;

        font-size: 11px;
    }

    .vehicle-price {
        margin-top: 13px;

        color: #ff1823;

        font-size: 15px;

        font-weight: 800;
    }

    .vehicle-info {
        display: flex;

        justify-content: space-between;

        margin-top: 11px;

        padding-top: 10px;

        border-top: 1px solid #1d2326;

        color: #999;

        font-size: 10px;
    }

    .vehicle-info div {
        display: flex;

        align-items: center;

        gap: 4px;
    }


    /* =========================================================
       ACTIONS
    ========================================================= */

    .vehicle-actions {
        display: grid;

        grid-template-columns:
            1fr
            1fr
            1fr;

        gap: 6px;

        margin-top: 13px;
    }

    .action-btn {
        height: 31px;

        border-radius: 5px;

        display: flex;

        justify-content: center;
        align-items: center;

        font-size: 10px;

        font-weight: 600;

        border: 1px solid #3c454a;

        background: #111619;

        color: #ddd;

        cursor: pointer;

        text-decoration: none;

        transition: .2s;
    }

    .action-btn:hover {
        border-color: #aaa;
    }

    .action-edit {
        background: #8a0710;

        border-color: #a20b15;

        color: white;
    }

    .action-edit:hover {
        background: #b50b16;
    }

    .action-delete {
        background: #650006;

        border-color: #820009;

        color: white;
    }

    .action-delete:hover {
        background: #99000a;
    }

    .delete-form {
        margin: 0;
    }


    /* =========================================================
       FOOTER
    ========================================================= */

    .vehicles-footer {
        display: flex;

        justify-content: space-between;
        align-items: center;

        margin-top: 15px;

        color: #777;

        font-size: 11px;
    }

    .pagination {
        display: flex;

        gap: 5px;
    }

    .pagination a,
    .pagination span {
        width: 30px;
        height: 30px;

        display: flex;

        align-items: center;
        justify-content: center;

        background: #0c1012;

        border: 1px solid #252b2f;

        border-radius: 5px;
    }

    .pagination .active {
        background: #ed101b;

        border-color: #ed101b;

        color: white;
    }


    /* =========================================================
       MODAL DE SUPPRESSION
    ========================================================= */

    .delete-modal {
        position: fixed;

        inset: 0;

        z-index: 99999;

        display: none;

        align-items: center;
        justify-content: center;
    }

    .delete-modal.active {
        display: flex;
    }

    .delete-modal-overlay {
        position: absolute;

        inset: 0;

        background: rgba(0,0,0,.82);

        backdrop-filter: blur(7px);

        -webkit-backdrop-filter: blur(7px);
    }

    .delete-modal-content {
        position: relative;

        z-index: 2;

        width: 92%;

        max-width: 460px;

        padding: 38px 32px;

        background:
            linear-gradient(
                145deg,
                #111517,
                #080a0b
            );

        border: 1px solid #421116;

        border-radius: 14px;

        text-align: center;

        box-shadow:
            0 25px 80px rgba(0,0,0,.85),
            0 0 40px rgba(229,9,20,.08);

        animation: deleteModalShow .25s ease;
    }

    @keyframes deleteModalShow {

        from {
            opacity: 0;

            transform:
                translateY(25px)
                scale(.96);
        }

        to {
            opacity: 1;

            transform:
                translateY(0)
                scale(1);
        }

    }

    .delete-modal-close {
        position: absolute;

        top: 12px;
        right: 15px;

        width: 34px;
        height: 34px;

        border: none;

        background: transparent;

        color: #777;

        font-size: 26px;

        cursor: pointer;

        transition: .2s;
    }

    .delete-modal-close:hover {
        color: white;
    }

    .delete-icon {
        width: 70px;
        height: 70px;

        margin: 0 auto 20px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: rgba(229,9,20,.10);

        border: 1px solid rgba(229,9,20,.35);
    }

    .delete-icon span {
        font-size: 30px;
    }

    .delete-modal-content h2 {
        margin: 0 0 10px;

        color: #fff;

        font-size: 23px;

        font-weight: 800;
    }

    .delete-modal-content > p {
        margin: 0;

        color: #888;

        font-size: 13px;

        line-height: 1.6;
    }

    .vehicle-to-delete {
        margin: 18px 0;

        padding: 14px 16px;

        background: #161a1c;

        border: 1px solid #303639;

        border-radius: 7px;

        color: #ed101b;

        font-size: 15px;

        font-weight: 700;
    }

    .warning-text {
        color: #777 !important;

        font-size: 11px !important;
    }

    .delete-modal-actions {
        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 10px;

        margin-top: 25px;
    }

    .modal-btn {
        height: 43px;

        border-radius: 7px;

        font-size: 12px;

        font-weight: 700;

        cursor: pointer;

        transition: .2s;
    }

    .modal-cancel {
        background: #191d1f;

        border: 1px solid #353b3e;

        color: #aaa;
    }

    .modal-cancel:hover {
        background: #252a2d;

        color: white;
    }

    .modal-confirm {
        background: #e50914;

        border: 1px solid #e50914;

        color: white;
    }

    .modal-confirm:hover {
        background: #ff1e2d;

        transform: translateY(-2px);

        box-shadow:
            0 7px 20px rgba(229,9,20,.25);
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1250px) {

        .vehicles-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .filters {
            grid-template-columns: 1fr 1fr;
        }

    }

    @media (max-width: 900px) {

        .vehicles-grid {
            grid-template-columns: repeat(2, 1fr);
        }

    }

    @media (max-width: 600px) {

        .vehicles-grid {
            grid-template-columns: 1fr;
        }

        .filters {
            grid-template-columns: 1fr;
        }

        .hero {
            margin: 0 -20px;

            padding: 30px 20px;
        }

        .hero h1 {
            font-size: 28px;
        }

        .hero-button {
            position: static;

            display: inline-block;

            margin-top: 15px;
        }

        .vehicles-footer {
            flex-direction: column;

            gap: 15px;

            align-items: flex-start;
        }

        .delete-modal-content {
            padding: 35px 20px;
        }

        .delete-modal-actions {
            grid-template-columns: 1fr;
        }

    }

</style>

@endsection


@section('content')


<!-- =========================================================
     HERO
========================================================= -->

<div class="hero">

    <div class="hero-content">

        <div class="breadcrumb">

            Accueil &nbsp;›&nbsp;

            <span>
                Véhicules
            </span>

        </div>

        <h1>

            Nos <span>véhicules</span>

        </h1>

        <p>
            Découvrez notre collection de véhicules haut de gamme
        </p>

        <div class="hero-line"></div>

    </div>


    <a
        href="{{ route('vehicules.create') }}"
        class="hero-button"
    >
        ＋ &nbsp; Ajouter un véhicule
    </a>

</div>


<!-- =========================================================
     ALERT
========================================================= -->

@if(session('success'))

    <div class="alert">

        ✓ &nbsp;

        {{ session('success') }}

    </div>

@endif


<!-- =========================================================
     FILTERS
========================================================= -->

<form
    action="{{ route('vehicules.index') }}"
    method="GET"
    class="filters"
>

    <!-- Recherche -->

    <div class="filter-search">

        <span>🔍</span>

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Rechercher par marque, modèle..."
        >

    </div>


    <!-- Marque -->

    <select name="marque_id">

        <option value="">
            Toutes les marques
        </option>

        @foreach($marques as $marque)

            <option
                value="{{ $marque->id }}"
                {{ request('marque_id') == $marque->id ? 'selected' : '' }}
            >
                {{ $marque->nom }}
            </option>

        @endforeach

    </select>


    <!-- Carburant -->

    <select name="carburant">

        <option value="">
            Carburant
        </option>

        <option
            value="Essence"
            {{ request('carburant') == 'Essence' ? 'selected' : '' }}
        >
            Essence
        </option>

        <option
            value="Diesel"
            {{ request('carburant') == 'Diesel' ? 'selected' : '' }}
        >
            Diesel
        </option>

        <option
            value="Hybride"
            {{ request('carburant') == 'Hybride' ? 'selected' : '' }}
        >
            Hybride
        </option>

        <option
            value="Electrique"
            {{ request('carburant') == 'Electrique' ? 'selected' : '' }}
        >
            Électrique
        </option>

    </select>


    <!-- Statut -->

    <select name="statut">

        <option value="">
            Statut
        </option>

        <option
            value="Disponible"
            {{ request('statut') == 'Disponible' ? 'selected' : '' }}
        >
            Disponible
        </option>

        <option
            value="Vendu"
            {{ request('statut') == 'Vendu' ? 'selected' : '' }}
        >
            Vendu
        </option>

        <option
            value="Reserve"
            {{ request('statut') == 'Reserve' ? 'selected' : '' }}
        >
            Réservé
        </option>

    </select>


    <!-- Filtrer -->

    <button
        type="submit"
        class="filter-button"
    >
        Filtrer
    </button>


    <!-- Réinitialiser -->

    @if(request()->hasAny([
        'search',
        'marque_id',
        'carburant',
        'statut'
    ]))

        <a
            href="{{ route('vehicules.index') }}"
            class="reset-button"
        >
            Réinitialiser
        </a>

    @endif

</form>


<!-- =========================================================
     VEHICLES
========================================================= -->

<div class="vehicles-grid">

    @forelse($vehicules as $vehicule)

        <div class="vehicle-card">


            <!-- IMAGE -->

            <div class="vehicle-image">

                @if($vehicule->image)

                    <img
                        src="{{ asset('storage/' . $vehicule->image) }}"
                        alt="{{ $vehicule->marque->nom }} {{ $vehicule->modele }}"
                    >

                @else

                    <div class="image-placeholder">
                        🚘
                    </div>

                @endif


                <!-- FAVORITE -->

                <div class="favorite">
                    ♡
                </div>


                <!-- STATUS -->

                @if($vehicule->statut === 'Disponible')

                    <div class="status status-disponible">
                        Disponible
                    </div>

                @elseif($vehicule->statut === 'Reserve')

                    <div class="status status-reserve">
                        Réservé
                    </div>

                @else

                    <div class="status status-vendu">
                        Vendu
                    </div>

                @endif

            </div>


            <!-- BODY -->

            <div class="vehicle-body">


                <!-- TITLE -->

                <div class="vehicle-title">

                    <div>

                        <div class="vehicle-brand">
                            {{ $vehicule->marque->nom }}
                        </div>

                        <div class="vehicle-model">
                            {{ $vehicule->modele }}
                        </div>

                    </div>

                    <div class="vehicle-year">
                        {{ $vehicule->annee }}
                    </div>

                </div>


                <!-- PRICE -->

                <div class="vehicle-price">

                    $ {{ number_format($vehicule->prix, 0, ',', ' ') }}

                </div>


                <!-- INFO -->

                <div class="vehicle-info">

                    <div>
                        ⚙
                        {{ number_format($vehicule->kilometrage, 0, ',', ' ') }}
                        km
                    </div>

                    <div>
                        ⛽
                        {{ $vehicule->carburant }}
                    </div>

                    <div>
                        ⚙
                        {{ $vehicule->boite_vitesse }}
                    </div>

                </div>


                <!-- ACTIONS -->

                <div class="vehicle-actions">


                    <!-- VOIR -->

                    <a
                        href="{{ route('vehicules.show', $vehicule) }}"
                        class="action-btn"
                    >
                        ◉ Voir
                    </a>


                    <!-- MODIFIER -->

                    <a
                        href="{{ route('vehicules.edit', $vehicule) }}"
                        class="action-btn action-edit"
                    >
                        ✎ Modifier
                    </a>


                    <!-- SUPPRIMER -->

                    <form
                        action="{{ route('vehicules.destroy', $vehicule) }}"
                        method="POST"
                        class="delete-form"
                    >

                        @csrf

                        @method('DELETE')

                        <button
                            type="button"
                            class="action-btn action-delete"
                            style="width:100%;"
                            onclick="openDeleteModal(this)"
                            data-vehicle="{{ $vehicule->marque->nom }} {{ $vehicule->modele }}"
                        >
                            🗑 Supprimer
                        </button>

                    </form>

                </div>

            </div>

        </div>

    @empty

        <div
            style="
                grid-column:1/-1;
                text-align:center;
                padding:70px;
                color:#777;
            "
        >

            <div style="font-size:50px;">
                🚘
            </div>

            <h2>
                Aucun véhicule
            </h2>

            <p>
                Commencez par ajouter votre premier véhicule.
            </p>

        </div>

    @endforelse

</div>


<!-- =========================================================
     FOOTER
========================================================= -->

<div class="vehicles-footer">

    <div>

        Affichage de
        {{ $vehicules->count() }}
        véhicule(s)

        sur
        {{ $vehicules->total() }}

    </div>

    <div class="pagination">

        {{ $vehicules->links() }}

    </div>

</div>


<!-- =========================================================
     MODAL SUPPRESSION
========================================================= -->

<div
    id="deleteModal"
    class="delete-modal"
    aria-hidden="true"
>

    <!-- Overlay -->

    <div
        class="delete-modal-overlay"
        onclick="closeDeleteModal()"
    ></div>


    <!-- Fenêtre -->

    <div
        class="delete-modal-content"
        role="dialog"
        aria-modal="true"
        aria-labelledby="deleteModalTitle"
    >


        <!-- Fermer -->

        <button
            type="button"
            class="delete-modal-close"
            onclick="closeDeleteModal()"
            aria-label="Fermer"
        >
            ×
        </button>


        <!-- Icône -->

        <div class="delete-icon">

            <span>
                ⚠️
            </span>

        </div>


        <!-- Titre -->

        <h2 id="deleteModalTitle">
            Supprimer le véhicule ?
        </h2>


        <p>
            Vous êtes sur le point de supprimer :
        </p>


        <!-- Nom du véhicule -->

        <div
            id="vehicleToDelete"
            class="vehicle-to-delete"
        >
            Véhicule
        </div>


        <!-- Avertissement -->

        <p class="warning-text">
            Cette action est définitive et ne pourra pas être annulée.
        </p>


        <!-- Boutons -->

        <div class="delete-modal-actions">


            <!-- Annuler -->

            <button
                type="button"
                class="modal-btn modal-cancel"
                onclick="closeDeleteModal()"
            >
                ✕ &nbsp; Annuler
            </button>


            <!-- Confirmer -->

            <button
                type="button"
                class="modal-btn modal-confirm"
                onclick="confirmDelete()"
            >
                🗑 &nbsp; Oui, supprimer
            </button>

        </div>

    </div>

</div>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>

    let deleteForm = null;


    /*
    |--------------------------------------------------------------------------
    | OUVRIR LA MODAL
    |--------------------------------------------------------------------------
    */

    function openDeleteModal(button) {

        const modal =
            document.getElementById('deleteModal');

        const vehicleName =
            button.getAttribute('data-vehicle');


        deleteForm =
            button.closest('.delete-form');


        document.getElementById('vehicleToDelete')
            .textContent = vehicleName;


        modal.classList.add('active');

        modal.setAttribute(
            'aria-hidden',
            'false'
        );


        document.body.style.overflow = 'hidden';

    }


    /*
    |--------------------------------------------------------------------------
    | FERMER LA MODAL
    |--------------------------------------------------------------------------
    */

    function closeDeleteModal() {

        const modal =
            document.getElementById('deleteModal');


        modal.classList.remove('active');

        modal.setAttribute(
            'aria-hidden',
            'true'
        );


        document.body.style.overflow = '';

        deleteForm = null;

    }


    /*
    |--------------------------------------------------------------------------
    | CONFIRMER LA SUPPRESSION
    |--------------------------------------------------------------------------
    */

    function confirmDelete() {

        if (deleteForm) {

            deleteForm.submit();

        }

    }


    /*
    |--------------------------------------------------------------------------
    | TOUCHE ESCAPE
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function(event) {

            if (event.key === 'Escape') {

                closeDeleteModal();

            }

        }
    );

</script>


@endsection
```
