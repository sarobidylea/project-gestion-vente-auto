@extends('layouts.client')

@section('title', 'Connexion Client | LUXORA MOTORS')

@section('content')

<style>
    .auth-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 140px 20px 80px;
        background:
            linear-gradient(rgba(0,0,0,.65), rgba(0,0,0,.85)),
            url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=2000&q=80')
            center/cover;
    }

    .auth-card {
        width: 100%;
        max-width: 500px;
        background: rgba(20,20,20,.95);
        border: 1px solid rgba(255,255,255,.1);
        padding: 45px;
        border-radius: 4px;
        box-shadow: 0 30px 80px rgba(0,0,0,.5);
    }

    .auth-title {
        text-align: center;
        margin-bottom: 35px;
    }

    .auth-title span {
        display: block;
        color: #e50914;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 3px;
        margin-bottom: 10px;
    }

    .auth-title h1 {
        color: white;
        font-size: 32px;
        margin: 0;
    }

    .form-group {
        margin-bottom: 22px;
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
        background: rgba(229,9,20,.1);
        border: 1px solid rgba(229,9,20,.3);
        color: #ff6b73;
        padding: 12px;
        margin-bottom: 20px;
        font-size: 14px;
    }
</style>

<div class="auth-page">

    <div class="auth-card">

        <div class="auth-title">
            <span>LUXORA MOTORS</span>
            <h1>Connexion</h1>
        </div>

        @if($errors->any())
            <div class="auth-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('client.login.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Adresse email</label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>

                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    required
                >
            </div>

            <button type="submit" class="auth-button">
                SE CONNECTER
            </button>
        </form>

        <div class="auth-footer">
            Vous n'avez pas encore de compte ?
            <a href="{{ route('client.register') }}">
                Créer un compte
            </a>
        </div>

    </div>

</div>

@endsection

