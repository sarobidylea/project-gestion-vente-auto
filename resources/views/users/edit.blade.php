@extends('layouts.app')

@section('title', 'Modifier un utilisateur - Luxora Motors')

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

    .section-title {
        font-size: 17px;
        color: white;
        margin-bottom: 22px;
        padding-bottom: 12px;
        border-bottom: 1px solid #252525;
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

    .current-user {
        background: #181818;
        border: 1px solid #292929;
        border-radius: 8px;
        padding: 14px;
        margin-bottom: 25px;
        color: #aaa;
        font-size: 13px;
    }

    .current-user strong {
        color: white;
    }
</style>

<div class="users-page">

<div class="page-header">
    <h1>Modifier l'utilisateur</h1>
    <p>Modifier les informations du compte.</p>
</div>

<div class="form-card">

    <div class="current-user">
        Utilisateur sélectionné :
        <strong>{{ $user->name }}</strong>
    </div>

    <div class="section-title">
        Informations du compte
    </div>

    <form method="POST" action="{{ route('users.update', $user) }}">

        @csrf
        @method('PUT')

        <div class="form-group">

            <label for="name">
                Nom complet
            </label>

            <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                value="{{ old('name', $user->name) }}"
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
                value="{{ old('email', $user->email) }}"
                required
            >

            @error('email')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>
        <div class="form-group">
                <label for="role">Rôle</label>

            <select
                id="role"
                name="role"
                class="form-control"
                required
            >
                <option value="vendeur"
                    {{ old('role', $user->role) === 'vendeur' ? 'selected' : '' }}>
                    Vendeur
                </option>

                <option value="gestionnaire"
                    {{ old('role', $user->role) === 'gestionnaire' ? 'selected' : '' }}>
                    Gestionnaire
                </option>

                <option value="administrateur"
                    {{ old('role', $user->role) === 'administrateur' ? 'selected' : '' }}>
                    Administrateur
                </option>
            </select>

            @error('role')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

            </div>


        <div class="section-title">
            Modifier le mot de passe
        </div>

        <div class="password-info" style="margin-bottom: 20px;">
            Laissez les champs vides si vous ne souhaitez pas modifier
            le mot de passe.
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
                placeholder="Minimum 8 caractères"
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
                placeholder="Retapez le nouveau mot de passe"
            >

        </div>

        <div class="actions">

            <button type="submit" class="btn btn-primary">
                ✓ Enregistrer les modifications
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


</div>

@endsection
