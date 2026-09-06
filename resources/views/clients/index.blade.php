```blade
@extends('layouts.app')

@section('title', 'Clients - Luxora Motors')

@section('styles')

<style>

/* =========================================================
   PAGE
========================================================= */

.clients-page {
    max-width: 1250px;
    margin: 0 auto;
}


/* =========================================================
   HERO
========================================================= */

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


/* =========================================================
   ALERTES
========================================================= */

.alert {
    padding: 14px 18px;
    border-radius: 8px;
    margin-bottom: 22px;
    font-size: 13px;
}

.alert-success {
    color: #45e58a;
    background: rgba(69, 229, 138, .08);
    border: 1px solid rgba(69, 229, 138, .2);
}

.alert-error {
    color: #ff626a;
    background: rgba(229, 9, 20, .08);
    border: 1px solid rgba(229, 9, 20, .2);
}


/* =========================================================
   RECHERCHE
========================================================= */

.search-box {
    display: flex;
    gap: 10px;
    margin-bottom: 25px;
}

.search-box input {
    flex: 1;

    background: #0d0d0d;
    border: 1px solid #252525;

    color: white;

    padding: 13px 16px;

    border-radius: 8px;
    outline: none;
}

.search-box input:focus {
    border-color: #e50914;
}

.btn-search {
    border: none;

    background: #181818;
    color: #ddd;

    padding: 0 22px;

    border-radius: 8px;

    cursor: pointer;
    font-weight: 700;
}

.btn-search:hover {
    background: #252525;
    color: white;
}


/* =========================================================
   TABLEAU
========================================================= */

.table-card {
    background: #0d0d0d;

    border: 1px solid #222;
    border-radius: 14px;

    overflow: hidden;
}

.table-wrapper {
    overflow-x: auto;
}

.clients-table {
    width: 100%;
    border-collapse: collapse;

    min-width: 850px;
}

.clients-table th {
    text-align: left;

    color: #777;

    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 1px;

    padding: 17px 20px;

    background: #090909;

    border-bottom: 1px solid #222;
}

.clients-table td {
    padding: 17px 20px;

    color: #bbb;

    font-size: 13px;

    border-bottom: 1px solid #1c1c1c;
}

.clients-table tr:last-child td {
    border-bottom: none;
}

.clients-table tbody tr {
    transition: .2s;
}

.clients-table tbody tr:hover {
    background: #121212;
}


/* =========================================================
   CLIENT
========================================================= */

.client-name {
    display: flex;
    align-items: center;
    gap: 12px;
}

.avatar {
    width: 40px;
    height: 40px;
    min-width: 40px;

    border-radius: 50%;

    background: #181818;
    border: 1px solid #303030;

    color: #e50914;

    display: flex;
    align-items: center;
    justify-content: center;

    font-weight: 800;
}

.name-main {
    color: #fff;
    font-weight: 700;
}

.name-sub {
    color: #666;

    font-size: 11px;

    margin-top: 3px;
}

.email {
    color: #aaa;
}

.phone {
    color: #aaa;
}

.counter {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    min-width: 30px;

    padding: 5px 9px;

    background: #181818;

    border-radius: 6px;

    color: #ddd;

    font-size: 12px;
    font-weight: 700;
}


/* =========================================================
   ACTIONS
========================================================= */

.actions {
    display: flex;
    gap: 6px;
}

.action-btn {
    display: inline-flex;

    align-items: center;
    justify-content: center;

    padding: 8px 11px;

    border-radius: 6px;

    text-decoration: none;

    font-size: 11px;
    font-weight: 700;

    transition: .3s;

    border: 1px solid transparent;
}

.action-btn:hover {
    transform: translateY(-1px);
}


/* VOIR */

.action-btn:not(.edit):not(.delete) {
    color: #bbb;
    background: #181818;
    border-color: #252525;
}

.action-btn:not(.edit):not(.delete):hover {
    color: #fff;
    background: #252525;
}


/* MODIFIER */

.action-btn.edit {
    color: #ff626a;
    background: rgba(229, 9, 20, .08);
    border-color: rgba(229, 9, 20, .15);
}

.action-btn.edit:hover {
    color: white;
    background: #e50914;
}


/* SUPPRIMER */

.action-btn.delete {
    border: none;

    color: #999;
    background: #181818;

    cursor: pointer;
}

.action-btn.delete:hover {
    color: white;
    background: #e50914;
}


/* =========================================================
   ÉTAT VIDE
========================================================= */

.empty-state {
    text-align: center;
    padding: 70px 20px;
}

.empty-icon {
    font-size: 48px;
    margin-bottom: 15px;
}

.empty-state h3 {
    color: white;
    margin-bottom: 8px;
}

.empty-state p {
    color: #777;
    font-size: 13px;
}


/* =========================================================
   PAGINATION
========================================================= */

.pagination-container {
    padding: 22px;

    display: flex;
    justify-content: center;

    border-top: 1px solid #222;
}

.pagination-container nav {
    display: flex;
    gap: 5px;
}

.pagination-container a,
.pagination-container span {
    min-width: 35px;
    height: 35px;

    padding: 0 9px;

    display: inline-flex;

    align-items: center;
    justify-content: center;

    border-radius: 6px;

    background: #151515;

    border: 1px solid #252525;

    color: #aaa;

    text-decoration: none;

    font-size: 12px;
}

.pagination-container a:hover {
    color: white;
    border-color: #e50914;
}

.pagination-container span[aria-current="page"] {
    color: white;

    background: #e50914;

    border-color: #e50914;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 900px) {

    .hero {
        margin-left: -30px;
        margin-right: -30px;
        padding-left: 30px;
        padding-right: 30px;
    }

    .hero-button {
        right: 30px;
    }
}

@media (max-width: 700px) {

    .hero {
        min-height: 180px;

        margin-left: -20px;
        margin-right: -20px;

        padding: 30px 20px;
    }

    .hero h1 {
        font-size: 28px;
    }

    .hero-button {
        position: static;

        display: inline-block;

        margin-top: 15px;
    }

    .search-box {
        flex-direction: column;
    }

    .btn-search {
        height: 45px;
    }

    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 18px;
    }

}

</style>

@endsection


@section('content')

<div class="clients-page">


    {{-- =====================================================
         HERO
    ====================================================== --}}

    <div class="hero">

        <div class="hero-content">

            <div class="breadcrumb">

                Accueil &nbsp;›&nbsp;

                <span>
                    Clients
                </span>

            </div>

            <h1>
                Nos <span>clients</span>
            </h1>

            <p>
                Gérez les clients de votre concession automobile.
            </p>

            <div class="hero-line"></div>

        </div>


        <a
            href="{{ route('clients.create') }}"
            class="hero-button"
        >
            ＋ &nbsp; Ajouter un client
        </a>

    </div>


    {{-- =====================================================
         MESSAGES
    ====================================================== --}}

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


    {{-- =====================================================
         RECHERCHE
    ====================================================== --}}

    <form
        action="{{ route('clients.index') }}"
        method="GET"
        class="search-box"
    >

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Rechercher par nom, prénom, email ou téléphone..."
        >

        <button
            type="submit"
            class="btn-search"
        >
            🔎 Rechercher
        </button>

    </form>


    {{-- =====================================================
         TABLEAU
    ====================================================== --}}

    <div class="table-card">

        <div class="table-wrapper">

            <table class="clients-table">

                <thead>

                    <tr>

                        <th>
                            Client
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Téléphone
                        </th>

                        <th>
                            Ventes
                        </th>

                        <th>
                            Rendez-vous
                        </th>

                        <th>
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($clients as $client)

                        <tr>


                            {{-- CLIENT --}}

                            <td>

                                <div class="client-name">

                                    <div class="avatar">

                                        {{ strtoupper(
                                            substr($client->prenom, 0, 1)
                                            .
                                            substr($client->nom, 0, 1)
                                        ) }}

                                    </div>


                                    <div>

                                        <div class="name-main">

                                            {{ $client->prenom }}
                                            {{ $client->nom }}

                                        </div>

                                        <div class="name-sub">

                                            Client #{{ $client->id }}

                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- EMAIL --}}

                            <td>

                                <span class="email">

                                    {{ $client->email }}

                                </span>

                            </td>


                            {{-- TELEPHONE --}}

                            <td>

                                <span class="phone">

                                    {{ $client->telephone }}

                                </span>

                            </td>


                            {{-- VENTES --}}

                            <td>

                                <span class="counter">

                                    {{ $client->ventes_count }}

                                </span>

                            </td>


                            {{-- RENDEZ-VOUS --}}

                            <td>

                                <span class="counter">

                                    {{ $client->rendez_vous_count }}

                                </span>

                            </td>


                            {{-- ACTIONS --}}

                            <td>

                                <div class="actions">


                                    {{-- VOIR --}}

                                    <a
                                        href="{{ route('clients.show', $client) }}"
                                        class="action-btn"
                                        title="Voir"
                                    >

                                        👁

                                    </a>


                                    {{-- MODIFIER ET SUPPRIMER --}}

                                    @if(
                                        in_array(
                                            auth()->user()->role,
                                            [
                                                'administrateur',
                                                'gestionnaire'
                                            ]
                                        )
                                    )

                                        {{-- MODIFIER --}}

                                        <a
                                            href="{{ route('clients.edit', $client) }}"
                                            class="action-btn edit"
                                            title="Modifier"
                                        >

                                            ✎

                                        </a>


                                        {{-- SUPPRIMER --}}

                                        <form
                                            method="POST"
                                            action="{{ route('clients.destroy', $client) }}"
                                            onsubmit="return confirm('Voulez-vous vraiment supprimer ce client ?');"
                                            style="display:inline;"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-btn delete"
                                                title="Supprimer"
                                            >

                                                🗑

                                            </button>

                                        </form>

                                    @endif


                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="6">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        👤
                                    </div>

                                    <h3>
                                        Aucun client trouvé
                                    </h3>

                                    <p>
                                        Aucun client ne correspond à votre recherche.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}

        @if($clients->hasPages())

            <div class="pagination-container">

                {{ $clients->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
```
