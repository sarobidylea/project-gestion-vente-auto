@extends('layouts.client')

@section('title', ($vehicule->marque->nom ?? 'LUXORA') . ' ' . $vehicule->modele . ' — LUXORA MOTORS')

@section('content')

<style>
    .vehicle-show-page {
        min-height: 100vh;
        background: #080808;
        color: #fff;
    }

    /* =========================
       HERO
    ========================= */

    .vehicle-hero {
        position: relative;
        min-height: 620px;
        display: flex;
        align-items: flex-end;
        overflow: hidden;
        background: #0d0d0d;
    }

    .vehicle-hero-image {
        position: absolute;
        inset: 0;
    }

    .vehicle-hero-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .vehicle-hero-overlay {
        position: absolute;
        inset: 0;
        background:
            linear-gradient(
                to top,
                rgba(0,0,0,.98) 0%,
                rgba(0,0,0,.65) 40%,
                rgba(0,0,0,.15) 100%
            );
    }

    .vehicle-hero-content {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 1400px;
        margin: auto;
        padding: 150px 30px 70px;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 45px;
        color: #aaa;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        transition: .3s ease;
    }

    .back-link:hover {
        color: #fff;
    }

    .vehicle-hero-brand {
        color: #e50914;
        font-size: 13px;
        font-weight: 900;
        letter-spacing: 4px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .vehicle-hero-title {
        margin: 0;
        font-size: clamp(42px, 7vw, 88px);
        font-weight: 900;
        letter-spacing: -4px;
        line-height: .95;
    }

    .vehicle-hero-price {
        margin-top: 25px;
        font-size: clamp(25px, 3vw, 38px);
        font-weight: 900;
    }

    .available-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 22px;
        padding: 9px 14px;
        background: rgba(229, 9, 20, .12);
        border: 1px solid rgba(229, 9, 20, .5);
        color: #fff;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .available-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #e50914;
    }

    /* =========================
       MAIN
    ========================= */

    .vehicle-main {
        max-width: 1400px;
        margin: auto;
        padding: 75px 30px 100px;
    }

    .vehicle-layout {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 55px;
        align-items: start;
    }

    /* =========================
       DESCRIPTION
    ========================= */

    .section-label {
        color: #e50914;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .section-title {
        margin: 0 0 25px;
        font-size: 32px;
        font-weight: 900;
    }

    .vehicle-description {
        color: #999;
        font-size: 15px;
        line-height: 1.9;
        margin-bottom: 45px;
    }

    /* =========================
       SPECIFICATIONS
    ========================= */

    .specifications {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        border-top: 1px solid #242424;
        border-left: 1px solid #242424;
    }

    .spec-item {
        padding: 22px;
        border-right: 1px solid #242424;
        border-bottom: 1px solid #242424;
        background: #101010;
    }

    .spec-label {
        display: block;
        color: #666;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    .spec-value {
        color: #fff;
        font-size: 15px;
        font-weight: 700;
    }

    /* =========================
       CONTACT CARD
    ========================= */

    .contact-card {
        position: sticky;
        top: 100px;
        padding: 35px;
        background: #111;
        border: 1px solid #282828;
    }

    .contact-card::before {
        content: "";
        display: block;
        width: 45px;
        height: 3px;
        background: #e50914;
        margin-bottom: 28px;
    }

    .contact-card-title {
        margin: 0 0 12px;
        font-size: 25px;
        font-weight: 900;
    }

    .contact-card-text {
        margin: 0 0 30px;
        color: #888;
        font-size: 13px;
        line-height: 1.7;
    }

    .action-button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        min-height: 52px;
        margin-bottom: 12px;
        text-decoration: none;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        transition: .3s ease;
    }

    .action-primary {
        background: #e50914;
        color: #fff;
    }

    .action-primary:hover {
        background: #bd0711;
        transform: translateY(-2px);
    }

    .action-secondary {
        border: 1px solid #333;
        color: #fff;
    }

    .action-secondary:hover {
        border-color: #e50914;
        color: #e50914;
    }

    .contact-info {
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #252525;
    }

    .contact-info-item {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
        color: #888;
        font-size: 12px;
    }

    .contact-icon {
        color: #e50914;
        font-weight: 900;
    }

    /* =========================
       DESCRIPTION EMPTY
    ========================= */

    .no-description {
        color: #666;
        font-style: italic;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 950px) {
        .vehicle-layout {
            grid-template-columns: 1fr;
        }

        .contact-card {
            position: static;
        }
    }

    @media (max-width: 650px) {
        .vehicle-hero {
            min-height: 550px;
        }

        .vehicle-hero-content {
            padding: 130px 20px 50px;
        }

        .vehicle-main {
            padding: 50px 20px 70px;
        }

        .specifications {
            grid-template-columns: 1fr;
        }

        .contact-card {
            padding: 25px;
        }

        .vehicle-hero-title {
            letter-spacing: -2px;
        }
    }
</style>


