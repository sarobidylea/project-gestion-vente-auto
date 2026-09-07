```blade
@extends('layouts.client')

@section('title', 'Créer un compte | LUXORA MOTORS')

@section('content')

<style>
    .register-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 140px 20px 80px;

        background:
            linear-gradient(
                rgba(0, 0, 0, .70),
                rgba(0, 0, 0, .90)
            ),
            url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=2000&q=80')
            center / cover;
    }

    .register-card {
        width: 100%;
        max-width: 650px;

        background: rgba(20, 20, 20, .96);

        border: 1px solid rgba(255,255,255,.10);

        padding: 45px;

        border-radius: 4px;

        box-shadow:
            0 30px 80px rgba(0,0,0,.60);
    }

    .register-title {
        text-align: center;
        margin-bottom: 35px;
    }

    .register-title span {
        display: block;

        color: #e50914;

        font-size: 13px;

        font-weight: 700;

        letter-spacing: 3px;

        margin-bottom: 10px;
    }

    .register-title h1 {
        color: white;

        font-size: 32px;

        margin: 0;
    }

    .register-title p {
        color: #999;

        font-size: 14px;

        margin-top: 12px;
    }

    .form-row {
        display: grid;

        grid-template-columns: 1fr 1fr;

        gap: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;

        color: #ddd;

        font-size: 13px;

        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;

        padding: 14px 16px;

        background: #111;

        border: 1px solid #333;

        color: white;

        border-radius: 2px;

        outline: none;

        box-sizing: border-box;
    }

    .form-control:focus {
        border-color: #e50914;
    }

    textarea.form-control {
        resize: vertical;

        min-height: 90px;
    }

    .auth-button {
        width: 100%;

        padding: 15px;

        border: none;

        background: #e50914;

        color: white;

        font-weight: 700;

        letter-spacing: 1px;

        cursor: pointer;

        transition: .3s;
    }

    .auth-button:hover {
        background: #b80710;
    }

    .auth-footer {
        text-align: center;

        margin-top: 25px;

        color: #999;

        font-size: 14px;
    }

    .auth-footer a {
        color: #e50914;

        text-decoration: none;

        font-weight: 600;
    }

    .auth-error {
        background: rgba(229,9,20,.10);

        border: 1px solid rgba(229,9,20,.30);

        color: #ff6b73;

        padding: 12px;

        margin-bottom: 20px;

        font-size: 14px;
    }

    @media (max-width: 600px) {

        .register-card {
            padding: 30px 20px;
        }

        .form-row {
            grid-template-columns: 1fr;

            gap: 0;
        }

        .register-title h1 {
            font-size: 26px;
        }
    }
</style>

<div class="register-page">

    <div class="register-card">

        <div class="register-title">

            <span>LUXORA MOTORS</span>

            <h1>Créer votre compte</h1>

            <p>
                Rejoignez LUXORA MOTORS et prenez rendez-vous
                facilement avec notre équipe.
            </p>

        </div>

        @if($errors->any())

            <div class="auth-error">

                <strong>Veuillez corriger les erreurs :</strong>

                <ul style="margin: 8px 0 0 18px;">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form
            action="{{ route('client.register.post') }}"
            method="POST"
        >

            @csrf

            <div class="form-row">

                <div class="form-group">

                    <label for="prenom">
                        Prénom *
                    </label>

                    <input
                        type="text"
                        name="prenom"
                        id="prenom"
                        class="form-control"
                        value="{{ old('prenom') }}"
                        required
                    >

                </div>

                <div class="form-group">

                    <label for="nom">
                        Nom *
                    </label>

                    <input
                        type="text"
                        name="nom"
                        id="nom"
                        class="form-control"
                        value="{{ old('nom') }}"
                        required
                    >

                </div>

            </div>

            <div class="form-group">

                <label for="email">
                    Adresse email *
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    required
                >

            </div>

            <div class="form-group">

                <label for="telephone">
                    Téléphone *
                </label>

                <input
                    type="tel"
                    name="telephone"
                    id="telephone"
                    class="form-control"
                    value="{{ old('telephone') }}"
                    placeholder="+261 ..."
                    required
                >

            </div>

            <div class="form-group">

                <label for="adresse">
                    Adresse
                </label>

                <textarea
                    name="adresse"
                    id="adresse"
                    class="form-control"
                    placeholder="Votre adresse..."
                >{{ old('adresse') }}</textarea>

            </div>

            <div class="form-row">

                <div class="form-group">

                    <label for="password">
                        Mot de passe *
                    </label>

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        required
                        minlength="8"
                    >

                </div>

                <div class="form-group">

                    <label for="password_confirmation">
                        Confirmer le mot de passe *
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control"
                        required
                        minlength="8"
                    >

                </div>

            </div>

            <button
                type="submit"
                class="auth-button"
            >
                CRÉER MON COMPTE
            </button>

        </form>

        <div class="auth-footer">

            Vous avez déjà un compte ?

            <a href="{{ route('client.login') }}">
                Se connecter
            </a>

        </div>

    </div>

</div>

@endsection
```
