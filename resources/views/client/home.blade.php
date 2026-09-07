@extends('layouts.client')

@section('title', 'LUXORA MOTORS — Automobile Premium')

@section('content')

<style>
    /* =========================================
       HERO
    ========================================= */

    .luxora-hero {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        overflow: hidden;

        background:
            linear-gradient(
                90deg,
                rgba(0, 0, 0, 0.95) 0%,
                rgba(0, 0, 0, 0.78) 42%,
                rgba(0, 0, 0, 0.30) 75%,
                rgba(0, 0, 0, 0.75) 100%
            ),
            url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=2000&q=90');

        background-size: cover;
        background-position: center;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;

        background:
            linear-gradient(
                to top,
                #080808 0%,
                transparent 30%
            );
    }

    .hero-content {
        position: relative;
        z-index: 2;

        width: 100%;
        max-width: 1400px;

        margin: 0 auto;
        padding: 120px 6% 80px;
    }

    .hero-small-title {
        display: flex;
        align-items: center;
        gap: 12px;

        margin-bottom: 20px;

        color: #e50914;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 4px;

        animation: fadeUp 1s ease forwards;
    }

    .hero-small-title::before {
        content: '';

        width: 45px;
        height: 2px;

        background: #e50914;
    }

    .hero-title {
        max-width: 800px;

        font-size: clamp(45px, 7vw, 95px);
        line-height: 0.98;
        font-weight: 800;
        letter-spacing: -3px;

        margin-bottom: 30px;

        animation: fadeUp 1s ease 0.15s both;
    }

    .hero-title span {
        color: #e50914;
    }

    .hero-description {
        max-width: 580px;

        color: #d0d0d0;
        font-size: 16px;
        line-height: 1.8;

        margin-bottom: 40px;

        animation: fadeUp 1s ease 0.3s both;
    }

    .hero-buttons {
        display: flex;
        gap: 15px;

        animation: fadeUp 1s ease 0.45s both;
    }

    .hero-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;

        min-width: 210px;

        padding: 16px 25px;

        font-size: 13px;
        font-weight: 700;
        letter-spacing: 1px;

        transition: all 0.3s ease;
    }

    .hero-btn-primary {
        background: #e50914;
        color: #ffffff;
        border: 1px solid #e50914;
    }

    .hero-btn-primary:hover {
        background: #b80710;
        border-color: #b80710;

        transform: translateY(-3px);

        box-shadow:
            0 12px 30px rgba(229, 9, 20, 0.3);
    }

    .hero-btn-secondary {
        background: rgba(255, 255, 255, 0.05);

        color: #ffffff;

        border: 1px solid rgba(255, 255, 255, 0.4);

        backdrop-filter: blur(5px);
    }

    .hero-btn-secondary:hover {
        background: #ffffff;
        color: #000000;

        transform: translateY(-3px);
    }

    .hero-info {
        position: absolute;

        bottom: 40px;
        left: 6%;
        right: 6%;

        display: flex;
        justify-content: space-between;
        align-items: center;

        z-index: 3;

        color: #aaa;

        font-size: 11px;
        letter-spacing: 2px;

        text-transform: uppercase;
    }

    .scroll-indicator {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .scroll-line {
        width: 50px;
        height: 1px;

        background: #e50914;
    }


    /* =========================================
       SECTION GENERAL
    ========================================= */

    .luxora-section {
        padding: 100px 6%;

        max-width: 1500px;

        margin: auto;
    }

    .section-heading {
        text-align: center;

        margin-bottom: 55px;
    }

    .section-label {
        color: #e50914;

        font-size: 11px;
        font-weight: 700;

        letter-spacing: 4px;
        text-transform: uppercase;

        margin-bottom: 15px;
    }

    .section-title {
        font-size: clamp(30px, 4vw, 48px);

        font-weight: 700;

        margin-bottom: 15px;
    }

    .section-description {
        max-width: 650px;

        margin: auto;

        color: #888;

        font-size: 14px;
        line-height: 1.8;
    }


    /* =========================================
       VEHICULES
    ========================================= */

    .vehicles-section {
        background: #080808;
    }

    .vehicles-grid {
        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

        gap: 25px;
    }

    .vehicle-card {
        position: relative;

        overflow: hidden;

        background: #111;

        border: 1px solid rgba(255, 255, 255, 0.08);

        transition: all 0.4s ease;
    }

    .vehicle-card:hover {
        transform: translateY(-8px);

        border-color: rgba(229, 9, 20, 0.5);

        box-shadow:
            0 20px 50px rgba(0, 0, 0, 0.5);
    }

    .vehicle-image {
        position: relative;

        height: 260px;

        overflow: hidden;

        background: #151515;
    }

    .vehicle-image img {
        width: 100%;
        height: 100%;

        object-fit: cover;

        transition: transform 0.6s ease;
    }

    .vehicle-card:hover .vehicle-image img {
        transform: scale(1.08);
    }

    .vehicle-image::after {
        content: '';

        position: absolute;
        inset: 0;

        background:
            linear-gradient(
                to top,
                rgba(0, 0, 0, 0.7),
                transparent 60%
            );
    }

    .vehicle-status {
        position: absolute;

        top: 15px;
        right: 15px;

        z-index: 2;

        padding: 7px 12px;

        background: rgba(0, 0, 0, 0.75);

        border: 1px solid rgba(255, 255, 255, 0.15);

        color: #ffffff;

        font-size: 10px;
        font-weight: 700;

        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .vehicle-status.available {
        color: #5cff8d;

        border-color: rgba(92, 255, 141, 0.3);
    }

    .vehicle-content {
        padding: 25px;
    }

    .vehicle-brand {
        color: #e50914;

        font-size: 11px;
        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: 2px;

        margin-bottom: 8px;
    }

    .vehicle-name {
        font-size: 21px;

        font-weight: 700;

        margin-bottom: 15px;
    }

    .vehicle-details {
        display: flex;
        flex-wrap: wrap;

        gap: 8px;

        color: #777;

        font-size: 11px;

        margin-bottom: 20px;
    }

    .vehicle-detail {
        padding: 6px 9px;

        background: #181818;

        border: 1px solid rgba(255, 255, 255, 0.06);
    }

    .vehicle-price {
        display: flex;

        justify-content: space-between;
        align-items: center;

        gap: 15px;

        padding-top: 18px;

        border-top:
            1px solid rgba(255, 255, 255, 0.08);
    }

    .price {
        color: #ffffff;

        font-size: 18px;

        font-weight: 700;

        white-space: nowrap;
    }

    .vehicle-link {
        color: #e50914;

        font-size: 11px;

        font-weight: 700;

        text-transform: uppercase;

        letter-spacing: 1px;

        transition: 0.3s;
    }

    .vehicle-link:hover {
        color: #ffffff;
    }

    .vehicles-more {
        text-align: center;

        margin-top: 45px;
    }

    .vehicles-more a {
        display: inline-block;

        padding: 14px 30px;

        border: 1px solid rgba(255, 255, 255, 0.2);

        color: #ffffff;

        font-size: 11px;
        font-weight: 700;

        letter-spacing: 1px;

        transition: 0.3s;
    }

    .vehicles-more a:hover {
        background: #e50914;

        border-color: #e50914;
    }


    /* =========================================
       MARQUES
    ========================================= */

    .brands-section {
        background: #050505;
    }

    .brands-grid {
        display: grid;

        grid-template-columns:
            repeat(5, 1fr);

        border-top:
            1px solid rgba(255, 255, 255, 0.08);

        border-left:
            1px solid rgba(255, 255, 255, 0.08);
    }

    .brand-item {
        display: flex;

        justify-content: center;
        align-items: center;

        min-height: 120px;

        color: #777;

        font-size: 18px;

        font-weight: 700;

        letter-spacing: 2px;

        border-right:
            1px solid rgba(255, 255, 255, 0.08);

        border-bottom:
            1px solid rgba(255, 255, 255, 0.08);

        transition: 0.3s;
    }

    .brand-item:hover {
        color: #ffffff;

        background: #0e0e0e;
    }

    .brand-item span {
        transition: 0.3s;
    }

    .brand-item:hover span {
        color: #e50914;

        transform: scale(1.08);
    }


    /* =========================================
       POURQUOI NOUS
    ========================================= */

    .why-section {
        background: #080808;
    }

    .why-grid {
        display: grid;

        grid-template-columns:
            repeat(4, 1fr);

        gap: 20px;
    }

    .why-card {
        padding: 35px 25px;

        background: #0e0e0e;

        border:
            1px solid rgba(255, 255, 255, 0.07);

        transition: 0.3s;
    }

    .why-card:hover {
        border-color:
            rgba(229, 9, 20, 0.5);

        transform: translateY(-5px);
    }

    .why-icon {
        width: 45px;
        height: 45px;

        display: flex;

        justify-content: center;
        align-items: center;

        margin-bottom: 25px;

        background:
            rgba(229, 9, 20, 0.1);

        color: #e50914;

        font-size: 20px;

        border:
            1px solid rgba(229, 9, 20, 0.2);
    }

    .why-card h3 {
        font-size: 16px;

        margin-bottom: 12px;
    }

    .why-card p {
        color: #777;

        font-size: 13px;

        line-height: 1.7;
    }


    /* =========================================
       A PROPOS
    ========================================= */

    .about-section {
        background: #050505;
    }


    /* =========================================
       CTA
    ========================================= */

    .cta-section {
        position: relative;

        margin: 0 6% 100px;

        min-height: 350px;

        display: flex;

        justify-content: center;
        align-items: center;

        text-align: center;

        overflow: hidden;

        background:
            linear-gradient(
                rgba(0, 0, 0, 0.82),
                rgba(0, 0, 0, 0.92)
            ),
            url('https://images.unsplash.com/photo-1542282088-72c9c27ed0cd?auto=format&fit=crop&w=1800&q=85');

        background-size: cover;

        background-position: center;
    }

    .cta-content {
        position: relative;

        z-index: 2;

        padding: 50px 20px;
    }

    .cta-content h2 {
        font-size: clamp(30px, 5vw, 55px);

        margin-bottom: 15px;
    }

    .cta-content p {
        color: #aaa;

        font-size: 14px;

        margin-bottom: 30px;
    }

    .cta-btn {
        display: inline-block;

        padding: 15px 35px;

        background: #e50914;

        color: #ffffff;

        font-size: 12px;

        font-weight: 700;

        letter-spacing: 1px;

        transition: 0.3s;
    }

    .cta-btn:hover {
        background: #ffffff;

        color: #000000;

        transform: translateY(-3px);
    }


    /* =========================================
       ANIMATIONS
    ========================================= */

    @keyframes fadeUp {

        from {
            opacity: 0;

            transform:
                translateY(30px);
        }

        to {
            opacity: 1;

            transform:
                translateY(0);
        }
    }


    /* =========================================
       RESPONSIVE
    ========================================= */

    @media (max-width: 1000px) {

        .vehicles-grid {
            grid-template-columns:
                repeat(2, 1fr);
        }

        .why-grid {
            grid-template-columns:
                repeat(2, 1fr);
        }

        .brands-grid {
            grid-template-columns:
                repeat(3, 1fr);
        }
    }

    @media (max-width: 650px) {

        .luxora-hero {
            background-position:
                65% center;
        }

        .hero-content {
            padding:
                140px 6% 100px;
        }

        .hero-title {
            letter-spacing:
                -2px;
        }

        .hero-description {
            font-size:
                14px;
        }

        .hero-buttons {
            flex-direction:
                column;

            width:
                100%;
        }

        .hero-btn {
            width:
                100%;
        }

        .hero-info {
            display:
                none;
        }

        .luxora-section {
            padding:
                70px 5%;
        }

        .vehicles-grid {
            grid-template-columns:
                1fr;
        }

        .why-grid {
            grid-template-columns:
                1fr;
        }

        .brands-grid {
            grid-template-columns:
                repeat(2, 1fr);
        }

        .brand-item {
            min-height:
                90px;

            font-size:
                14px;
        }

        .vehicle-image {
            height:
                230px;
        }

        .vehicle-price {
            align-items:
                flex-start;

            flex-direction:
                column;
        }

        .cta-section {
            margin:
                0 5% 70px;
        }
    }
</style>


{{-- =========================================================
     HERO
========================================================= --}}

<section class="luxora-hero">

    <div class="hero-overlay"></div>

    <div class="hero-content">

        <div class="hero-small-title">
            LUXORA MOTORS
        </div>

        <h1 class="hero-title">
            PERFORMANCE<br>
            <span>WITHOUT</span><br>
            COMPROMISE
        </h1>

        <p class="hero-description">
            Découvrez une sélection exclusive de véhicules d'exception.
            Design, performance et élégance réunis pour vous offrir
            une expérience automobile incomparable.
        </p>

        <div class="hero-buttons">

            <a href="#vehicules"
               class="hero-btn hero-btn-primary">
                EXPLORER LES VÉHICULES
            </a>

            <a href="#contact"
               class="hero-btn hero-btn-secondary">
                NOUS CONTACTER
            </a>

        </div>

    </div>

    <div class="hero-info">

        <div class="scroll-indicator">
            <span class="scroll-line"></span>
            SCROLL TO DISCOVER
        </div>

        <div>
            FIANARANTSOA · MADAGASCAR
        </div>

    </div>

</section>


{{-- =========================================================
     VEHICULES
========================================================= --}}

<section id="vehicules"
         class="luxora-section vehicles-section">

    <div class="section-heading">

        <div class="section-label">
            Notre sélection
        </div>

        <h2 class="section-title">
            Nos véhicules
        </h2>

        <p class="section-description">
            Découvrez notre sélection de véhicules soigneusement
            choisis pour répondre aux exigences des passionnés
            d'automobile.
        </p>

    </div>


    <div class="vehicles-grid">

        @forelse($vehicules as $vehicule)

            <article class="vehicle-card">

                <div class="vehicle-image">

                    @if($vehicule->image)

                        <img
                            src="{{ asset('storage/' . $vehicule->image) }}"
                            alt="{{ $vehicule->marque->nom ?? '' }} {{ $vehicule->modele }}"
                        >

                    @else

                        <img
                            src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?auto=format&fit=crop&w=1000&q=80"
                            alt="Véhicule LUXORA MOTORS"
                        >

                    @endif


                    @if($vehicule->statut === 'Disponible')

                        <div class="vehicle-status available">
                            Disponible
                        </div>

                    @else

                        <div class="vehicle-status">
                            {{ $vehicule->statut }}
                        </div>

                    @endif

                </div>


                <div class="vehicle-content">

                    <div class="vehicle-brand">
                        {{ $vehicule->marque->nom ?? 'LUXORA' }}
                    </div>

                    <h3 class="vehicle-name">
                        {{ $vehicule->modele }}
                    </h3>


                    <div class="vehicle-details">

                        <span class="vehicle-detail">
                            {{ $vehicule->annee }}
                        </span>

                        <span class="vehicle-detail">
                            {{ $vehicule->carburant }}
                        </span>

                        <span class="vehicle-detail">
                            {{ $vehicule->boite_vitesse }}
                        </span>

                        <span class="vehicle-detail">
                            {{ number_format($vehicule->kilometrage, 0, ',', ' ') }} km
                        </span>

                    </div>


                    <div class="vehicle-price">

                        <div class="price">
                            {{ number_format($vehicule->prix, 0, ',', ' ') }} Ar
                        </div>

                        <a
                             href="{{ route('client.vehicule.show', $vehicule) }}"
                            class="vehicle-link"
                        >
                            Découvrir →
                        </a>

                    </div>

                </div>

            </article>

        @empty

            <div style="
                grid-column: 1 / -1;
                text-align: center;
                padding: 70px 20px;
                color: #777;
            ">

                <div style="
                    font-size: 40px;
                    margin-bottom: 20px;
                ">
                    🚗
                </div>

                <h3 style="
                    color: #fff;
                    margin-bottom: 10px;
                ">
                    Aucun véhicule disponible
                </h3>

                <p>
                    Notre sélection sera bientôt disponible.
                </p>

            </div>

        @endforelse

    </div>


    @if($vehicules->count() > 0)

        <div class="vehicles-more">

        <a href="{{ route('client.vehicules') }}">
            VOIR TOUS LES VÉHICULES →
        </a>

        </div>

    @endif

</section>


{{-- =========================================================
     MARQUES
========================================================= --}}

<section id="marques"
         class="luxora-section brands-section">

    <div class="section-heading">

        <div class="section-label">
            Excellence automobile
        </div>

        <h2 class="section-title">
            Nos marques
        </h2>

        <p class="section-description">
            Nous sélectionnons des marques reconnues pour leur
            qualité, leur innovation et leur performance.
        </p>

    </div>


    <div class="brands-grid">

        <div class="brand-item">
            <span>BMW</span>
        </div>

        <div class="brand-item">
            <span>MERCEDES</span>
        </div>

        <div class="brand-item">
            <span>AUDI</span>
        </div>

        <div class="brand-item">
            <span>PORSCHE</span>
        </div>

        <div class="brand-item">
            <span>TOYOTA</span>
        </div>

    </div>

</section>


{{-- =========================================================
     POURQUOI NOUS
========================================================= --}}

<section id="services"
         class="luxora-section why-section">

    <div class="section-heading">

        <div class="section-label">
            L'expérience LUXORA
        </div>

        <h2 class="section-title">
            Pourquoi nous ?
        </h2>

        <p class="section-description">
            Plus qu'une concession, LUXORA MOTORS vous accompagne
            dans chaque étape de votre expérience automobile.
        </p>

    </div>


    <div class="why-grid">

        <div class="why-card">

            <div class="why-icon">
                ✓
            </div>

            <h3>
                Véhicules sélectionnés
            </h3>

            <p>
                Chaque véhicule est soigneusement sélectionné
                selon des critères exigeants de qualité et de
                performance.
            </p>

        </div>


        <div class="why-card">

            <div class="why-icon">
                ◆
            </div>

            <h3>
                Service premium
            </h3>

            <p>
                Une expérience personnalisée et un accompagnement
                professionnel pour chaque client.
            </p>

        </div>


        <div class="why-card">

            <div class="why-icon">
                ◇
            </div>

            <h3>
                Prix transparents
            </h3>

            <p>
                Des informations claires et des prix transparents
                pour vous permettre de prendre la meilleure décision.
            </p>

        </div>


        <div class="why-card">

            <div class="why-icon">
                ★
            </div>

            <h3>
                Accompagnement
            </h3>

            <p>
                Notre équipe vous accompagne avant, pendant et
                après votre achat.
            </p>

        </div>

    </div>

</section>


{{-- =========================================================
     À PROPOS
========================================================= --}}

<section id="about"
         class="luxora-section about-section">

    <div class="section-heading">

        <div class="section-label">
            LUXORA MOTORS
        </div>

        <h2 class="section-title">
            L'automobile autrement.
        </h2>

        <p class="section-description">
            Notre ambition est de proposer à Madagascar une nouvelle
            vision de la vente automobile : plus moderne, plus
            transparente et entièrement orientée vers l'expérience
            client.
        </p>

    </div>

</section>


{{-- =========================================================
     CTA / CONTACT
========================================================= --}}

<section id="contact"
         class="cta-section">

    <div class="cta-content">

        <div class="section-label">
            Votre prochaine voiture vous attend
        </div>

        <h2>
            Prêt à passer<br>

            <span style="color:#e50914;">
                à la vitesse supérieure ?
            </span>
        </h2>

        <p>
            Notre équipe est à votre disposition pour vous accompagner.
        </p>

        <a
            href="mailto:contact@luxoramotors.com"
            class="cta-btn"
        >
            NOUS CONTACTER
        </a>

    </div>

</section>

@endsection

