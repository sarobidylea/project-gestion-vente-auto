@extends('layouts.app')

@section('title', 'Modifier le mot de passe - Luxora Motors')

@section('content')

<style>
    .password-page {
        max-width: 700px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 25px;
    }

    .page-header h1 {
        font-size: 28px;
        margin-bottom: 6px;
    }

    .page-header p {
        color: #888;
        font-size: 14px;
    }

    .password-card {
        background: #111;
        border: 1px solid #252525;
        border-radius: 16px;
        padding: 30px;
    }

    .security-icon {
        width: 55px;
        height: 55px;
        background: rgba(255, 21, 34, 0.12);
        border: 1px solid rgba(255, 21, 34, 0.3);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #ddd;
        font-size: 14px;
        font-weight: 600;
    }

    .form-control {
        width: 100%;
        padding: 13px 15px;
        background: #181818;
        border: 1px solid #303030;
        border-radius: 8px;
        color: white;
        font-size: 14px;
        outline: none;
        box-sizing: border-box;
    }

    .form-control:focus {
        border-color: #ff1522;
    }

    .error {
        color: #ff5964;
        font-size: 12px;
        margin-top: 6px;
    }

    .info {
        background: #181818;
        border: 1px solid #292929;
        border-radius: 8px;
        padding: 14px;
        color: #999;
        font-size: 13px;
        margin-bottom: 25px;
    }

    .actions {
        display: flex;
        gap: 12px;
        margin-top: 30px;
    }

    .btn {
        padding: 12px 20px;
        border-radius: 8px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
    }

    .btn-primary {
        background: #ff1522;
        color: white;
    }

    .btn-primary:hover {
        background: #d90e19;
    }

    .btn-secondary {
        background: #222;
        color: #ddd;
        border: 1px solid #333;
    }

    .btn-secondary:hover {
        background: #2c2c2c;
    }
</style>

<div class="password-page">

```
<div class="page-header">
    <h1>Modifier le mot de passe</h1>
    <p>Sécurisez votre compte Luxora Motors.</p>
</div>

<div class="password-card">

    <div class="security-icon">
        🔐
    </div>

    <div class="info">
        Pour modifier votre mot de passe, saisissez d'abord votre
        mot de passe actuel, puis choisissez un nouveau mot de passe
        d'au moins 8 caractères.
    </div>

    <form method="POST" action="{{ route('profile.password.update') }}">

        @csrf
        @method('PUT')

        <div class="form-group">

            <label for="current_password">
                Mot de passe actuel
            </label>

            <input
                type="password"
                id="current_password"
                name="current_password"
                class="form-control"
                required
            >

            @error('current_password')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="form-group">

            <label for="password">
                Nouveau mot de passe
            </label>

            <input
                type="password"
                id="password"
                name="password"
                class="form-control"
                required
            >

            @error('password')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="form-group">

            <label for="password_confirmation">
                Confirmer le nouveau mot de passe
            </label>

            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="form-control"
                required
            >

        </div>

        <div class="actions">

            <button type="submit" class="btn btn-primary">
                🔒 Modifier le mot de passe
            </button>

            <a href="{{ route('profile') }}" class="btn btn-secondary">
                Annuler
            </a>

        </div>

    </form>

</div>
```

</div>

@endsection
