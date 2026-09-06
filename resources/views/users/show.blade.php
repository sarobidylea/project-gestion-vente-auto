@extends('layouts.app')

@section('title', 'Détails utilisateur - Luxora Motors')

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

    .profile-card {
        background: #111;
        border: 1px solid #252525;
        border-radius: 16px;
        overflow: hidden;
    }

    .profile-header {
        background: linear-gradient(
            135deg,
            #1b1b1b,
            #111
        );
        padding: 35px;
        display: flex;
        align-items: center;
        gap: 20px;
        border-bottom: 1px solid #252525;
    }

    .avatar {
        width: 75px;
        height: 75px;
        border-radius: 50%;
        background: #ff1522;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .profile-header h2 {
        margin: 0 0 6px;
        color: white;
        font-size: 24px;
    }

    .profile-header p {
        margin: 0;
        color: #888;
        font-size: 14px;
    }

    .badge {
        display: inline-block;
        margin-top: 10px;
        padding: 5px 11px;
        border-radius: 20px;
        background: rgba(255, 21, 34, .12);
        color: #ff5964;
        font-size: 12px;
        font-weight: 600;
    }

    .information {
        padding: 30px;
    }

    .information-title {
        color: white;
        font-size: 17px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .info-box {
        background: #181818;
        border: 1px solid #292929;
        border-radius: 9px;
        padding: 18px;
    }

    .info-label {
        color: #777;
        font-size: 12px;
        margin-bottom: 7px;
        text-transform: uppercase;
    }

    .info-value {
        color: white;
        font-size: 14px;
        font-weight: 500;
        word-break: break-word;
    }

    .actions {
        display: flex;
        gap: 12px;
        margin-top: 25px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
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

    @media (max-width: 650px) {

        .profile-header {
            padding: 25px;
        }

        .information {
            padding: 20px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="users-page">

```
<div class="page-header">

    <h1>Détails de l'utilisateur</h1>

    <p>
        Consultez les informations du compte.
    </p>

</div>

<div class="profile-card">

    <div class="profile-header">

        <div class="avatar">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>

        <div>

            <h2>
                {{ $user->name }}
            </h2>

            <p>
                {{ $user->email }}
            </p>

            <span class="badge">
                Administrateur
            </span>

        </div>

    </div>

    <div class="information">

        <div class="information-title">
            Informations du compte
        </div>

        <div class="info-grid">

            <div class="info-box">

                <div class="info-label">
                    Identifiant
                </div>

                <div class="info-value">
                    #{{ $user->id }}
                </div>

            </div>

            <div class="info-box">

                <div class="info-label">
                    Nom complet
                </div>

                <div class="info-value">
                    {{ $user->name }}
                </div>

            </div>

            <div class="info-box">

                <div class="info-label">
                    Adresse email
                </div>

                <div class="info-value">
                    {{ $user->email }}
                </div>

            </div>

            <div class="info-box">

                <div class="info-label">
                    Rôle
                </div>

                <div class="info-value">
                    Administrateur
                </div>

            </div>

            <div class="info-box">

                <div class="info-label">
                    Compte créé le
                </div>

                <div class="info-value">
                    {{ $user->created_at ? $user->created_at->format('d/m/Y à H:i') : '-' }}
                </div>

            </div>

            <div class="info-box">

                <div class="info-label">
                    Dernière modification
                </div>

                <div class="info-value">
                    {{ $user->updated_at ? $user->updated_at->format('d/m/Y à H:i') : '-' }}
                </div>

            </div>

        </div>

        <div class="actions">

            <a
                href="{{ route('users.edit', $user) }}"
                class="btn btn-primary"
            >
                ✎ Modifier
            </a>

            <a
                href="{{ route('users.index') }}"
                class="btn btn-secondary"
            >
                ← Retour aux utilisateurs
            </a>

        </div>

    </div>

</div>
```

</div>

@endsection
