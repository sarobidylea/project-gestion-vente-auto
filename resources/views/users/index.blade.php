@extends('layouts.app')

@section('title', 'Gestion des utilisateurs - Luxora Motors')

@section('content')

<style>

.users-page {
    max-width: 1400px;
    margin: 0 auto;
}

/* =========================
   HERO
========================= */

.hero {
    position: relative;
    min-height: 190px;
    display: flex;
    align-items: center;
    overflow: hidden;
    margin: 0 -42px 30px;
    padding: 30px 42px;

    background:
        linear-gradient(
            90deg,
            #050505 25%,
            rgba(5,5,5,.75) 55%,
            rgba(40,0,6,.35) 100%
        ),
        url("{{ asset('images/fond2.jpeg') }}");

    background-size: cover;
    background-position: right center;
    background-repeat: no-repeat;
}

.hero::after {
    content: "";
    position: absolute;
    right: -100px;
    top: -80px;
    width: 600px;
    height: 280px;

    background:
        radial-gradient(
            ellipse,
            rgba(255,20,30,.25),
            transparent 65%
        );

    transform: rotate(-8deg);
}

.hero-content {
    position: relative;
    z-index: 2;
}

.breadcrumb {
    color: #777;
    font-size: 11px;
    margin-bottom: 15px;
}

.breadcrumb span {
    color: #ddd;
}

.hero h1 {
    margin: 0;
    color: #fff;
    font-size: 36px;
    font-weight: 800;
    letter-spacing: -1px;
}

.hero h1 span {
    color: #ed101b;
}

.hero p {
    margin: 5px 0 15px;
    color: #aaa;
    font-size: 14px;
}

.hero-line {
    width: 60px;
    height: 3px;
    background: #ed101b;
}

.hero-button {
    position: absolute;
    z-index: 5;
    right: 42px;
    top: 58px;

    padding: 13px 22px;
    border-radius: 7px;

    background: #ed101b;
    color: white;

    font-weight: 700;
    font-size: 13px;
    text-decoration: none;

    transition: .2s;
}

.hero-button:hover {
    background: #ff2630;
    transform: translateY(-2px);
}

/* =========================
   ALERTES
========================= */

.alert {
    padding: 14px 18px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 14px;
}

.alert-success {
    background: rgba(40, 167, 69, .12);
    border: 1px solid rgba(40, 167, 69, .3);
    color: #6ee786;
}

.alert-error {
    background: rgba(255, 21, 34, .12);
    border: 1px solid rgba(255, 21, 34, .3);
    color: #ff6b73;
}

/* =========================
   CARTE UTILISATEURS
========================= */

.users-card {
    background: #111;
    border: 1px solid #252525;
    border-radius: 14px;
    overflow: hidden;
}

.table-wrapper {
    overflow-x: auto;
}

.users-table {
    width: 100%;
    border-collapse: collapse;
}

.users-table th {
    background: #181818;
    color: #aaa;
    text-align: left;
    padding: 16px 18px;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .5px;
}

.users-table td {
    padding: 16px 18px;
    border-top: 1px solid #252525;
    color: #ddd;
    font-size: 14px;
}

.users-table tr:hover td {
    background: #151515;
}

/* =========================
   UTILISATEUR
========================= */

.user-cell {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;

    background: #ff1522;
    color: white;

    display: flex;
    align-items: center;
    justify-content: center;

    font-weight: 700;
}

.user-name {
    color: white;
    font-weight: 600;
}

.user-email {
    color: #888;
    font-size: 12px;
    margin-top: 3px;
}

/* =========================
   BADGE ROLE
========================= */

.badge {
    display: inline-block;

    padding: 5px 10px;
    border-radius: 20px;

    background: rgba(255, 21, 34, .12);
    color: #ff5964;

    font-size: 12px;
    font-weight: 600;
}

/* =========================
   ACTIONS
========================= */

.actions {
    display: flex;
    align-items: center;
    gap: 8px;
}

