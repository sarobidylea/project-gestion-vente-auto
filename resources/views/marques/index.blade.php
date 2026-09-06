@extends('layouts.app')

@section('title', 'Marques')

@section('styles')
<style>
    .brands-page {
        max-width: 1250px;
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
                rgba(5, 5, 5, .75) 55%,
                rgba(40, 0, 6, .35) 100%
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
                rgba(255, 20, 30, .25),
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
       MESSAGES
    ========================= */

    .alert {
        padding: 15px 18px;
        border-radius: 8px;
        margin-bottom: 25px;
        font-size: 14px;
    }

    .alert-success {
        background: rgba(0, 180, 80, .12);
        border: 1px solid rgba(0, 180, 80, .3);
        color: #45e58a;
    }

    .alert-error {
        background: rgba(229, 9, 20, .12);
        border: 1px solid rgba(229, 9, 20, .3);
        color: #ff626a;
    }

    /* =========================
       GRID
    ========================= */

    .brands-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 22px;
    }

    .brand-card {
        background: #0d0d0d;
        border: 1px solid #202020;
        border-radius: 14px;
        padding: 25px;
        transition: .3s;
        position: relative;
        overflow: hidden;
    }

    .brand-card:hover {
        transform: translateY(-5px);
        border-color: #e50914;
        box-shadow: 0 12px 35px rgba(229, 9, 20, .12);
    }

    /* =========================
       LOGO
    ========================= */

    .brand-logo {
        height: 130px;
        display: flex;
        align-items: center;
        justify-content: center;

        background: #080808;
        border-radius: 10px;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .brand-logo img {
        width: 90px;
        height: 90px;
        object-fit: contain;
    }

    .logo-placeholder {
        width: 75px;
        height: 75px;
        border-radius: 50%;

        border: 2px solid #333;

        display: flex;
        align-items: center;
        justify-content: center;

        color: #e50914;
        font-size: 28px;
        font-weight: 800;
    }

    /* =========================
       INFORMATIONS
    ========================= */

    .brand-name {
        color: white;
        font-size: 20px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .brand-description {
        color: #777;
        font-size: 13px;
        line-height: 1.6;
        min-height: 42px;
    }

    .brand-count {
        margin-top: 18px;
        padding-top: 15px;

        border-top: 1px solid #222;

        color: #999;
        font-size: 13px;
    }

    .brand-count strong {
        color: #fff;
    }

    /* =========================
       ACTIONS
    ========================= */

    .brand-actions {
        display: flex;
        gap: 8px;
        margin-top: 18px;
    }

    .action-btn {
        flex: 1;
        text-align: center;

        padding: 9px;
        border-radius: 7px;

        text-decoration: none;
        font-size: 12px;
        font-weight: 700;

        transition: .3s;
    }

    .btn-view {
        background: #171717;
        color: #ccc;
    }

    .btn-view:hover {
        background: #252525;
        color: white;
    }

    .btn-edit {
        background: rgba(229, 9, 20, .1);
        color: #ff4d55;
    }

    .btn-edit:hover {
        background: #e50914;
        color: white;
    }

    .delete-btn {
        border: none;
        cursor: pointer;

        background: #171717;
        color: #888;

        padding: 9px 12px;
        border-radius: 7px;

        transition: .3s;
    }

    .delete-btn:hover {
        background: #e50914;
        color: white;
    }

    /* =========================
       PAGINATION
    ========================= */

    .pagination-container {
        margin-top: 35px;

        display: flex;
        justify-content: center;
    }

    .pagination-container nav {
        display: flex;
        gap: 5px;
    }

    .pagination-container a,
    .pagination-container span {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-width: 38px;
        height: 38px;
        padding: 0 10px;

        border-radius: 7px;

        background: #111;
        border: 1px solid #252525;

        color: #aaa;
        text-decoration: none;
        font-size: 13px;
    }

    .pagination-container a:hover {
        border-color: #e50914;
        color: white;
    }

    .pagination-container span[aria-current="page"] {
        background: #e50914;
        border-color: #e50914;
        color: white;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1100px) {
        .brands-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 800px) {
        .brands-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .hero {
            margin-left: -25px;
            margin-right: -25px;
            padding-left: 25px;
            padding-right: 25px;
        }

        .hero-button {
            position: static;
            margin-left: auto;
        }
    }

    @media (max-width: 500px) {
        .brands-grid {
            grid-template-columns: 1fr;
        }

        .hero {
            min-height: 220px;
            align-items: flex-start;
        }

        .hero-button {
            position: absolute;
            left: 25px;
            right: auto;
            top: auto;
            bottom: 25px;
        }
    }
</style>
@endsection

@section('content')

<div class="brands-page">

    {{-- =========================
         HERO
    ========================= --}}
    <div class="hero">

        <div class="hero-content">

            <div class="breadcrumb">
                Accueil &nbsp;›&nbsp;
                <span>Marques</span>
            </div>

            <h1>
                Nos <span>marques</span>
            </h1>

            <p>
                Gérez les marques disponibles dans votre catalogue automobile.
            </p>

            <div class="hero-line"></div>

        </div>

        <a href="{{ route('marques.create') }}" class="hero-button">
            ＋ &nbsp; Ajouter une marque
        </a>

    </div>


    {{-- Message succès --}}
    @if(session('success'))

        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>

    @endif


    {{-- Message erreur --}}
    @if(session('error'))

        <div class="alert alert-error">
            ⚠ {{ session('error') }}
        </div>

    @endif


    {{-- =========================
         LISTE DES MARQUES
    ========================= --}}
    <div class="brands-grid">

        @forelse($marques as $marque)

            <div class="brand-card">

                {{-- Logo --}}
                <div class="brand-logo">

                    @if($marque->logo)

                        <img
                            src="{{ asset('storage/' . $marque->logo) }}"
                            alt="{{ $marque->nom }}"
                        >

                    @else

                        <div class="logo-placeholder">
                            {{ strtoupper(substr($marque->nom, 0, 1)) }}
                        </div>

                    @endif

                </div>


                {{-- Nom --}}
                <div class="brand-name">
                    {{ $marque->nom }}
                </div>


                {{-- Description --}}
                <div class="brand-description">

                    {{ $marque->description ?: 'Aucune description disponible.' }}

                </div>


                {{-- Nombre de véhicules --}}
                <div class="brand-count">

                    Véhicules :
                    <strong>{{ $marque->vehicules_count }}</strong>

                </div>


                {{-- Actions --}}
                <div class="brand-actions">

                    <a
                        href="{{ route('marques.show', $marque) }}"
                        class="action-btn btn-view"
                    >
                        Voir
                    </a>


                    <a
                        href="{{ route('marques.edit', $marque) }}"
                        class="action-btn btn-edit"
                    >
                        Modifier
                    </a>


                    <form
                        action="{{ route('marques.destroy', $marque) }}"
                        method="POST"
                        onsubmit="return confirm('Voulez-vous vraiment supprimer cette marque ?')"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="delete-btn"
                            title="Supprimer"
                        >
                            🗑
                        </button>

                    </form>

                </div>

            </div>

        @empty

            <div style="
                grid-column: 1 / -1;
                text-align: center;
                padding: 80px 20px;
                background: #0d0d0d;
                border: 1px solid #202020;
                border-radius: 14px;
            ">

                <div style="font-size: 50px; margin-bottom: 15px;">
                    🏷️
                </div>

                <h2 style="color:white; margin-bottom:10px;">
                    Aucune marque
                </h2>

                <p style="color:#777;">
                    Commencez par ajouter une marque automobile.
                </p>

            </div>

        @endforelse

    </div>


    {{-- =========================
         PAGINATION
    ========================= --}}
    @if($marques->hasPages())

        <div class="pagination-container">
            {{ $marques->links() }}
        </div>

    @endif

</div>

@endsection