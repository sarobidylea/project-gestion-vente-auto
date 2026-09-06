```blade
@extends('layouts.app')

@section('title', 'Détails du véhicule - Luxora Motors')

@section('styles')

<style>

    /* =========================================================
       PAGE DETAILS
    ========================================================= */

    .vehicle-details-page {
        margin: 0 -42px;

        padding-bottom: 50px;

        background:
            radial-gradient(
                circle at top right,
                rgba(229,9,20,.06),
                transparent 35%
            );
    }


    /* =========================================================
       HEADER
    ========================================================= */

    .details-header {
        position: relative;

        padding: 30px 42px;

        border-bottom: 1px solid #1d2529;

        background:
            linear-gradient(
                90deg,
                #050505,
                #0a0d0f
            );
    }

    .details-breadcrumb {
        color: #666;

        font-size: 11px;

        margin-bottom: 12px;
    }

    .details-breadcrumb a {
        color: #777;

        text-decoration: none;

        transition: .2s;
    }

    .details-breadcrumb a:hover {
        color: #ed101b;
    }

    .details-breadcrumb span {
        color: #ddd;
    }

    .details-header-content {
        display: flex;

        justify-content: space-between;
        align-items: flex-end;

        gap: 25px;
    }

    .details-label {
        display: block;

        margin-bottom: 6px;

        color: #ed101b;

        font-size: 11px;

        font-weight: 800;

        letter-spacing: 2px;

        text-transform: uppercase;
    }

    .details-header h1 {
        margin: 0;

        color: #fff;

        font-size: 32px;

        font-weight: 800;

        letter-spacing: -1px;
    }

    .details-header-description {
        margin: 7px 0 0;

        color: #888;

        font-size: 13px;
    }


    /* =========================================================
       HEADER BUTTONS
    ========================================================= */

    .details-header-actions {
        display: flex;

        gap: 8px;
    }

    .details-header-btn {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: 7px;

        padding: 11px 17px;

        border-radius: 6px;

        text-decoration: none;

        font-size: 12px;

        font-weight: 700;

        transition: .2s;
    }

    .details-back-btn {
        background: #171b1d;

        border: 1px solid #303639;

        color: #bbb;
    }

    .details-back-btn:hover {
        background: #24292c;

        color: white;
    }

    .details-edit-btn {
        background: #e50914;

        border: 1px solid #e50914;

        color: white;
    }

    .details-edit-btn:hover {
        background: #ff1e2d;

        transform: translateY(-2px);
    }


    /* =========================================================
       MAIN CONTENT
    ========================================================= */

    .details-container {
        max-width: 1250px;

        margin: 0 auto;

        padding: 25px 42px;
    }

    .details-card {
        display: grid;

        grid-template-columns: 48% 52%;

        overflow: hidden;

        background:
            linear-gradient(
                180deg,
                #0b1013,
                #07090a
            );

        border: 1px solid #242b2f;

        border-radius: 12px;

        box-shadow:
            0 15px 50px rgba(0,0,0,.45);
    }


    /* =========================================================
       IMAGE
    ========================================================= */

    .details-image {
        position: relative;

        min-height: 570px;

        overflow: hidden;

        background:
            radial-gradient(
                ellipse at center,
                #30383d,
                #101416 65%,
                #050505
            );
    }

    .details-image img {
        width: 100%;

        height: 100%;

        min-height: 570px;

        display: block;

        object-fit: cover;
    }

    .details-image-placeholder {
        min-height: 570px;

        display: flex;

        flex-direction: column;

        align-items: center;
        justify-content: center;

        gap: 12px;

        color: #555;
    }

    .details-image-placeholder-icon {
        font-size: 80px;

        opacity: .35;
    }

    .details-image-placeholder-text {
        font-size: 12px;

        color: #666;
    }


    /* =========================================================
       STATUS
    ========================================================= */

    .details-status {
        position: absolute;

        top: 20px;

        right: 20px;

        padding: 8px 14px;

        border-radius: 30px;

        font-size: 10px;

        font-weight: 800;

        text-transform: uppercase;

        letter-spacing: .5px;

        backdrop-filter: blur(8px);
    }

    .details-status-disponible {
        background: rgba(8,115,50,.92);

        color: #c1ffd5;

        border: 1px solid #0b9b48;
    }

    .details-status-reserve {
        background: rgba(154,105,0,.92);

        color: #ffe7a0;

        border: 1px solid #c99600;
    }

    .details-status-vendu {
        background: rgba(157,7,17,.92);

        color: #ffd0d3;

        border: 1px solid #c20a17;
    }


    /* =========================================================
       DETAILS CONTENT
    ========================================================= */

    .details-content {
        padding: 38px;
    }

    .details-brand {
        color: #ed101b;

        font-size: 12px;

        font-weight: 800;

        text-transform: uppercase;

        letter-spacing: 2px;
    }

    .details-model {
        margin: 5px 0 0;

        color: white;

        font-size: 34px;

        line-height: 1.1;

        font-weight: 800;
    }

    .details-year {
        margin-top: 8px;

        color: #777;

        font-size: 12px;
    }


    /* =========================================================
       PRICE
    ========================================================= */

    .details-price {
        margin-top: 25px;

        padding-bottom: 25px;

        border-bottom: 1px solid #202629;
    }

    .details-price-label {
        display: block;

        margin-bottom: 4px;

        color: #666;

        font-size: 10px;

        text-transform: uppercase;

        letter-spacing: 1px;
    }

    .details-price-value {
        color: #ff1823;

        font-size: 27px;

        font-weight: 800;
    }


    /* =========================================================
       INFO GRID
    ========================================================= */

    .details-section {
        margin-top: 25px;
    }

    .details-section-title {
        display: flex;

        align-items: center;

        gap: 8px;

        margin-bottom: 15px;

        color: white;

        font-size: 14px;

        font-weight: 700;
    }

    .details-section-title::before {
        content: "";

        width: 3px;

        height: 16px;

        background: #ed101b;

        border-radius: 3px;
    }

    .details-grid {
        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 8px;
    }

    .details-item {
        padding: 13px;

        background: #111518;

        border: 1px solid #242c30;

        border-radius: 7px;

        transition: .2s;
    }

    .details-item:hover {
        border-color: #3b4549;
    }

    .details-item-label {
        display: block;

        margin-bottom: 5px;

        color: #666;

        font-size: 10px;

        text-transform: uppercase;

        letter-spacing: .5px;
    }

    .details-item-value {
        display: block;

        color: #ddd;

        font-size: 13px;

        font-weight: 600;
    }


    /* =========================================================
       DESCRIPTION
    ========================================================= */

    .details-description {
        margin-top: 25px;

        padding-top: 25px;

        border-top: 1px solid #202629;
    }

    .details-description-text {
        color: #999;

        font-size: 13px;

        line-height: 1.8;

        white-space: pre-line;
    }


    /* =========================================================
       BOTTOM ACTIONS
    ========================================================= */

    .details-actions {
        display: flex;

        gap: 8px;

        margin-top: 28px;

        padding-top: 22px;

        border-top: 1px solid #202629;
    }

    .details-main-action {
        flex: 1;

        display: flex;

        justify-content: center;
        align-items: center;

        gap: 7px;

        height: 43px;

        background: #e50914;

        border: 1px solid #e50914;

        border-radius: 7px;

        color: white;

        text-decoration: none;

        font-size: 12px;

        font-weight: 700;

        transition: .2s;
    }

    .details-main-action:hover {
        background: #ff1e2d;

        transform: translateY(-2px);
    }

    .details-list-action {
        flex: 1;

        display: flex;

        justify-content: center;
        align-items: center;

        gap: 7px;

        height: 43px;

        background: #171b1d;

        border: 1px solid #303639;

        border-radius: 7px;

        color: #bbb;

        text-decoration: none;

        font-size: 12px;

        font-weight: 700;

        transition: .2s;
    }

    .details-list-action:hover {
        background: #24292c;

        color: white;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 1000px) {

        .details-card {
            grid-template-columns: 1fr;
        }

        .details-image,
        .details-image img {
            min-height: 400px;
        }

    }


    @media (max-width: 700px) {

        .vehicle-details-page {
            margin: 0 -20px;
        }

        .details-header {
            padding: 25px 20px;
        }

        .details-header-content {
            flex-direction: column;

            align-items: flex-start;
        }

        .details-header-actions {
            width: 100%;
        }

        .details-header-btn {
            flex: 1;
        }

        .details-container {
            padding: 20px;
        }

        .details-content {
            padding: 25px 20px;
        }

        .details-model {
            font-size: 29px;
        }

        .details-grid {
            grid-template-columns: 1fr;
        }

        .details-actions {
            flex-direction: column;
        }

    }

</style>

@endsection


@section('content')

<div class="vehicle-details-page">


    <!-- =====================================================
         HEADER
    ====================================================== -->

    <div class="details-header">

        <div class="details-breadcrumb">

            <a href="{{ route('vehicules.index') }}">
                Véhicules
            </a>

            &nbsp;›&nbsp;

            <span>
                Détails
            </span>

        </div>


        <div class="details-header-content">

            <div>

                <span class="details-label">
                    LUXORA MOTORS
                </span>

                <h1>
                    Détails du véhicule
                </h1>

                <p class="details-header-description">
                    Consultez toutes les informations de ce véhicule.
                </p>

            </div>


            <div class="details-header-actions">


                <!-- RETOUR -->

                <a
                    href="{{ route('vehicules.index') }}"
                    class="details-header-btn details-back-btn"
                >
                    ← &nbsp; Retour
                </a>


                <!-- MODIFIER -->

                <a
                    href="{{ route('vehicules.edit', $vehicule) }}"
                    class="details-header-btn details-edit-btn"
                >
                    ✎ &nbsp; Modifier
                </a>

            </div>

        </div>

    </div>


    <!-- =====================================================
         CONTENT
    ====================================================== -->

    <div class="details-container">


        <div class="details-card">


            <!-- =================================================
                 IMAGE
            ================================================== -->

            <div class="details-image">

                @if($vehicule->image)

                    <img
                        src="{{ asset('storage/' . $vehicule->image) }}"
                        alt="{{ $vehicule->marque->nom }} {{ $vehicule->modele }}"
                    >

                @else

                    <div class="details-image-placeholder">

                        <div class="details-image-placeholder-icon">
                            🚘
                        </div>

                        <div class="details-image-placeholder-text">
                            Aucune image disponible
                        </div>

                    </div>

                @endif


                <!-- STATUS -->

                @if($vehicule->statut === 'Disponible')

                    <div class="details-status details-status-disponible">
                        Disponible
                    </div>

                @elseif($vehicule->statut === 'Reserve')

                    <div class="details-status details-status-reserve">
                        Réservé
                    </div>

                @else

                    <div class="details-status details-status-vendu">
                        Vendu
                    </div>

                @endif

            </div>


            <!-- =================================================
                 INFORMATIONS
            ================================================== -->

            <div class="details-content">


                <!-- MARQUE -->

                <div class="details-brand">
                    {{ $vehicule->marque->nom }}
                </div>


                <!-- MODELE -->

                <h2 class="details-model">
                    {{ $vehicule->modele }}
                </h2>


                <!-- ANNEE -->

                <div class="details-year">
                    Année {{ $vehicule->annee }}
                </div>


                <!-- PRIX -->

                <div class="details-price">

                    <span class="details-price-label">
                        Prix de vente
                    </span>

                    <div class="details-price-value">

                    $ {{ number_format($vehicule->prix, 0, ',', ' ') }}

                    </div>

                </div>


                <!-- =================================================
                     CARACTERISTIQUES
                ================================================== -->

                <div class="details-section">

                    <div class="details-section-title">
                        Caractéristiques du véhicule
                    </div>


                    <div class="details-grid">


                        <!-- Année -->

                        <div class="details-item">

                            <span class="details-item-label">
                                Année
                            </span>

                            <span class="details-item-value">
                                {{ $vehicule->annee }}
                            </span>

                        </div>


                        <!-- Kilométrage -->

                        <div class="details-item">

                            <span class="details-item-label">
                                Kilométrage
                            </span>

                            <span class="details-item-value">

                                {{ number_format(
                                    $vehicule->kilometrage,
                                    0,
                                    ',',
                                    ' '
                                ) }}

                                km

                            </span>

                        </div>


                        <!-- Carburant -->

                        <div class="details-item">

                            <span class="details-item-label">
                                Carburant
                            </span>

                            <span class="details-item-value">
                                {{ $vehicule->carburant }}
                            </span>

                        </div>


                        <!-- Boîte -->

                        <div class="details-item">

                            <span class="details-item-label">
                                Boîte de vitesse
                            </span>

                            <span class="details-item-value">
                                {{ $vehicule->boite_vitesse }}
                            </span>

                        </div>


                        <!-- Couleur -->

                        <div class="details-item">

                            <span class="details-item-label">
                                Couleur
                            </span>

                            <span class="details-item-value">

                                {{ $vehicule->couleur ?? 'Non précisée' }}

                            </span>

                        </div>


                        <!-- Puissance -->

                        <div class="details-item">

                            <span class="details-item-label">
                                Puissance
                            </span>

                            <span class="details-item-value">

                                @if($vehicule->puissance)

                                    {{ $vehicule->puissance }} CV

                                @else

                                    Non précisée

                                @endif

                            </span>

                        </div>


                        <!-- Marque -->

                        <div class="details-item">

                            <span class="details-item-label">
                                Marque
                            </span>

                            <span class="details-item-value">
                                {{ $vehicule->marque->nom }}
                            </span>

                        </div>


                        <!-- Statut -->

                        <div class="details-item">

                            <span class="details-item-label">
                                Statut
                            </span>

                            <span class="details-item-value">

                                @if($vehicule->statut === 'Disponible')

                                    Disponible

                                @elseif($vehicule->statut === 'Reserve')

                                    Réservé

                                @else

                                    Vendu

                                @endif

                            </span>

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     DESCRIPTION
                ================================================== -->

                @if($vehicule->description)

                    <div class="details-description">

                        <div class="details-section-title">
                            Description
                        </div>

                        <div class="details-description-text">

                            {{ $vehicule->description }}

                        </div>

                    </div>

                @endif


                <!-- =================================================
                     ACTIONS
                ================================================== -->

                <div class="details-actions">


                    <!-- MODIFIER -->

                    <a
                        href="{{ route('vehicules.edit', $vehicule) }}"
                        class="details-main-action"
                    >
                        ✎ &nbsp; Modifier le véhicule
                    </a>


                    <!-- RETOUR LISTE -->

                    <a
                        href="{{ route('vehicules.index') }}"
                        class="details-list-action"
                    >
                        ☰ &nbsp; Tous les véhicules
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
```
