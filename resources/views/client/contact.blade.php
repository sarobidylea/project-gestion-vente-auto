```blade
@extends('layouts.client')

@section('title', 'LUXORA MOTORS — Contact')

@section('content')

<style>

/* =========================================================
   CONTACT PAGE — LUXORA MOTORS
   Même identité visuelle que la page d'accueil
========================================================= */

.luxora-contact-page {
    background: #080808;
    color: #ffffff;
}


/* =========================================================
   HERO
========================================================= */

.contact-hero {
    position: relative;
    min-height: 55vh;

    display: flex;
    align-items: center;

    overflow: hidden;

    background:
        linear-gradient(
            90deg,
            rgba(0,0,0,0.96) 0%,
            rgba(0,0,0,0.78) 50%,
            rgba(0,0,0,0.45) 100%
        ),
        url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=2000&q=90');

    background-size: cover;
    background-position: center;
}


.contact-hero::after {
    content: '';

    position: absolute;

    inset: 0;

    background:
        linear-gradient(
            to top,
            #080808 0%,
            transparent 35%
        );
}


.contact-hero-content {
    position: relative;

    z-index: 2;

    width: 100%;
    max-width: 1400px;

    margin: auto;

    padding: 120px 6% 90px;
}


.contact-small-title {
    display: flex;
    align-items: center;

    gap: 12px;

    margin-bottom: 20px;

    color: #e50914;

    font-size: 13px;
    font-weight: 700;

    letter-spacing: 4px;

    text-transform: uppercase;
}


.contact-small-title::before {
    content: '';

    width: 45px;
    height: 2px;

    background: #e50914;
}


.contact-hero-title {
    max-width: 850px;

    margin-bottom: 25px;

    font-size: clamp(45px, 7vw, 90px);

    line-height: 0.98;

    font-weight: 800;

    letter-spacing: -3px;
}


.contact-hero-title span {
    color: #e50914;
}


.contact-hero-description {
    max-width: 600px;

    color: #c8c8c8;

    font-size: 16px;

    line-height: 1.8;
}


/* =========================================================
   SECTION GENERAL
========================================================= */

.contact-section {
    max-width: 1500px;

    margin: auto;

    padding: 100px 6%;
}


.contact-section-heading {
    margin-bottom: 55px;
}


.contact-section-label {
    margin-bottom: 14px;

    color: #e50914;

    font-size: 11px;

    font-weight: 700;

    letter-spacing: 4px;

    text-transform: uppercase;
}


.contact-section-title {
    margin: 0;

    font-size: clamp(30px, 4vw, 48px);

    font-weight: 700;
}


/* =========================================================
   CONTACT INFORMATION
========================================================= */

.contact-info-section {
    background: #080808;
}


.contact-info-grid {
    display: grid;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    border-top:
        1px solid rgba(255,255,255,0.08);

    border-left:
        1px solid rgba(255,255,255,0.08);
}


.contact-info-card {
    min-height: 230px;

    padding: 35px 28px;

    background: #0e0e0e;

    border-right:
        1px solid rgba(255,255,255,0.08);

    border-bottom:
        1px solid rgba(255,255,255,0.08);

    transition: all 0.35s ease;
}


.contact-info-card:hover {
    background: #111111;

    border-color:
        rgba(229,9,20,0.45);

    transform: translateY(-5px);
}


.contact-info-icon {
    width: 48px;
    height: 48px;

    display: flex;

    justify-content: center;
    align-items: center;

    margin-bottom: 25px;

    background:
        rgba(229,9,20,0.1);

    border:
        1px solid rgba(229,9,20,0.25);

    color: #e50914;

    font-size: 20px;
}


.contact-info-card h3 {
    margin-bottom: 12px;

    font-size: 16px;
}


.contact-info-card p {
    margin: 0;

    color: #777;

    font-size: 13px;

    line-height: 1.8;
}


.contact-info-card a {
    color: #aaa;

    text-decoration: none;

    transition: 0.3s;
}


.contact-info-card a:hover {
    color: #e50914;
}


/* =========================================================
   FORMULAIRE
========================================================= */

.contact-form-section {
    background: #050505;
}


.contact-form-layout {
    display: grid;

    grid-template-columns:
        0.75fr 1.25fr;

    gap: 60px;

    align-items: start;
}


/* LEFT SIDE */

.contact-form-intro {
    padding-top: 10px;
}


.contact-form-intro h3 {
    max-width: 450px;

    margin-bottom: 20px;

    font-size: 34px;

    line-height: 1.15;
}


.contact-form-intro h3 span {
    color: #e50914;
}


.contact-form-intro p {
    max-width: 480px;

    color: #777;

    font-size: 14px;

    line-height: 1.9;

    margin-bottom: 35px;
}


.contact-direct {
    display: flex;

    flex-direction: column;

    gap: 12px;
}


.contact-direct-item {
    display: flex;

    align-items: center;

    gap: 15px;

    padding: 16px;

    background: #0e0e0e;

    border:
        1px solid rgba(255,255,255,0.07);

    color: #aaa;

    text-decoration: none;

    font-size: 13px;

    transition: 0.3s;
}


.contact-direct-item:hover {
    color: #ffffff;

    border-color:
        rgba(229,9,20,0.45);

    transform: translateX(5px);
}


.contact-direct-icon {
    width: 38px;
    height: 38px;

    display: flex;

    justify-content: center;
    align-items: center;

    background:
        rgba(229,9,20,0.1);

    color: #e50914;
}


/* =========================================================
   FORM
========================================================= */

.contact-form-box {
    padding: 40px;

    background: #0b0b0b;

    border:
        1px solid rgba(255,255,255,0.08);
}


.contact-form-grid {
    display: grid;

    grid-template-columns:
        1fr 1fr;

    gap: 22px;
}


.contact-form-group {
    display: flex;

    flex-direction: column;

    gap: 9px;
}


.contact-form-group.full {
    grid-column: 1 / -1;
}


.contact-form-group label {
    color: #bbb;

    font-size: 11px;

    font-weight: 700;

    letter-spacing: 1px;

    text-transform: uppercase;
}


.contact-form-group label span {
    color: #e50914;
}


.contact-input {
    width: 100%;

    box-sizing: border-box;

    padding: 15px 16px;

    background: #111111;

    border:
        1px solid rgba(255,255,255,0.09);

    color: #ffffff;

    outline: none;

    border-radius: 0;

    font-family: inherit;

    font-size: 13px;

    transition: 0.3s;
}


.contact-input::placeholder {
    color: #555;
}


.contact-input:focus {
    border-color: #e50914;

    box-shadow:
        0 0 0 1px rgba(229,9,20,0.15);
}


.contact-form-group textarea {
    min-height: 160px;

    resize: vertical;
}


.contact-form-group select {
    cursor: pointer;
}


.contact-form-group select option {
    background: #111111;

    color: #ffffff;
}


.contact-error {
    color: #ff5964;

    font-size: 11px;
}


/* =========================================================
   SUBMIT
========================================================= */

.contact-submit-wrapper {
    margin-top: 28px;
}


.contact-submit {
    display: inline-flex;

    align-items: center;

    justify-content: center;

    gap: 15px;

    min-width: 230px;

    padding: 16px 28px;

    background: #e50914;

    border: 1px solid #e50914;

    color: #ffffff;

    font-size: 12px;

    font-weight: 700;

    letter-spacing: 1px;

    cursor: pointer;

    transition: all 0.3s ease;
}


.contact-submit:hover {
    background: #b80710;

    border-color: #b80710;

    transform: translateY(-3px);

    box-shadow:
        0 12px 30px rgba(229,9,20,0.25);
}


/* =========================================================
   ALERTS
========================================================= */

.contact-alert {
    padding: 15px 18px;

    margin-bottom: 25px;

    font-size: 13px;
}


.contact-alert-success {
    background:
        rgba(40,167,69,0.08);

    border:
        1px solid rgba(40,167,69,0.3);

    color: #70d889;
}


.contact-alert-error {
    background:
        rgba(229,9,20,0.08);

    border:
        1px solid rgba(229,9,20,0.3);

    color: #ff6872;
}


/* =========================================================
   HORAIRES
========================================================= */

.hours-section {
    background: #080808;
}


.hours-container {
    display: grid;

    grid-template-columns:
        1fr 1fr;

    gap: 25px;
}


.hours-box {
    padding: 35px;

    background: #0e0e0e;

    border:
        1px solid rgba(255,255,255,0.07);
}


.hours-box h3 {
    margin-bottom: 25px;

    font-size: 18px;
}


.hours-row {
    display: flex;

    justify-content: space-between;

    gap: 20px;

    padding: 15px 0;

    border-bottom:
        1px solid rgba(255,255,255,0.07);

    color: #777;

    font-size: 13px;
}


.hours-row:last-child {
    border-bottom: none;
}


.hours-row strong {
    color: #ccc;
}


.hours-closed {
    color: #e50914 !important;
}


/* =========================================================
   LOCALISATION
========================================================= */

.location-section {
    background: #050505;
}


.location-layout {
    display: grid;

    grid-template-columns:
        0.8fr 1.2fr;

    gap: 25px;
}


.location-info {
    padding: 40px;

    background: #0e0e0e;

    border:
        1px solid rgba(255,255,255,0.07);
}


.location-info h3 {
    margin-bottom: 18px;

    font-size: 25px;
}


.location-info p {
    color: #777;

    font-size: 13px;

    line-height: 1.9;

    margin-bottom: 30px;
}


.location-button {
    display: inline-block;

    padding: 14px 25px;

    background: transparent;

    border:
        1px solid rgba(255,255,255,0.2);

    color: #ffffff;

    text-decoration: none;

    font-size: 11px;

    font-weight: 700;

    letter-spacing: 1px;

    transition: 0.3s;
}


.location-button:hover {
    background: #e50914;

    border-color: #e50914;
}


/* =========================================================
   GOOGLE MAPS
========================================================= */

.location-map {
    min-height: 350px;

    position: relative;

    overflow: hidden;

    background: #111111;

    border:
        1px solid rgba(255,255,255,0.08);
}


.location-map iframe {
    width: 100%;

    height: 100%;

    min-height: 350px;

    display: block;

    border: 0;
}


/* =========================================================
   CTA
========================================================= */

.contact-cta {
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
            rgba(0,0,0,0.82),
            rgba(0,0,0,0.92)
        ),
        url('https://images.unsplash.com/photo-1542282088-72c9c27ed0cd?auto=format&fit=crop&w=1800&q=85');

    background-size: cover;

    background-position: center;
}


.contact-cta-content {
    position: relative;

    z-index: 2;

    padding: 50px 20px;
}


.contact-cta-content h2 {
    margin-bottom: 15px;

    font-size: clamp(30px,5vw,55px);
}


.contact-cta-content h2 span {
    color: #e50914;
}


.contact-cta-content p {
    margin-bottom: 30px;

    color: #aaa;

    font-size: 14px;
}


.contact-cta-button {
    display: inline-block;

    padding: 15px 35px;

    background: #e50914;

    border: 1px solid #e50914;

    color: #ffffff;

    text-decoration: none;

    font-size: 12px;

    font-weight: 700;

    letter-spacing: 1px;

    transition: 0.3s;
}


.contact-cta-button:hover {
    background: #ffffff;

    border-color: #ffffff;

    color: #000000;

    transform: translateY(-3px);
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1000px) {

    .contact-info-grid {
        grid-template-columns:
            repeat(2, 1fr);
    }


    .contact-form-layout {
        grid-template-columns: 1fr;
    }


    .hours-container {
        grid-template-columns: 1fr;
    }


    .location-layout {
        grid-template-columns: 1fr;
    }

}


@media (max-width: 650px) {

    .contact-hero {
        min-height: 50vh;

        background-position:
            60% center;
    }


    .contact-hero-content {
        padding:
            130px 6% 90px;
    }


    .contact-hero-title {
        letter-spacing: -2px;
    }


    .contact-hero-description {
        font-size: 14px;
    }


    .contact-section {
        padding:
            70px 5%;
    }


    .contact-info-grid {
        grid-template-columns:
            1fr;
    }


    .contact-form-box {
        padding:
            25px 20px;
    }


    .contact-form-grid {
        grid-template-columns:
            1fr;
    }


    .contact-form-group.full {
        grid-column: auto;
    }


    .contact-submit {
        width: 100%;
    }


    .hours-box {
        padding:
            25px 20px;
    }


    .hours-row {
        flex-direction: column;

        gap: 5px;
    }


    .location-info {
        padding:
            30px 25px;
    }


    .location-map {
        min-height: 280px;
    }


    .location-map iframe {
        min-height: 280px;
    }


    .contact-cta {
        margin:
            0 5% 70px;
    }

}

</style>


<div class="luxora-contact-page">


{{-- =====================================================
     HERO
====================================================== --}}

<section class="contact-hero">

    <div class="contact-hero-content">

        <div class="contact-small-title">
            LUXORA MOTORS
        </div>


        <h1 class="contact-hero-title">

            PARLONS<br>

            <span>AUTOMOBILE.</span>

        </h1>


        <p class="contact-hero-description">

            Une question, un projet ou simplement envie d'en savoir
            plus sur nos véhicules ? Notre équipe est à votre
            disposition pour vous accompagner.

        </p>

    </div>

</section>



{{-- =====================================================
     INFORMATIONS
====================================================== --}}

<section class="contact-section contact-info-section">

    <div class="contact-section-heading">

        <div class="contact-section-label">
            Nous trouver
        </div>


        <h2 class="contact-section-title">
            Nos coordonnées
        </h2>

    </div>


    <div class="contact-info-grid">


        {{-- ADRESSE --}}

        <div class="contact-info-card">

            <div class="contact-info-icon">
                📍
            </div>


            <h3>
                Adresse
            </h3>


            <p>

                LUXORA MOTORS<br>

                Fianarantsoa<br>

                Madagascar

            </p>

        </div>



        {{-- TELEPHONE --}}

        <div class="contact-info-card">

            <div class="contact-info-icon">
                📞
            </div>


            <h3>
                Téléphone
            </h3>


            <p>

                <a href="tel:+261340000000">
                    +261 34 00 000 00
                </a>

                <br>

                <a href="tel:+261320000000">
                    +261 32 00 000 00
                </a>

            </p>

        </div>



        {{-- EMAIL --}}

        <div class="contact-info-card">

            <div class="contact-info-icon">
                ✉
            </div>


            <h3>
                Email
            </h3>


            <p>

                <a href="mailto:contact@luxoramotors.com">
                    contact@luxoramotors.com
                </a>

                <br>

                <a href="mailto:commercial@luxoramotors.com">
                    commercial@luxoramotors.com
                </a>

            </p>

        </div>



        {{-- HORAIRES --}}

        <div class="contact-info-card">

            <div class="contact-info-icon">
                ◷
            </div>


            <h3>
                Horaires
            </h3>


            <p>

                Lundi - Vendredi<br>

                <strong style="color:#ccc;">
                    08:00 — 17:00
                </strong>

                <br><br>

                Samedi<br>

                <strong style="color:#ccc;">
                    09:00 — 13:00
                </strong>

            </p>

        </div>


    </div>

</section>



{{-- =====================================================
     FORMULAIRE
====================================================== --}}

<section class="contact-section contact-form-section">

    <div class="contact-form-layout">


        {{-- PRESENTATION --}}

        <div class="contact-form-intro">

            <div class="contact-section-label">
                Contact
            </div>


            <h3>

                Une demande ?

                <span>
                    Nous sommes à votre écoute.
                </span>

            </h3>


            <p>

                Que vous recherchiez un véhicule particulier,
                souhaitiez organiser un essai ou simplement obtenir
                plus d'informations, envoyez-nous votre demande.
                Notre équipe vous répondra dans les meilleurs délais.

            </p>


            <div class="contact-direct">


                {{-- APPEL --}}

                <a
                    href="tel:+261340000000"
                    class="contact-direct-item"
                >

                    <div class="contact-direct-icon">
                        📞
                    </div>


                    <div>

                        <strong>
                            Appeler LUXORA
                        </strong>

                        <br>

                        +261 34 00 000 00

                    </div>

                </a>



                {{-- WHATSAPP --}}

                <a
                    href="https://wa.me/261340000000"
                    target="_blank"
                    class="contact-direct-item"
                >

                    <div class="contact-direct-icon">
                        💬
                    </div>


                    <div>

                        <strong>
                            WhatsApp
                        </strong>

                        <br>

                        Nous contacter directement

                    </div>

                </a>


            </div>

        </div>



        {{-- FORMULAIRE --}}

        <div class="contact-form-box">


            @if(session('success'))

                <div class="contact-alert contact-alert-success">

                    {{ session('success') }}

                </div>

            @endif


            @if(session('error'))

                <div class="contact-alert contact-alert-error">

                    {{ session('error') }}

                </div>

            @endif


            @if($errors->any())

                <div class="contact-alert contact-alert-error">

                    Veuillez vérifier les informations saisies.

                </div>

            @endif



            <form
                action="{{ route('client.contact') }}"
                method="POST"
            >

                @csrf


                <div class="contact-form-grid">


                    {{-- NOM --}}

                    <div class="contact-form-group">

                        <label for="name">

                            Nom complet

                            <span>*</span>

                        </label>


                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="contact-input"
                            placeholder="Votre nom"
                            value="{{ old('name') }}"
                            required
                        >


                        @error('name')

                            <div class="contact-error">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>



                    {{-- EMAIL --}}

                    <div class="contact-form-group">

                        <label for="email">

                            Email

                            <span>*</span>

                        </label>


                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="contact-input"
                            placeholder="votre@email.com"
                            value="{{ old('email') }}"
                            required
                        >


                        @error('email')

                            <div class="contact-error">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>



                    {{-- TELEPHONE --}}

                    <div class="contact-form-group">

                        <label for="phone">
                            Téléphone
                        </label>


                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            class="contact-input"
                            placeholder="+261 XX XX XXX XX"
                            value="{{ old('phone') }}"
                        >


                        @error('phone')

                            <div class="contact-error">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>



                    {{-- SUJET --}}

                    <div class="contact-form-group">

                        <label for="subject">

                            Sujet

                            <span>*</span>

                        </label>


                        <select
                            id="subject"
                            name="subject"
                            class="contact-input"
                            required
                        >

                            <option value="">

                                Sélectionner un sujet

                            </option>


                            <option
                                value="achat"
                                {{ old('subject') === 'achat' ? 'selected' : '' }}
                            >

                                Achat d'un véhicule

                            </option>


                            <option
                                value="information"
                                {{ old('subject') === 'information' ? 'selected' : '' }}
                            >

                                Demande d'information

                            </option>


                            <option
                                value="essai"
                                {{ old('subject') === 'essai' ? 'selected' : '' }}
                            >

                                Demande d'essai

                            </option>


                            <option
                                value="rendez-vous"
                                {{ old('subject') === 'rendez-vous' ? 'selected' : '' }}
                            >

                                Rendez-vous

                            </option>


                            <option
                                value="autre"
                                {{ old('subject') === 'autre' ? 'selected' : '' }}
                            >

                                Autre

                            </option>

                        </select>


                        @error('subject')

                            <div class="contact-error">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>



                    {{-- MESSAGE --}}

                    <div class="contact-form-group full">

                        <label for="message">

                            Message

                            <span>*</span>

                        </label>


                        <textarea
                            id="message"
                            name="message"
                            class="contact-input"
                            placeholder="Écrivez votre message..."
                            required
                        >{{ old('message') }}</textarea>


                        @error('message')

                            <div class="contact-error">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>


                </div>



                <div class="contact-submit-wrapper">

                    <button
                        type="submit"
                        class="contact-submit"
                    >

                        ENVOYER LE MESSAGE

                        <span>
                            →
                        </span>

                    </button>

                </div>


            </form>

        </div>

    </div>

</section>



{{-- =====================================================
     HORAIRES
====================================================== --}}

<section class="contact-section hours-section">

    <div class="contact-section-heading">

        <div class="contact-section-label">
            Disponibilité
        </div>


        <h2 class="contact-section-title">
            Quand nous trouver ?
        </h2>

    </div>


    <div class="hours-container">


        {{-- SHOWROOM --}}

        <div class="hours-box">

            <h3>
                Horaires du showroom
            </h3>


            <div class="hours-row">

                <strong>
                    Lundi
                </strong>

                <span>
                    08:00 — 17:00
                </span>

            </div>


            <div class="hours-row">

                <strong>
                    Mardi
                </strong>

                <span>
                    08:00 — 17:00
                </span>

            </div>


            <div class="hours-row">

                <strong>
                    Mercredi
                </strong>

                <span>
                    08:00 — 17:00
                </span>

            </div>


            <div class="hours-row">

                <strong>
                    Jeudi
                </strong>

                <span>
                    08:00 — 17:00
                </span>

            </div>


            <div class="hours-row">

                <strong>
                    Vendredi
                </strong>

                <span>
                    08:00 — 17:00
                </span>

            </div>


            <div class="hours-row">

                <strong>
                    Samedi
                </strong>

                <span>
                    09:00 — 13:00
                </span>

            </div>


            <div class="hours-row">

                <strong>
                    Dimanche
                </strong>

                <span class="hours-closed">
                    Fermé
                </span>

            </div>

        </div>



        {{-- SERVICE CLIENT --}}

        <div class="hours-box">

            <h3>
                Service client
            </h3>


            <p
                style="
                    color:#777;
                    font-size:13px;
                    line-height:1.9;
                    margin-bottom:25px;
                "
            >

                Notre équipe commerciale est disponible pour
                répondre à vos questions concernant nos véhicules,
                les essais, les rendez-vous et les démarches
                liées à votre achat.

            </p>


            <a
                href="tel:+261340000000"
                class="location-button"
            >

                APPELER L'ÉQUIPE →

            </a>

        </div>


    </div>

</section>



{{-- =====================================================
     LOCALISATION
====================================================== --}}

<section class="contact-section location-section">

    <div class="contact-section-heading">

        <div class="contact-section-label">
            Localisation
        </div>


        <h2 class="contact-section-title">
            Retrouvez-nous
        </h2>

    </div>


    <div class="location-layout">


        {{-- INFORMATIONS LOCALISATION --}}

        <div class="location-info">

            <h3>
                LUXORA MOTORS
            </h3>


            <p>

                Notre showroom vous accueille pour découvrir
                notre sélection de véhicules et échanger avec
                notre équipe.

                <br><br>

                📍 Fianarantsoa, Madagascar

            </p>


            <a
                href="https://www.google.com/maps/search/?api=1&query=Fianarantsoa%2C%20Madagascar"
                target="_blank"
                class="location-button"
            >

                OUVRIR GOOGLE MAPS →

            </a>

        </div>



        {{-- GOOGLE MAPS --}}

        <div class="location-map">

            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d53768.86026491958!2d47.044571679883056!3d-21.44760141940394!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x21e7bec0717f0aab%3A0xbab89234313f05ed!2sFianarantsoa!5e1!3m2!1sfr!2smg!4v1788806388370!5m2!1sfr!2smg"
                width="600"
                height="450"
                style="border:0;"
                allowfullscreen
                loading="lazy"
                referrerpolicy="strict-origin-when-cross-origin">
            </iframe>

        </div>


    </div>

</section>



{{-- =====================================================
     CTA
====================================================== --}}

<section class="contact-cta">

    <div class="contact-cta-content">

        <div class="contact-section-label">
            LUXORA MOTORS
        </div>


        <h2>

            PRÊT À TROUVER<br>

            <span>
                VOTRE PROCHAINE VOITURE ?
            </span>

        </h2>


        <p>
            Découvrez notre sélection de véhicules.
        </p>


        <a
            href="{{ route('client.vehicules') }}"
            class="contact-cta-button"
        >

            EXPLORER LES VÉHICULES →

        </a>

    </div>

</section>


</div>

@endsection
```