.action-btn {
    width: 34px;
    height: 34px;

    border-radius: 7px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    text-decoration: none;

    border: 1px solid #333;
    background: #1a1a1a;
    color: #bbb;

    cursor: pointer;
    transition: .2s;
}

.action-btn:hover {
    color: white;
    border-color: #555;
    background: #252525;
}

.delete-btn:hover {
    color: #ff1522;
    border-color: #ff1522;
}

/* =========================
   EMPTY
========================= */

.empty {
    text-align: center;
    padding: 50px 20px;
    color: #777;
}

.empty-icon {
    font-size: 40px;
    margin-bottom: 12px;
}

/* =========================
   RESPONSIVE
========================= */

@media (max-width: 700px) {

    .hero {
        margin: 0 -20px 30px;
        padding: 30px 20px;
        min-height: 220px;
    }

    .hero h1 {
        font-size: 30px;
    }

    .hero-button {
        position: absolute;
        left: 20px;
        right: 20px;
        top: auto;
        bottom: 25px;
        text-align: center;
    }

    .users-table th,
    .users-table td {
        padding: 12px;
    }
}

</style>

<div class="users-page">

    {{-- =========================
         HERO
    ========================= --}}

    <div class="hero">

        <div class="hero-content">

            <div class="breadcrumb">
                Accueil &nbsp;›&nbsp;
                <span>Utilisateurs</span>
            </div>

            <h1>
                Nos <span>utilisateurs</span>
            </h1>

            <p>
                Gérez les comptes utilisateurs de LUXORA MOTORS.
            </p>

            <div class="hero-line"></div>

        </div>

        <a href="{{ route('users.create') }}" class="hero-button">
            ＋ &nbsp; Ajouter un utilisateur
        </a>

    </div>


    {{-- =========================
         ALERTES
    ========================= --}}

    @if(session('success'))

        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-error">
            ⚠ {{ session('error') }}
        </div>

    @endif


    {{-- =========================
         TABLE UTILISATEURS
    ========================= --}}

    <div class="users-card">

        @if($users->count() > 0)

            <div class="table-wrapper">

                <table class="users-table">

                    <thead>

                        <tr>
                            <th>Utilisateur</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Créé le</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($users as $user)

                            <tr>

                                {{-- UTILISATEUR --}}

                                <td>

                                    <div class="user-cell">

                                        <div class="user-avatar">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>

                                        <div>

                                            <div class="user-name">
                                                {{ $user->name }}
                                            </div>

                                            <div class="user-email">
                                                ID #{{ $user->id }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- EMAIL --}}

                                <td>
                                    {{ $user->email }}
                                </td>


                                {{-- ROLE --}}

                                <td>

                                    <span class="badge">
                                        {{ ucfirst($user->role) }}
                                    </span>

                                </td>


                                {{-- DATE --}}

                                <td>

                                    {{ $user->created_at
                                        ? $user->created_at->format('d/m/Y')
                                        : '-'
                                    }}

                                </td>


                                {{-- ACTIONS --}}

                                <td>

                                    <div class="actions">

                                        {{-- VOIR --}}

                                        <a
                                            href="{{ route('users.show', $user) }}"
                                            class="action-btn"
                                            title="Voir"
                                        >
                                            👁
                                        </a>


                                        {{-- MODIFIER --}}

                                        <a
                                            href="{{ route('users.edit', $user) }}"
                                            class="action-btn"
                                            title="Modifier"
                                        >
                                            ✎
                                        </a>


                                        {{-- SUPPRIMER --}}

                                        @if(auth()->id() !== $user->id)

                                            <form
                                                method="POST"
                                                action="{{ route('users.destroy', $user) }}"
                                                onsubmit="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="action-btn delete-btn"
                                                    title="Supprimer"
                                                >
                                                    🗑
                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="empty">

                <div class="empty-icon">
                    👥
                </div>

                <h3>Aucun utilisateur</h3>

                <p>
                    Il n'y a encore aucun utilisateur enregistré.
                </p>

            </div>

        @endif

    </div>

</div>

@endsection