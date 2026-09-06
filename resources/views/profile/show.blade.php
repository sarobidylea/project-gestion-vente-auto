@extends('layouts.app')

@section('title', 'Mon profil - Luxora Motors')

@section('styles')

<style>
    .profile-page {
        max-width: 1000px;
        margin: 0 auto;
        padding-top: 35px;
    }

    .profile-header {
        margin-bottom: 30px;
    }

    .profile-header h1 {
        margin: 0;
        font-size: 30px;
        font-weight: 800;
    }

    .profile-header p {
        margin-top: 8px;
        color: #777;
        font-size: 14px;
    }

    .profile-card {
        background: #0d0d0d;
        border: 1px solid #242424;
        border-radius: 16px;
        overflow: hidden;
    }

    .profile-cover {
        height: 130px;
        background:
            linear-gradient(
                135deg,
                #550006,
                #170000,
                #090909
            );
    }

    .profile-main {
        padding: 0 35px 35px;
    }

    .profile-avatar-large {
        width: 90px;
        height: 90px;

        margin-top: -45px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: #85000a;
        border: 5px solid #0d0d0d;

        font-size: 32px;
        font-weight: 800;
    }

    .profile-name {
        margin-top: 15px;
        font-size: 24px;
        font-weight: 700;
    }

    .profile-email {
        margin-top: 5px;
        color: #777;
        font-size: 14px;
    }

    .profile-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;

        margin-top: 35px;
    }

    .info-box {
        padding: 20px;

        background: #111;
        border: 1px solid #242424;
        border-radius: 12px;
    }

    .info-label {
        color: #666;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .info-value {
        color: #fff;
        font-size: 15px;
        font-weight: 600;
    }

    .role-badge {
        display: inline-block;

        padding: 6px 12px;

        border-radius: 20px;

        background: rgba(229, 9, 20, .12);
        border: 1px solid rgba(229, 9, 20, .3);

        color: #ff1522;

        font-size: 12px;
        font-weight: 600;
    }

    .profile-actions {
        display: flex;
        gap: 12px;

        margin-top: 30px;
    }

    .btn-profile {
        padding: 12px 20px;

        border-radius: 8px;

        text-decoration: none;

        font-size: 13px;
        font-weight: 600;
    }

    .btn-edit {
        background: #e50914;
        color: white;
    }

    .btn-edit:hover {
        background: #b20710;
    }

    .btn-back {
        background: #1a1a1a;
        border: 1px solid #2b2b2b;
        color: #bbb;
    }

    .btn-back:hover {
        background: #242424;
        color: white;
    }

    @media (max-width: 700px) {
        .profile-info {
            grid-template-columns: 1fr;
        }

        .profile-main {
            padding: 0 20px 25px;
        }

        .profile-actions {
            flex-direction: column;
        }
    }
</style>

@endsection

@section('content')

<div class="profile-page">

    <div class="profile-header">
        <h1>Mon profil</h1>
        <p>Consultez les informations de votre compte administrateur.</p>
    </div>

    <div class="profile-card">

        <div class="profile-cover"></div>

        <div class="profile-main">

            <div class="profile-avatar-large">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>

            <div class="profile-name">
                {{ $user->name }}
            </div>

            <div class="profile-email">
                {{ $user->email }}
            </div>

            <div class="profile-info">

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
                        <span class="role-badge">
                            Administrateur
                        </span>
                    </div>
                </div>

                <div class="info-box">
                    <div class="info-label">
                        Membre depuis
                    </div>

                    <div class="info-value">
                        {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Non disponible' }}
                    </div>
                </div>

            </div>

            <div class="profile-actions">

            <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                ✎ Modifier le profil
            </a>


                <a href="{{ route('dashboard') }}" class="btn-profile btn-back">
                    ← Retour au dashboard
                </a>

            </div>

        </div>

    </div>

</div>

@endsection

