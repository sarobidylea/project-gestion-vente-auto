@extends('layouts.client')

@section('title', 'Nos véhicules — LUXORA MOTORS')

@section('content')

<style>
    .catalogue-page {
        min-height: 100vh;
        background: #080808;
        color: #fff;
    }

    /* =========================
       HEADER
    ========================= */

    .catalogue-header {
        position: relative;
        padding: 150px 30px 80px;
        text-align: center;
        overflow: hidden;
        background:
            linear-gradient(
                rgba(0,0,0,.78),
                rgba(0,0,0,.95)
            ),
            url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=2000&q=85')
            center/cover;
    }

    .catalogue-header::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 1px;
        background: #e50914;
        opacity: .5;
    }

    .catalogue-header-content {
        position: relative;
        z-index: 2;
        max-width: 900px;
        margin: auto;
    }

    .catalogue-label {
        color: #e50914;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 4px;
        margin-bottom: 18px;
    }

    .catalogue-title {
        font-size: clamp(42px, 6vw, 78px);
        font-weight: 900;
        letter-spacing: -3px;
        margin: 0 0 20px;
        line-height: 1;
    }

    .catalogue-title span {
        color: #e50914;
    }

    .catalogue-description {
        color: #aaa;
        font-size: 16px;
        line-height: 1.8;
        max-width: 650px;
        margin: auto;
    }

    /* =========================
       CONTENT
    ========================= */

    .catalogue-container {
        max-width: 1450px;
        margin: auto;
        padding: 70px 30px 100px;
    }

    /* =========================
       FILTERS
    ========================= */

    .filters {
        background: #111;
        border: 1px solid #242424;
        padding: 25px;
        margin-bottom: 55px;
    }

    .filters-title {
        font-size: 13px;
        font-weight: 800;
        letter-spacing: 2px;
        margin-bottom: 22px;
        text-transform: uppercase;
    }

    .filters-form {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr auto;
        gap: 12px;
        align-items: end;
    }

    .filter-group label {
        display: block;
        color: #888;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .filter-input,
    .filter-select {
        width: 100%;
        height: 48px;
        padding: 0 15px;
        background: #080808;
        color: #fff;
        border: 1px solid #303030;
        outline: none;
        font-family: inherit;
        transition: .3s ease;
    }

    .filter-input:focus,
    .filter-select:focus {
        border-color: #e50914;
    }

    .filter-select option {
        background: #111;
        color: #fff;
    }

    .filter-button {
        height: 48px;
        padding: 0 25px;
        border: none;
        background: #e50914;
        color: #fff;
        font-weight: 800;
        font-size: 12px;
        letter-spacing: 1px;
        cursor: pointer;
        transition: .3s ease;
    }

    .filter-button:hover {
        background: #b80610;
        transform: translateY(-2px);
    }

    .reset-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 48px;
        padding: 0 18px;
        border: 1px solid #333;
        color: #aaa;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        transition: .3s ease;
    }

    .reset-button:hover {
        color: #fff;
        border-color: #e50914;
    }

    /* =========================
       RESULTS
    ========================= */

    .results-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 30px;
    }

    .results-title {
        font-size: 26px;
        font-weight: 800;
        margin: 0;
    }

    .results-count {
        color: #777;
        font-size: 13px;
    }

    /* =========================
       VEHICLES GRID
    ========================= */

    .vehicles-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }

    .vehicle-card {
        background: #111;
        border: 1px solid #222;
        overflow: hidden;
        transition: .4s ease;
    }

    .vehicle-card:hover {
        transform: translateY(-8px);
        border-color: #e50914;
        box-shadow: 0 20px 50px rgba(0,0,0,.45);
    }

    .vehicle-image {
        position: relative;
        height: 270px;
        overflow: hidden;
        background: #181818;
    }

    .vehicle-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: .6s ease;
    }

    .vehicle-card:hover .vehicle-image img {
        transform: scale(1.07);
    }

    .vehicle-status {
        position: absolute;
        top: 18px;
        left: 18px;
        padding: 7px 12px;
        background: rgba(0,0,0,.8);
        border-left: 3px solid #e50914;
        color: #fff;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .vehicle-content {
        padding: 25px;
    }

    .vehicle-brand {
        color: #e50914;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .vehicle-name {
        margin: 0;
        font-size: 25px;
        font-weight: 800;
    }

    .vehicle-details {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin: 20px 0;
    }

    .vehicle-detail {
        padding: 7px 9px;
        background: #191919;
        color: #999;
        font-size: 11px;
    }

    .vehicle-bottom {
        display: flex;
        align-items: end;
        justify-content: space-between;
        gap: 15px;
        padding-top: 20px;
        border-top: 1px solid #242424;
    }

    .price-label {
        display: block;
        color: #666;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 4px;
    }

    .vehicle-price {
        color: #fff;
        font-size: 20px;
        font-weight: 900;
    }

    .vehicle-link {
        color: #fff;
        text-decoration: none;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
        white-space: nowrap;
        transition: .3s ease;
    }

    .vehicle-link:hover {
        color: #e50914;
    }

    /* =========================
       EMPTY
    ========================= */

    .empty-state {
        padding: 80px 30px;
        text-align: center;
        background: #111;
        border: 1px solid #222;
    }

    .empty-icon {
        font-size: 45px;
        color: #e50914;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        margin: 0 0 10px;
        font-size: 24px;
    }

    .empty-state p {
        margin: 0 0 25px;
        color: #777;
    }

    .empty-state a {
        display: inline-block;
        padding: 13px 25px;
        background: #e50914;
        color: #fff;
        text-decoration: none;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
    }

    /* =========================
       PAGINATION
    ========================= */

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 55px;
    }

    .pagination-wrapper nav {
        display: flex;
        justify-content: center;
    }

    .pagination-wrapper svg {
        width: 18px;
        height: 18px;
    }

    .pagination-wrapper a,
    .pagination-wrapper span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 42px;
        height: 42px;
        margin: 3px;
        padding: 0 12px;
        background: #111;
        border: 1px solid #292929;
        color: #aaa;
        text-decoration: none;
        font-size: 12px;
        transition: .3s ease;
    }

    .pagination-wrapper a:hover {
        border-color: #e50914;
        color: #fff;
    }

    .pagination-wrapper span[aria-current="page"] {
        background: #e50914;
        border-color: #e50914;
        color: #fff;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1100px) {
        .filters-form {
            grid-template-columns: repeat(2, 1fr);
        }

        .vehicles-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 700px) {
        .catalogue-header {
            padding: 125px 20px 60px;
        }

        .catalogue-container {
            padding: 45px 18px 70px;
        }

        .filters-form {
            grid-template-columns: 1fr;
        }

        .vehicles-grid {
            grid-template-columns: 1fr;
        }

        .results-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .vehicle-image {
            height: 230px;
        }

        .vehicle-bottom {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>


<div class="catalogue-page">

    {{-- =========================
         HEADER
    ========================== --}}

    <section class="catalogue-header">

        <div class="catalogue-header-content">

            <div class="catalogue-label">
                LUXORA MOTORS
            </div>

            <h1 class="catalogue-title">
                NOS <span>VÉHICULES</span>
            </h1>

            <p class="catalogue-description">
                Découvrez notre sélection de véhicules premium,
                soigneusement choisis pour offrir performance,
                confort et élégance.
            </p>

        </div>

    </section>


    {{-- =========================
         CATALOGUE
    ========================== --}}

    <section class="catalogue-container">

        {{-- FILTRES --}}

        <div class="filters">

            <div class="filters-title">
                Rechercher un véhicule
            </div>

            <form
                action="{{ route('client.vehicules') }}"
                method="GET"
                class="filters-form"
            >

                {{-- Recherche --}}

                <div class="filter-group">

                    <label for="search">
                        Recherche
                    </label>

                    <input
                        type="text"
                        id="search"
                        name="search"
                        class="filter-input"
                        placeholder="Modèle ou marque..."
                        value="{{ request('search') }}"
                    >

                </div>


                {{-- Marque --}}

                <div class="filter-group">

                    <label for="marque_id">
                        Marque
                    </label>

                    <select
                        name="marque_id"
                        id="marque_id"
                        class="filter-select"
                    >

                        <option value="">
                            Toutes les marques
                        </option>

                        @foreach($marques as $marque)

                            <option
                                value="{{ $marque->id }}"
                                {{ request('marque_id') == $marque->id ? 'selected' : '' }}
                            >
                                {{ $marque->nom }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Carburant --}}

                <div class="filter-group">

                    <label for="carburant">
                        Carburant
                    </label>

                    <select
                        name="carburant"
                        id="carburant"
                        class="filter-select"
                    >

                        <option value="">
                            Tous
                        </option>

                        <option
                            value="Essence"
                            {{ request('carburant') === 'Essence' ? 'selected' : '' }}
                        >
                            Essence
                        </option>

                        <option
                            value="Diesel"
                            {{ request('carburant') === 'Diesel' ? 'selected' : '' }}
                        >
                            Diesel
                        </option>

                        <option
                            value="Hybride"
                            {{ request('carburant') === 'Hybride' ? 'selected' : '' }}
                        >
                            Hybride
                        </option>

                        <option
                            value="Electrique"
                            {{ request('carburant') === 'Electrique' ? 'selected' : '' }}
                        >
                            Électrique
                        </option>

                    </select>

                </div>


                {{-- Boîte --}}

                <div class="filter-group">

                    <label for="boite_vitesse">
                        Boîte
                    </label>

                    <select
                        name="boite_vitesse"
                        id="boite_vitesse"
                        class="filter-select"
                    >

                        <option value="">
                            Toutes
                        </option>

                        <option
                            value="Manuelle"
                            {{ request('boite_vitesse') === 'Manuelle' ? 'selected' : '' }}
                        >
                            Manuelle
                        </option>

                        <option
                            value="Automatique"
                            {{ request('boite_vitesse') === 'Automatique' ? 'selected' : '' }}
                        >
                            Automatique
                        </option>

                    </select>

                </div>


                {{-- Bouton --}}

                <div>

                    <button
                        type="submit"
                        class="filter-button"
                    >
                        FILTRER
                    </button>

                </div>

            </form>

            @if(request()->hasAny([
                'search',
                'marque_id',
                'carburant',
                'boite_vitesse'
            ]))

                <div style="margin-top:15px;">

                    <a
                        href="{{ route('client.vehicules') }}"
                        class="reset-button"
                    >
                        Réinitialiser les filtres
                    </a>

                </div>

            @endif

        </div>


        {{-- =========================
             RESULTATS
        ========================== --}}

        <div class="results-header">

            <h2 class="results-title">
                Notre sélection
            </h2>

            <div class="results-count">
                {{ $vehicules->total() }}
                véhicule(s) disponible(s)
            </div>

        </div>


        {{-- =========================
             VEHICULES
        ========================== --}}

        @if($vehicules->count() > 0)

            <div class="vehicles-grid">

                @foreach($vehicules as $vehicule)

                    <article class="vehicle-card">

                        {{-- IMAGE --}}

                        <div class="vehicle-image">

                            @if($vehicule->image)

                                <img
                                    src="{{ asset('storage/' . $vehicule->image) }}"
                                    alt="{{ $vehicule->marque->nom ?? '' }} {{ $vehicule->modele }}"
                                >

                            @else

                                <img
                                    src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?auto=format&fit=crop&w=1000&q=80"
                                    alt="Véhicule LUXORA MOTORS"
                                >

                            @endif

                            <div class="vehicle-status">
                                Disponible
                            </div>

                        </div>


                        {{-- CONTENU --}}

                        <div class="vehicle-content">

                            <div class="vehicle-brand">
                                {{ $vehicule->marque->nom ?? 'LUXORA' }}
                            </div>

                            <h3 class="vehicle-name">
                                {{ $vehicule->modele }}
                            </h3>


                            {{-- DETAILS --}}

                            <div class="vehicle-details">

                                <span class="vehicle-detail">
                                    {{ $vehicule->annee }}
                                </span>

                                <span class="vehicle-detail">
                                    {{ $vehicule->carburant }}
                                </span>

                                <span class="vehicle-detail">
                                    {{ $vehicule->boite_vitesse }}
                                </span>

                                <span class="vehicle-detail">
                                    {{ number_format($vehicule->kilometrage, 0, ',', ' ') }} km
                                </span>

                                @if($vehicule->puissance)

                                    <span class="vehicle-detail">
                                        {{ $vehicule->puissance }} ch
                                    </span>

                                @endif

                            </div>


                            {{-- PRIX + LIEN --}}

                            <div class="vehicle-bottom">

                                <div>

                                    <span class="price-label">
                                        Prix
                                    </span>

                                    <div class="vehicle-price">
                                        {{ number_format($vehicule->prix, 0, ',', ' ') }} Ar
                                    </div>

                                </div>

                                <a
                                    href="{{ route('client.vehicule.show', $vehicule) }}"
                                    class="vehicle-link"
                                >
                                    DÉCOUVRIR →
                                </a>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>


            {{-- PAGINATION --}}

            @if($vehicules->hasPages())

                <div class="pagination-wrapper">

                    {{ $vehicules->links() }}

                </div>

            @endif


        @else

            {{-- Aucun résultat --}}

            <div class="empty-state">

                <div class="empty-icon">
                    ◇
                </div>

                <h3>
                    Aucun véhicule trouvé
                </h3>

                <p>
                    Aucun véhicule disponible ne correspond à votre recherche.
                </p>

                <a href="{{ route('client.vehicules') }}">
                    VOIR TOUS LES VÉHICULES
                </a>

            </div>

        @endif

    </section>

</div>

@endsection

