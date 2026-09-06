@extends('layouts.app')

@section('title', $marque->nom)

@section('styles')
<style>
    .brand-page {
        max-width: 1200px;
        margin: 0 auto;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #888;
        text-decoration: none;
        font-size: 13px;
        margin-bottom: 25px;
        transition: .3s;
    }

    .back-link:hover {
        color: #fff;
    }

    /* Brand Header */

    .brand-header {
        background: linear-gradient(135deg, #111 0%, #080808 100%);
        border: 1px solid #242424;
        border-radius: 16px;
        padding: 40px;
        display: grid;
        grid-template-columns: 180px 1fr auto;
        gap: 35px;
        align-items: center;
        margin-bottom: 35px;
    }

    .brand-logo {
        width: 180px;
        height: 180px;
        background: #050505;
        border: 1px solid #292929;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .brand-logo img {
        width: 135px;
        height: 135px;
        object-fit: contain;
    }

    .logo-placeholder {
        width: 100px;
        height: 100px;
        border: 2px solid #e50914;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #e50914;
        font-size: 40px;
        font-weight: 800;
    }

    .brand-info small {
        color: #e50914;
        text-transform: uppercase;
        letter-spacing: 3px;
        font-size: 11px;
        font-weight: 800;
    }

    .brand-info h1 {
        color: #fff;
        font-size: 42px;
        font-weight: 900;
        margin: 8px 0 12px;
    }

    .brand-description {
        color: #888;
        line-height: 1.7;
        font-size: 14px;
        max-width: 650px;
    }

    .brand-stat {
        text-align: center;
        min-width: 130px;
    }

    .brand-stat-number {
        color: #e50914;
        font-size: 42px;
        font-weight: 900;
    }

    .brand-stat-label {
        color: #777;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Actions */

    .brand-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 11px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        transition: .3s;
    }

    .btn-edit {
        background: #e50914;
        color: #fff;
    }

    .btn-edit:hover {
        background: #ff1a25;
        transform: translateY(-2px);
    }

    /* Vehicles */

    .section-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .section-title h2 {
        color: #fff;
        font-size: 23px;
        margin: 0;
    }

    .section-title span {
        color: #777;
        font-size: 13px;
    }

    .vehicles-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .vehicle-card {
        background: #0d0d0d;
        border: 1px solid #222;
        border-radius: 13px;
        overflow: hidden;
        transition: .3s;
    }

    .vehicle-card:hover {
        transform: translateY(-4px);
        border-color: #e50914;
    }

    .vehicle-image {
        height: 190px;
        background: #080808;
        position: relative;
        overflow: hidden;
    }

    .vehicle-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: .4s;
    }

    .vehicle-card:hover .vehicle-image img {
        transform: scale(1.05);
    }

    .vehicle-placeholder {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 50px;
        color: #333;
    }

    .vehicle-info {
        padding: 18px;
    }

    .vehicle-model {
        color: #fff;
        font-size: 18px;
        font-weight: 800;
        margin-bottom: 7px;
    }

    .vehicle-year {
        color: #777;
        font-size: 12px;
    }

    .vehicle-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #222;
    }

    .vehicle-price {
        color: #e50914;
        font-size: 17px;
        font-weight: 800;
    }

    .vehicle-status {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 5px 8px;
        border-radius: 5px;
    }

    .status-disponible {
        color: #42e58a;
        background: rgba(66, 229, 138, .1);
    }

    .status-vendu {
        color: #ff555d;
        background: rgba(229, 9, 20, .1);
    }

    .status-reserve {
        color: #ffc857;
        background: rgba(255, 200, 87, .1);
    }

    .vehicle-link {
        display: block;
        margin-top: 14px;
        color: #aaa;
        text-align: center;
        padding: 9px;
        background: #171717;
        border-radius: 7px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        transition: .3s;
    }

    .vehicle-link:hover {
        background: #252525;
        color: #fff;
    }

    .empty-state {
        text-align: center;
        padding: 70px 20px;
        background: #0d0d0d;
        border: 1px solid #222;
        border-radius: 14px;
    }

    .empty-state-icon {
        font-size: 50px;
        margin-bottom: 15px;
    }

    .empty-state h3 {
        color: #fff;
        margin-bottom: 8px;
    }

    .empty-state p {
        color: #777;
        font-size: 13px;
    }

    @media (max-width: 900px) {
        .brand-header {
            grid-template-columns: 140px 1fr;
        }

        .brand-logo {
            width: 140px;
            height: 140px;
        }

        .brand-stat {
            grid-column: 1 / -1;
            text-align: left;
        }

        .vehicles-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .brand-header {
            grid-template-columns: 1fr;
            padding: 25px;
        }

        .brand-logo {
            margin: auto;
        }

        .brand-info {
            text-align: center;
        }

        .brand-info h1 {
            font-size: 32px;
        }

        .brand-actions {
            justify-content: center;
        }

        .vehicles-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')

<div class="brand-page">

    {{-- Retour --}}
    <a href="{{ route('marques.index') }}" class="back-link">
        ← Retour aux marques
    </a>

    {{-- Informations de la marque --}}
    <div class="brand-header">

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

        {{-- Informations --}}
        <div class="brand-info">

            <small>Marque automobile</small>

            <h1>{{ $marque->nom }}</h1>

            <div class="brand-description">
                {{ $marque->description ?: 'Aucune description disponible pour cette marque.' }}
            </div>

            <div class="brand-actions">

                <a
                    href="{{ route('marques.edit', $marque) }}"
                    class="btn btn-edit"
                >
                    ✏ Modifier la marque
                </a>

            </div>

        </div>

        {{-- Statistique --}}
        <div class="brand-stat">

            <div class="brand-stat-number">
                {{ $marque->vehicules->count() }}
            </div>

            <div class="brand-stat-label">
                Véhicule(s)
            </div>

        </div>

    </div>

    {{-- Liste des véhicules --}}
    <div class="section-title">

        <h2>Véhicules {{ $marque->nom }}</h2>

        <span>
            {{ $marque->vehicules->count() }} véhicule(s)
        </span>

    </div>

    @if($marque->vehicules->count() > 0)

        <div class="vehicles-grid">

            @foreach($marque->vehicules as $vehicule)

                <div class="vehicle-card">

                    {{-- Image --}}
                    <div class="vehicle-image">

                        @if($vehicule->image)

                            <img
                                src="{{ asset('storage/' . $vehicule->image) }}"
                                alt="{{ $vehicule->modele }}"
                            >

                        @else

                            <div class="vehicle-placeholder">
                                🚘
                            </div>

                        @endif

                    </div>

                    {{-- Informations --}}
                    <div class="vehicle-info">

                        <div class="vehicle-model">
                            {{ $vehicule->modele }}
                        </div>

                        <div class="vehicle-year">
                            {{ $vehicule->annee }}
                            •
                            {{ number_format($vehicule->kilometrage, 0, ',', ' ') }} km
                        </div>

                        <div class="vehicle-details">

                            <div class="vehicle-price">
                                {{ number_format($vehicule->prix, 0, ',', ' ') }} Ar
                            </div>

                            @if($vehicule->statut === 'Disponible')

                                <span class="vehicle-status status-disponible">
                                    Disponible
                                </span>

                            @elseif($vehicule->statut === 'Vendu')

                                <span class="vehicle-status status-vendu">
                                    Vendu
                                </span>

                            @else

                                <span class="vehicle-status status-reserve">
                                    Réservé
                                </span>

                            @endif

                        </div>

                        <a
                            href="{{ route('vehicules.show', $vehicule) }}"
                            class="vehicle-link"
                        >
                            Voir le véhicule →
                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="empty-state">

            <div class="empty-state-icon">
                🚘
            </div>

            <h3>Aucun véhicule</h3>

            <p>
                Aucun véhicule n'est actuellement associé à la marque
                {{ $marque->nom }}.
            </p>

        </div>

    @endif

</div>

@endsection