<div class="vehicle-show-page">

    {{-- =========================
         HERO
    ========================== --}}

    <section class="vehicle-hero">

        <div class="vehicle-hero-image">

            @if($vehicule->image)

                <img
                    src="{{ asset('storage/' . $vehicule->image) }}"
                    alt="{{ $vehicule->marque->nom ?? '' }} {{ $vehicule->modele }}"
                >

            @else

                <img
                    src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?auto=format&fit=crop&w=1800&q=85"
                    alt="Véhicule LUXORA MOTORS"
                >

            @endif

        </div>

        <div class="vehicle-hero-overlay"></div>


        <div class="vehicle-hero-content">

            <a
                href="{{ route('client.vehicules') }}"
                class="back-link"
            >
                ← Retour au catalogue
            </a>

            <div class="vehicle-hero-brand">
                {{ $vehicule->marque->nom ?? 'LUXORA MOTORS' }}
            </div>

            <h1 class="vehicle-hero-title">
                {{ $vehicule->modele }}
            </h1>

            <div class="vehicle-hero-price">
                {{ number_format($vehicule->prix, 0, ',', ' ') }} Ar
            </div>

            <div class="available-badge">
                <span class="available-dot"></span>
                Disponible
            </div>

        </div>

    </section>


    {{-- =========================
         MAIN
    ========================== --}}

    <main class="vehicle-main">

        <div class="vehicle-layout">

            {{-- =========================
                 LEFT
            ========================== --}}

            <div>

                <div class="section-label">
                    Présentation
                </div>

                <h2 class="section-title">
                    À propos de ce véhicule
                </h2>

                @if($vehicule->description)

                    <div class="vehicle-description">
                        {{ $vehicule->description }}
                    </div>

                @else

                    <div class="vehicle-description no-description">
                        Aucun descriptif détaillé n'est disponible pour ce véhicule.
                    </div>

                @endif


                {{-- =========================
                     CARACTÉRISTIQUES
                ========================== --}}

                <div class="section-label">
                    Caractéristiques
                </div>

                <h2 class="section-title">
                    Fiche technique
                </h2>

                <div class="specifications">

                    <div class="spec-item">
                        <span class="spec-label">
                            Marque
                        </span>

                        <span class="spec-value">
                            {{ $vehicule->marque->nom ?? '—' }}
                        </span>
                    </div>


                    <div class="spec-item">
                        <span class="spec-label">
                            Modèle
                        </span>

                        <span class="spec-value">
                            {{ $vehicule->modele }}
                        </span>
                    </div>


                    <div class="spec-item">
                        <span class="spec-label">
                            Année
                        </span>

                        <span class="spec-value">
                            {{ $vehicule->annee }}
                        </span>
                    </div>


                    <div class="spec-item">
                        <span class="spec-label">
                            Kilométrage
                        </span>

                        <span class="spec-value">
                            {{ number_format($vehicule->kilometrage, 0, ',', ' ') }} km
                        </span>
                    </div>


                    <div class="spec-item">
                        <span class="spec-label">
                            Carburant
                        </span>

                        <span class="spec-value">
                            {{ $vehicule->carburant }}
                        </span>
                    </div>


                    <div class="spec-item">
                        <span class="spec-label">
                            Boîte de vitesse
                        </span>

                        <span class="spec-value">
                            {{ $vehicule->boite_vitesse }}
                        </span>
                    </div>


                    <div class="spec-item">
                        <span class="spec-label">
                            Couleur
                        </span>

                        <span class="spec-value">
                            {{ $vehicule->couleur ?: '—' }}
                        </span>
                    </div>


                    <div class="spec-item">
                        <span class="spec-label">
                            Puissance
                        </span>

                        <span class="spec-value">
                            @if($vehicule->puissance)
                                {{ $vehicule->puissance }} ch
                            @else
                                —
                            @endif
                        </span>
                    </div>

                </div>

            </div>


            {{-- =========================
                 RIGHT
            ========================== --}}

            <aside class="contact-card">

                <h3 class="contact-card-title">
                    Ce véhicule vous intéresse ?
                </h3>

                <p class="contact-card-text">
                    Contactez LUXORA MOTORS pour obtenir davantage
                    d'informations ou organiser une visite du véhicule.
                </p>


                {{-- Prendre rendez-vous --}}
            
                <a
                    href="{{ auth()->check()
                        ? route('client.rendez-vous.create', $vehicule)
                        : route('client.login', ['redirect' => route('client.rendez-vous.create', $vehicule)])
                    }}"
                    class="action-button action-primary"
                >
                    Prendre rendez-vous
                </a>




                {{-- Connexion --}}

                <a
                    href="{{ route('login') }}"
                    class="action-button action-secondary"
                >
                    Se connecter
                </a>


                <div class="contact-info">

                    <div class="contact-info-item">
                        <span class="contact-icon">◆</span>
                        <span>LUXORA MOTORS</span>
                    </div>

                    <div class="contact-info-item">
                        <span class="contact-icon">◆</span>
                        <span>Fianarantsoa · Madagascar</span>
                    </div>

                    <div class="contact-info-item">
                        <span class="contact-icon">◆</span>
                        <span>Véhicule disponible</span>
                    </div>

                </div>

            </aside>

        </div>

    </main>

</div>

@endsection

