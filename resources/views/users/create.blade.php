@extends('layouts.app')

@section('title', 'Ajouter un utilisateur - Luxora Motors')

@section('content')

<style>
    .users-page {
        max-width: 900px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 25px;
    }

    .page-header h1 {
        font-size: 28px;
        margin: 0 0 6px;
    }

    .page-header p {
        color: #888;
        margin: 0;
        font-size: 14px;
    }

    .form-card {
        background: #111;
        border: 1px solid #252525;
        border-radius: 14px;
        padding: 30px;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        display: block;
        color: #ddd;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        box-sizing: border-box;
        padding: 13px 15px;
        background: #181818;
        border: 1px solid #303030;
        border-radius: 8px;
        color: white;
        font-size: 14px;
        outline: none;
    }

    .form-control:focus {
        border-color: #ff1522;
    }

    .error {
        color: #ff5964;
        font-size: 12px;
        margin-top: 6px;
    }

    .password-info {
        color: #777;
        font-size: 12px;
        margin-top: 6px;
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

    .section-title {
        font-size: 17px;
        color: white;
        margin-bottom: 22px;
        padding-bottom: 12px;
        border-bottom: 1px solid #252525;
    }
</style>

<div class="users-page">

```
<div class="page-header">
    <h1>Ajouter un utilisateur</h1>
    <p>Créer un nouveau compte administrateur.</p>
</div>

<div class="form-card">

    <div class="section-title">
        Informations du compte
    </div>

    <form method="POST" action="{{ route('users.store') }}">

        @csrf

        <div class="form-group">

            <label for="name">
                Nom complet
            </label>

            <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                value="{{ old('name') }}"
                placeholder="Ex : Jean Dupont"
                required
            >

            @error('name')
                <div class="error">
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
                class="form-control"
                value="{{ old('email') }}"
                placeholder="exemple@luxora.com"
                required
            >

            @error('email')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="form-group">


            <label for="role">
                Rôle
            </label>

            <select
                id="role"
                name="role"
                class="form-control"
                required
            >

                <option value="vendeur"
                    {{ old('role', 'vendeur') == 'vendeur' ? 'selected' : '' }}>
                    Vendeur
                </option>

                <option value="gestionnaire"
                    {{ old('role') == 'gestionnaire' ? 'selected' : '' }}>
                    Gestionnaire
                </option>

                <option value="administrateur"
                    {{ old('role') == 'administrateur' ? 'selected' : '' }}>
                    Administrateur
                </option>

            </select>

            @error('role')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>


        <div class="form-group">

            <label for="password">
                Mot de passe
            </label>

            <input
                type="password"
                id="password"
                name="password"
                class="form-control"
                placeholder="Minimum 8 caractères"
                required
            >

            <div class="password-info">
                Le mot de passe doit contenir au minimum 8 caractères.
            </div>

            @error('password')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="form-group">

            <label for="password_confirmation">
                Confirmer le mot de passe
            </label>

            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="form-control"
                placeholder="Retapez le mot de passe"
                required
            >

        </div>

        <div class="actions">

            <button type="submit" class="btn btn-primary">
                + Créer l'utilisateur
            </button>

            <a
                href="{{ route('users.index') }}"
                class="btn btn-secondary"
            >
                Annuler
            </a>

        </div>

    </form>

</div>
```

</div>

@endsection
