@extends('layouts.app')

@section('title', 'Modifier mon profil - Luxora Motors')

@section('content')

<style>
    .profile-page {
        max-width: 900px;
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

    .profile-card {
        background: #111;
        border: 1px solid #252525;
        border-radius: 16px;
        padding: 30px;
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

    .password-link {
        display: inline-block;
        margin-top: 25px;
        color: #ff1522;
        text-decoration: none;
        font-size: 14px;
    }

    .password-link:hover {
        text-decoration: underline;
    }
</style>

<div class="profile-page">

```
<div class="page-header">
    <h1>Modifier mon profil</h1>
    <p>Modifiez vos informations personnelles.</p>
</div>

<div class="profile-card">

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nom complet</label>

            <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                value="{{ old('name', $user->name) }}"
                required
            >

            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Adresse email</label>

            <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                value="{{ old('email', $user->email) }}"
                required
            >

            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">
                Enregistrer les modifications
            </button>

            <a href="{{ route('profile') }}" class="btn btn-secondary">
                Annuler
            </a>
        </div>
    </form>

    <a href="{{ route('profile.password') }}" class="password-link">
        🔐 Modifier mon mot de passe
    </a>

</div>
```

</div>

@endsection
