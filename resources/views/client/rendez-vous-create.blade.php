@extends('layouts.client')

@section('title', 'Prendre rendez-vous — LUXORA MOTORS')

@section('content')

<style>
    .rdv-page {
        min-height: 100vh;
        background: #080808;
        color: #fff;
        padding: 150px 25px 90px;
    }

    .rdv-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    .rdv-header {
        margin-bottom: 45px;
    }

    .rdv-label {
        color: #e50914;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: 4px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .rdv-title {
        margin: 0 0 15px;
        font-size: clamp(38px, 5vw, 65px);
        font-weight: 900;
        letter-spacing: -3px;
    }

    .rdv-subtitle {
        max-width: 650px;
        color: #888;
        font-size: 14px;
        line-height: 1.8;
    }

    .rdv-layout {
        display: grid;
        grid-template-columns: 380px 1fr;
        gap: 35px;
        align-items: start;
    }

    /* =========================
       VEHICULE
    ========================= */

    .vehicle-card {
        background: #111;
        border: 1px solid #282828;
        overflow: hidden;
    }

    .vehicle-image {
        height: 240px;
        background: #151515;
        overflow: hidden;
    }

    .vehicle-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .vehicle-info {
        padding: 25px;
    }

    .vehicle-brand {
        color: #e50914;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    .vehicle-name {
        margin: 0 0 18px;
        font-size: 25px;
        font-weight: 900;
    }

    .vehicle-price {
        padding-top: 18px;
        border-top: 1px solid #282828;
        font-size: 20px;
        font-weight: 900;
    }

    /* =========================
       FORM
    ========================= */

    .form-card {
        background: #111;
        border: 1px solid #282828;
        padding: 35px;
    }

    .form-title {
        margin: 0 0 8px;
        font-size: 25px;
        font-weight: 900;
    }

    .form-description {
        margin: 0 0 30px;
        color: #777;
        font-size: 13px;
        line-height: 1.7;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        color: #aaa;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .form-control {
        width: 100%;
        height: 50px;
        padding: 0 15px;
        background: #080808;
        border: 1px solid #303030;
        color: #fff;
        outline: none;
        font-family: inherit;
        transition: .3s ease;
        box-sizing: border-box;
    }

    textarea.form-control {
        height: 130px;
        padding: 15px;
        resize: vertical;
    }

    .form-control:focus {
        border-color: #e50914;
    }

    .form-control::-webkit-calendar-picker-indicator {
        filter: invert(1);
        cursor: pointer;
    }

    .error-message {
        margin-top: 7px;
        color: #e50914;
        font-size: 11px;
    }

    .submit-button {
        width: 100%;
        height: 54px;
        border: none;
        background: #e50914;
        color: #fff;
        font-family: inherit;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: 1.5px;
        cursor: pointer;
        transition: .3s ease;
    }

    .submit-button:hover {
        background: #bd0711;
        transform: translateY(-2px);
    }

    .back-link {
        display: inline-flex;
        margin-top: 20px;
        color: #777;
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

    /* =========================
       ALERT
    ========================= */

    .alert-success {
        margin-bottom: 25px;
        padding: 15px 18px;
        background: rgba(229, 9, 20, .08);
        border: 1px solid rgba(229, 9, 20, .35);
        color: #fff;
        font-size: 13px;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 850px) {
        .rdv-layout {
            grid-template-columns: 1fr;
        }

        .vehicle-card {
            max-width: 600px;
        }
    }

    @media (max-width: 600px) {
        .rdv-page {
            padding: 125px 18px 60px;
        }

        .form-card {
            padding: 25px;
        }

        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="rdv-page">

    <div class="rdv-container">

        {{-- HEADER --}}

        <div class="rdv-header">

            <div class="rdv-label">
                LUXORA MOTORS
            </div>

            <h1 class="rdv-title">
                PRENDRE <span style="color:#e50914;">RENDEZ-VOUS</span>
            </h1>

            <p class="rdv-subtitle">
                Vous souhaitez découvrir ce véhicule ?
                Choisissez votre date et votre heure afin
                d'organiser votre visite avec notre équipe.
            </p>

        </div>


        {{-- MESSAGE SUCCESS --}}

        @if(session('success'))

            <div class="alert-success">
                {{ session('success') }}
            </div>

        @endif


        <div class="rdv-layout">

            {{-- =========================
                 VEHICULE
            ========================== --}}

            <div class="vehicle-card">

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

                </div>

                <div class="vehicle-info">

                    <div class="vehicle-brand">
                        {{ $vehicule->marque->nom ?? 'LUXORA' }}
                    </div>

                    <h2 class="vehicle-name">
                        {{ $vehicule->modele }}
                    </h2>

                    <div class="vehicle-price">
                        {{ number_format($vehicule->prix, 0, ',', ' ') }} Ar
                    </div>

                </div>

            </div>


            {{-- =========================
                 FORMULAIRE
            ========================== --}}

            <div class="form-card">

                <h2 class="form-title">
                    Votre demande
                </h2>

                <p class="form-description">
                    Remplissez les informations ci-dessous.
                    Votre demande sera enregistrée avec le statut
                    <strong>En attente</strong>.
                </p>


                <form
                    action="{{ route('client.rendez-vous.store', $vehicule) }}"
                    method="POST"
                >

                    @csrf


                    {{-- DATE + HEURE --}}

                    <div class="form-row">

                        <div class="form-group">

                            <label
                                for="date_rendez_vous"
                                class="form-label"
                            >
                                Date du rendez-vous
                            </label>

                            <input
                                type="date"
                                name="date_rendez_vous"
                                id="date_rendez_vous"
                                class="form-control"
                                value="{{ old('date_rendez_vous') }}"
                                min="{{ date('Y-m-d') }}"
                                required
                            >

                            @error('date_rendez_vous')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="form-group">

                            <label
                                for="heure"
                                class="form-label"
                            >
                                Heure
                            </label>

                            <input
                                type="time"
                                name="heure"
                                id="heure"
                                class="form-control"
                                value="{{ old('heure') }}"
                                required
                            >

                            @error('heure')
                                <div class="error-message">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- MESSAGE --}}

                    <div class="form-group">

                        <label
                            for="message"
                            class="form-label"
                        >
                            Message
                        </label>

                        <textarea
                            name="message"
                            id="message"
                            class="form-control"
                            placeholder="Précisez votre demande ou vos questions..."
                        >{{ old('message') }}</textarea>

                        @error('message')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- BOUTON --}}

                    <button
                        type="submit"
                        class="submit-button"
                    >
                        ENVOYER MA DEMANDE →
                    </button>

                </form>


                <a
                    href="{{ route('client.vehicule.show', $vehicule) }}"
                    class="back-link"
                >
                    ← Retour au véhicule
                </a>

            </div>

        </div>

    </div>

</div>

@endsection

