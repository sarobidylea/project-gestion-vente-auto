@extends('layouts.client')

@section('title', 'Paiement — LUXORA MOTORS')

@section('content')

<style>
    .payment-page {
        min-height: 100vh;
        background: #080808;
        color: #fff;
        padding: 140px 30px 90px;
    }

    .payment-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    .payment-header {
        margin-bottom: 45px;
    }

    .payment-eyebrow {
        color: #e50914;
        font-size: 11px;
        font-weight: 900;
        letter-spacing: 3px;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    .payment-header h1 {
        margin: 0;
        font-size: clamp(38px, 5vw, 60px);
        font-weight: 900;
        letter-spacing: -3px;
    }

    .payment-header p {
        color: #888;
        font-size: 14px;
        margin-top: 14px;
    }

    .payment-grid {
        display: grid;
        grid-template-columns: 1fr .75fr;
        gap: 30px;
        align-items: start;
    }

    .payment-card,
    .order-card {
        background: #111;
        border: 1px solid #252525;
    }

    .payment-card {
        padding: 35px;
    }

    .payment-card h2 {
        margin: 0 0 8px;
        font-size: 24px;
        font-weight: 900;
    }

    .payment-subtitle {
        color: #777;
        font-size: 13px;
        margin-bottom: 30px;
    }

    .payment-method {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 18px;
        margin-bottom: 25px;
        background: #181818;
        border: 1px solid #303030;
    }

    .method-icon {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e50914;
        color: #fff;
        font-size: 18px;
        font-weight: 900;
    }

    .method-content strong {
        display: block;
        font-size: 14px;
        margin-bottom: 4px;
    }

    .method-content span {
        color: #777;
        font-size: 11px;
    }

    .payment-info {
        background: #181818;
        border-left: 3px solid #e50914;
        padding: 17px;
        margin-bottom: 25px;
    }

    .payment-info p {
        margin: 0;
        color: #aaa;
        font-size: 12px;
        line-height: 1.7;
    }

    .form-group {
        margin-bottom: 18px;
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

    .form-group input {
        width: 100%;
        box-sizing: border-box;
        padding: 14px 15px;
        background: #181818;
        border: 1px solid #303030;
        color: #fff;
        outline: none;
        font-family: inherit;
        font-size: 13px;
    }

    .form-group input:focus {
        border-color: #e50914;
    }

    .form-group input::placeholder {
        color: #555;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .payment-button {
        width: 100%;
        min-height: 58px;
        margin-top: 12px;
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

    .payment-button:hover {
        background: #bd0711;
        transform: translateY(-2px);
    }

    .cancel-link {
        display: block;
        margin-top: 20px;
        color: #666;
        text-align: center;
        text-decoration: none;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .cancel-link:hover {
        color: #fff;
    }

    /* ORDER */

    .order-card {
        position: sticky;
        top: 100px;
    }

    .order-image {
        width: 100%;
        height: 230px;
        object-fit: cover;
        display: block;
    }

    .order-content {
        padding: 28px;
    }

    .order-brand {
        color: #e50914;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 7px;
    }

    .order-title {
        margin: 0;
        font-size: 25px;
        font-weight: 900;
    }

    .order-divider {
        height: 1px;
        background: #292929;
        margin: 24px 0;
    }

    .order-line {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 14px;
        color: #888;
        font-size: 12px;
    }

    .order-line strong {
        color: #fff;
    }

    .order-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .order-total-label {
        color: #aaa;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .order-price {
        font-size: 24px;
        font-weight: 900;
    }

    .secure-payment {
        margin-top: 25px;
        padding: 15px;
        background: #181818;
        color: #777;
        font-size: 11px;
        line-height: 1.6;
    }

    .secure-payment strong {
        color: #aaa;
    }

    @media (max-width: 850px) {
        .payment-grid {
            grid-template-columns: 1fr;
        }

        .order-card {
            position: static;
            order: -1;
        }
    }

    @media (max-width: 550px) {
        .payment-page {
            padding: 110px 20px 60px;
        }

        .payment-card {
            padding: 22px;
        }

        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="payment-page">

    <div class="payment-container">

        {{-- HEADER --}}
        <div class="payment-header">

            <div class="payment-eyebrow">
                LUXORA MOTORS · PAIEMENT
            </div>

            <h1>
                Finaliser le paiement
            </h1>

            <p>
                Vérifiez les informations avant de confirmer votre achat.
            </p>

        </div>


        <div class="payment-grid">

            {{-- =========================
                 PAIEMENT
            ========================== --}}

            <div class="payment-card">

                <h2>
                    Paiement sécurisé
                </h2>

                <p class="payment-subtitle">
                    Mode de paiement sélectionné :
                </p>


                <div class="payment-method">

                    <div class="method-icon">
                        @if($informations['mode_paiement'] === 'carte')
                            💳
                        @elseif($informations['mode_paiement'] === 'mobile_money')
                            📱
                        @else
                            🚗
                        @endif
                    </div>

                    <div class="method-content">

                        <strong>
                            @if($informations['mode_paiement'] === 'carte')
                                Carte bancaire
                            @elseif($informations['mode_paiement'] === 'mobile_money')
                                Mobile Money
                            @else
                                Paiement à la livraison
                            @endif
                        </strong>

                        <span>
                            @if($informations['mode_paiement'] === 'carte')
                                Paiement par carte bancaire
                            @elseif($informations['mode_paiement'] === 'mobile_money')
                                Paiement via Mobile Money
                            @else
                                Paiement lors de la livraison
                            @endif
                        </span>

                    </div>

                </div>


                {{-- CARTE BANCAIRE --}}

                @if($informations['mode_paiement'] === 'carte')

                    <div class="payment-info">

                        <p>
                            💳 Entrez les informations de votre carte.
                            Pour cette démonstration, aucun paiement bancaire
                            réel ne sera effectué.
                        </p>

                    </div>


                    <div class="form-group">

                        <label for="card_number">
                            Numéro de carte
                        </label>

                        <input
                            type="text"
                            id="card_number"
                            placeholder="0000 0000 0000 0000"
                            maxlength="19"
                        >

                    </div>


                    <div class="form-row">

                        <div class="form-group">

                            <label for="expiry">
                                Date d'expiration
                            </label>

                            <input
                                type="text"
                                id="expiry"
                                placeholder="MM/AA"
                                maxlength="5"
                            >

                        </div>


                        <div class="form-group">

                            <label for="cvv">
                                CVV
                            </label>

                            <input
                                type="password"
                                id="cvv"
                                placeholder="•••"
                                maxlength="4"
                            >

                        </div>

                    </div>

                @endif


                {{-- MOBILE MONEY --}}

                @if($informations['mode_paiement'] === 'mobile_money')

                    <div class="payment-info">

                        <p>
                            📱 Un numéro Mobile Money est nécessaire
                            pour effectuer la simulation du paiement.
                        </p>

                    </div>


                    <div class="form-group">

                        <label for="mobile_number">
                            Numéro Mobile Money
                        </label>

                        <input
                            type="text"
                            id="mobile_number"
                            placeholder="+261 XX XX XXX XX"
                        >

                    </div>

                @endif


                {{-- LIVRAISON --}}

                @if($informations['mode_paiement'] === 'livraison')

                    <div class="payment-info">

                        <p>
                            🚗 Vous avez choisi le paiement à la livraison.
                            Le paiement sera effectué lors de la remise
                            du véhicule.
                        </p>

                    </div>

                @endif


                {{-- FORMULAIRE CONFIRMATION --}}

                <form
                    action="{{ route('client.achat.confirm', $vehicule) }}"
                    method="POST"
                >

                    @csrf

                    <input
                        type="hidden"
                        name="mode_paiement"
                        value="{{ $informations['mode_paiement'] }}"
                    >

                    <button
                        type="submit"
                        class="payment-button"
                    >
                        Confirmer mon achat →
                    </button>

                </form>


                <a
                    href="{{ route('client.achat.checkout', $vehicule) }}"
                    class="cancel-link"
                >
                    ← Modifier mes informations
                </a>

            </div>


            {{-- =========================
                 RÉCAPITULATIF
            ========================== --}}

            <aside class="order-card">

                @if($vehicule->image)

                    <img
                        src="{{ asset('storage/' . $vehicule->image) }}"
                        alt="{{ $vehicule->marque->nom ?? '' }} {{ $vehicule->modele }}"
                        class="order-image"
                    >

                @else

                    <div
                        class="order-image"
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


                <div class="order-content">

                    <div class="order-brand">
                        {{ $vehicule->marque->nom ?? 'LUXORA MOTORS' }}
                    </div>

                    <h2 class="order-title">
                        {{ $vehicule->modele }}
                    </h2>


                    <div class="order-divider"></div>


                    <div class="order-line">

                        <span>
                            Client
                        </span>

                        <strong>
                            {{ $informations['prenom'] }}
                            {{ $informations['nom'] }}
                        </strong>

                    </div>


                    <div class="order-line">

                        <span>
                            Email
                        </span>

                        <strong>
                            {{ $informations['email'] }}
                        </strong>

                    </div>


                    <div class="order-line">

                        <span>
                            Téléphone
                        </span>

                        <strong>
                            {{ $informations['telephone'] }}
                        </strong>

                    </div>


                    <div class="order-divider"></div>


                    <div class="order-total">

                        <span class="order-total-label">
                            Total à payer
                        </span>

                        <span class="order-price">
                            {{ number_format($vehicule->prix, 0, ',', ' ') }} Ar
                        </span>

                    </div>


                    <div class="secure-payment">

                        <strong>
                            🔒 Transaction sécurisée
                        </strong>

                        <br>

                        Vos informations sont protégées et utilisées
                        uniquement pour le traitement de votre achat.

                    </div>

                </div>

            </aside>

        </div>

    </div>

</div>

@endsection