@extends('layouts.client')

@section('title', 'Finaliser mon achat — LUXORA MOTORS')

@section('content')

<style>
    .checkout-page {
        min-height: 100vh;
        background: #080808;
        color: #fff;
        padding: 140px 30px 90px;
    }

    .checkout-container {
        max-width: 1250px;
        margin: 0 auto;
    }

    /* HEADER */

    .checkout-header {
        margin-bottom: 45px;
    }

    .checkout-eyebrow {
        color: #e50914;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .checkout-header h1 {
        margin: 0;
        font-size: clamp(38px, 5vw, 62px);
        font-weight: 900;
        letter-spacing: -3px;
    }

    .checkout-header p {
        color: #888;
        font-size: 14px;
        margin-top: 14px;
    }

    /* GRID */

    .checkout-grid {
        display: grid;
        grid-template-columns: 1.5fr .8fr;
        gap: 35px;
        align-items: start;
    }

    /* FORM */

    .checkout-card {
        background: #111;
        border: 1px solid #252525;
        padding: 35px;
    }

    .checkout-card-title {
        margin: 0 0 8px;
        font-size: 24px;
        font-weight: 900;
    }

    .checkout-card-subtitle {
        margin: 0 0 30px;
        color: #777;
        font-size: 13px;
    }

    .form-section {
        margin-bottom: 35px;
    }

    .form-section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 22px;
        padding-bottom: 12px;
        border-bottom: 1px solid #252525;
    }

    .form-section-number {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e50914;
        color: #fff;
        font-size: 12px;
        font-weight: 900;
    }

    .form-section-title h3 {
        margin: 0;
        font-size: 15px;
        font-weight: 800;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #bbb;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        box-sizing: border-box;
        padding: 14px 15px;
        background: #181818;
        border: 1px solid #303030;
        color: #fff;
        border-radius: 0;
        outline: none;
        font-family: inherit;
        font-size: 13px;
        transition: .25s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        border-color: #e50914;
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: #555;
    }

    .form-group textarea {
        min-height: 100px;
        resize: vertical;
    }

    .form-group select option {
        background: #181818;
        color: #fff;
    }

    .error-message {
        color: #ff4d4d;
        font-size: 11px;
        margin-top: 7px;
    }

    /* PAYMENT */

    .payment-options {
        display: grid;
        gap: 12px;
    }

    .payment-option {
        position: relative;
    }

    .payment-option input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .payment-label {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 17px;
        background: #181818;
        border: 1px solid #303030;
        cursor: pointer;
        transition: .25s ease;
    }

    .payment-label:hover {
        border-color: #555;
    }

    .payment-option input:checked + .payment-label {
        border-color: #e50914;
        background: rgba(229, 9, 20, .07);
    }

    .payment-radio {
        width: 18px;
        height: 18px;
        border: 1px solid #555;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .payment-option input:checked + .payment-label .payment-radio {
        border: 5px solid #e50914;
    }

    .payment-content {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .payment-name {
        font-size: 13px;
        font-weight: 800;
    }

    .payment-description {
        color: #666;
        font-size: 11px;
    }

    /* BUTTON */

    .checkout-button {
        width: 100%;
        min-height: 58px;
        margin-top: 10px;
        border: none;
        background: #e50914;
        color: #fff;
        font-size: 12px;
        font-weight: 900;
        letter-spacing: 2px;
        text-transform: uppercase;
        cursor: pointer;
        transition: .3s ease;
    }

    .checkout-button:hover {
        background: #bd0711;
        transform: translateY(-2px);
    }

    /* SUMMARY */

    .summary-card {
        position: sticky;
        top: 100px;
        background: #111;
        border: 1px solid #252525;
    }

    .summary-image {
        width: 100%;
        height: 260px;
        object-fit: cover;
        display: block;
    }

    .summary-content {
        padding: 28px;
    }

    .summary-brand {
        color: #e50914;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    .summary-title {
        margin: 0;
        font-size: 25px;
        font-weight: 900;
    }

    .summary-divider {
        height: 1px;
        background: #292929;
        margin: 25px 0;
    }

    .summary-line {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 14px;
        color: #888;
        font-size: 12px;
    }

    .summary-line strong {
        color: #fff;
        font-weight: 700;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .summary-total span:first-child {
        color: #aaa;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .summary-price {
        color: #fff;
        font-size: 25px;
        font-weight: 900;
    }

    .security-info {
        margin-top: 25px;
        padding: 15px;
        background: #181818;
        color: #777;
        font-size: 11px;
        line-height: 1.6;
    }

    .security-info strong {
        color: #aaa;
    }

    .back-link {
        display: inline-flex;
        margin-top: 20px;
        color: #777;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: .25s ease;
    }

    .back-link:hover {
        color: #fff;
    }

    @media (max-width: 900px) {
        .checkout-grid {
            grid-template-columns: 1fr;
        }

        .summary-card {
            position: static;
            order: -1;
        }
    }

    @media (max-width: 600px) {
        .checkout-page {
            padding: 110px 20px 60px;
        }

        .checkout-card {
            padding: 22px;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .form-group.full {
            grid-column: auto;
        }

        .summary-image {
            height: 220px;
        }
    }
</style>


<div class="checkout-page">

    <div class="checkout-container">

        {{-- HEADER --}}
        <div class="checkout-header">

            <div class="checkout-eyebrow">
                LUXORA MOTORS · ACHAT EN LIGNE
            </div>

            <h1>
                Finaliser votre achat
            </h1>

            <p>
                Vérifiez vos informations puis choisissez votre mode de paiement.
            </p>

        </div>


        <div class="checkout-grid">

            {{-- =========================
                 FORMULAIRE
            ========================== --}}

            <div class="checkout-card">

                <h2 class="checkout-card-title">
                    Informations de commande
                </h2>

                <p class="checkout-card-subtitle">
                    Ces informations seront utilisées pour traiter votre achat.
                </p>


                <form
                    action="{{ route('client.achat.process', $vehicule) }}"
                    method="POST"
                >

                    @csrf


                    {{-- =========================
                         INFORMATIONS CLIENT
                    ========================== --}}

                    <div class="form-section">

                        <div class="form-section-title">

                            <span class="form-section-number">
                                01
                            </span>

                            <h3>
                                Vos informations
                            </h3>

                        </div>


                        <div class="form-row">

                            <div class="form-group">

                                <label for="nom">
                                    Nom
                                </label>

                                <input
                                    type="text"
                                    id="nom"
                                    name="nom"
                                    value="{{ old('nom', auth()->user()->nom ?? '') }}"
                                    placeholder="Votre nom"
                                    required
                                >

                                @error('nom')
                                    <div class="error-message">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            <div class="form-group">

                                <label for="prenom">
                                    Prénom
                                </label>

                                <input
                                    type="text"
                                    id="prenom"
                                    name="prenom"
                                    value="{{ old('prenom', auth()->user()->prenom ?? '') }}"
                                    placeholder="Votre prénom"
                                    required
                                >

                                @error('prenom')
                                    <div class="error-message">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            <div class="form-group">

                                <label for="email">
                                    Adresse email
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', auth()->user()->email ?? '') }}"
                                    placeholder="exemple@email.com"
                                    required
                                >

                                @error('email')
                                    <div class="error-message">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            <div class="form-group">

                                <label for="telephone">
                                    Téléphone
                                </label>

                                <input
                                    type="text"
                                    id="telephone"
                                    name="telephone"
                                    value="{{ old('telephone') }}"
                                    placeholder="+261 XX XX XXX XX"
                                    required
                                >

                                @error('telephone')
                                    <div class="error-message">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            <div class="form-group full">

                                <label for="adresse">
                                    Adresse
                                </label>

                                <textarea
                                    id="adresse"
                                    name="adresse"
                                    placeholder="Votre adresse complète"
                                    required
                                >{{ old('adresse') }}</textarea>

                                @error('adresse')
                                    <div class="error-message">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- =========================
                         PAIEMENT
                    ========================== --}}

                    <div class="form-section">

                        <div class="form-section-title">

                            <span class="form-section-number">
                                02
                            </span>

                            <h3>
                                Mode de paiement
                            </h3>

                        </div>


                        <div class="payment-options">

                            {{-- CARTE --}}

                            <div class="payment-option">

                                <input
                                    type="radio"
                                    id="carte"
                                    name="mode_paiement"
                                    value="carte"
                                    {{ old('mode_paiement') === 'carte' ? 'checked' : '' }}
                                    required
                                >

                                <label
                                    for="carte"
                                    class="payment-label"
                                >

                                    <span class="payment-radio"></span>

                                    <span class="payment-content">

                                        <span class="payment-name">
                                            Carte bancaire
                                        </span>

                                        <span class="payment-description">
                                            Paiement sécurisé par carte
                                        </span>

                                    </span>

                                </label>

                            </div>


                            {{-- MOBILE MONEY --}}

                            <div class="payment-option">

                                <input
                                    type="radio"
                                    id="mobile_money"
                                    name="mode_paiement"
                                    value="mobile_money"
                                    {{ old('mode_paiement') === 'mobile_money' ? 'checked' : '' }}
                                >

                                <label
                                    for="mobile_money"
                                    class="payment-label"
                                >

                                    <span class="payment-radio"></span>

                                    <span class="payment-content">

                                        <span class="payment-name">
                                            Mobile Money
                                        </span>

                                        <span class="payment-description">
                                            Paiement via Mobile Money
                                        </span>

                                    </span>

                                </label>

                            </div>


                            {{-- LIVRAISON --}}

                            <div class="payment-option">

                                <input
                                    type="radio"
                                    id="livraison"
                                    name="mode_paiement"
                                    value="livraison"
                                    {{ old('mode_paiement') === 'livraison' ? 'checked' : '' }}
                                >

                                <label
                                    for="livraison"
                                    class="payment-label"
                                >

                                    <span class="payment-radio"></span>

                                    <span class="payment-content">

                                        <span class="payment-name">
                                            Paiement à la livraison
                                        </span>

                                        <span class="payment-description">
                                            Régler le montant lors de la livraison
                                        </span>

                                    </span>

                                </label>

                            </div>

                        </div>

                        @error('mode_paiement')
                            <div class="error-message">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- BOUTON --}}

                    <button
                        type="submit"
                        class="checkout-button"
                    >
                        Continuer vers le paiement →
                    </button>

                </form>

            </div>


            {{-- =========================
                 RÉCAPITULATIF
            ========================== --}}

            <aside class="summary-card">

                @if($vehicule->image)

                    <img
                        src="{{ asset('storage/' . $vehicule->image) }}"
                        alt="{{ $vehicule->marque->nom ?? '' }} {{ $vehicule->modele }}"
                        class="summary-image"
                    >

                @else

                    <div
                        class="summary-image"
                        style="
                            background:#181818;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            color:#555;
                        "
                    >
                        Aucune image
                    </div>

                @endif


                <div class="summary-content">

                    <div class="summary-brand">
                        {{ $vehicule->marque->nom ?? 'LUXORA MOTORS' }}
                    </div>

                    <h2 class="summary-title">
                        {{ $vehicule->modele }}
                    </h2>


                    <div class="summary-divider"></div>


                    <div class="summary-line">

                        <span>
                            Année
                        </span>

                        <strong>
                            {{ $vehicule->annee }}
                        </strong>

                    </div>


                    <div class="summary-line">

                        <span>
                            Kilométrage
                        </span>

                        <strong>
                            {{ number_format($vehicule->kilometrage, 0, ',', ' ') }} km
                        </strong>

                    </div>


                    <div class="summary-line">

                        <span>
                            Carburant
                        </span>

                        <strong>
                            {{ $vehicule->carburant }}
                        </strong>

                    </div>


                    <div class="summary-line">

                        <span>
                            Boîte
                        </span>

                        <strong>
                            {{ $vehicule->boite_vitesse }}
                        </strong>

                    </div>


                    <div class="summary-divider"></div>


                    <div class="summary-total">

                        <span>
                            Total
                        </span>

                        <span class="summary-price">
                            {{ number_format($vehicule->prix, 0, ',', ' ') }} Ar
                        </span>

                    </div>


                    <div class="security-info">
                        <strong>🔒 Achat sécurisé</strong><br>
                        Vos informations sont utilisées uniquement
                        pour le traitement de votre commande.
                    </div>


                    <a
                        href="{{ url()->previous() }}"
                        class="back-link"
                    >
                        ← Retour au véhicule
                    </a>

                </div>

            </aside>

        </div>

    </div>

</div>

@endsection