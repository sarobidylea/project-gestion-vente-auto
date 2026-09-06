<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">

```
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title', 'Luxora Motors')</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
    rel="stylesheet"
>

<style>

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: 'Inter', Arial, sans-serif;
        background: #050505;
        color: #fff;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    /* ================= SIDEBAR ================= */

    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        width: 272px;
        height: 100vh;
        background: #070707;
        border-right: 1px solid #242424;
        display: flex;
        flex-direction: column;
        z-index: 100;
    }

    /* ================= LOGO ================= */

    .logo {
        height: 115px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-bottom: 1px solid #171717;
    }

    .logo-content {
        text-align: center;
    }

    .logo-car {
        width: 105px;
        height: 35px;
        margin: auto;
        border-top: 3px solid #e50914;
        border-radius: 50%;
        position: relative;
    }

    .logo-car::after {
        content: "";
        position: absolute;
        left: 10px;
        right: 10px;
        bottom: -4px;
        height: 3px;
        background: #e50914;
    }

    .logo-name {
        font-size: 24px;
        font-weight: 800;
        letter-spacing: 1px;
        margin-top: -12px;
    }

    .logo-name span {
        color: #e50914;
        display: block;
        font-size: 13px;
        letter-spacing: 5px;
    }

    /* ================= MENU ================= */

    .menu {
        padding: 30px 16px;
        overflow-y: auto;
    }

    .menu-title {
        color: #555;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin: 0 0 15px 15px;
    }

    .menu-link {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 14px 16px;
        margin-bottom: 7px;
        color: #aaa;
        border-radius: 8px;
        transition: .2s;
        font-size: 14px;
    }

    .menu-link:hover {
        background: #171717;
        color: white;
    }

    .menu-link.active {
        background: linear-gradient(90deg, #7c0008, #4c0005);
        color: white;
        box-shadow: inset 3px 0 0 #ff1522;
    }

    .menu-link.active .menu-icon {
        color: #ff1522;
    }

    .menu-icon {
        width: 23px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ddd;
        flex-shrink: 0;
    }

    .menu-icon svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        fill: none;
    }

    /* ================= SIDEBAR BOTTOM ================= */

    .sidebar-bottom {
        margin-top: auto;
        border-top: 1px solid #1c1c1c;
        padding: 20px 16px;
    }

    .admin {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .admin-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #85000a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        flex-shrink: 0;
    }

    .admin-name {
        font-size: 14px;
        font-weight: 600;
    }

    .admin-role {
        color: #777;
        font-size: 11px;
        margin-top: 3px;
    }

    .logout {
        width: 100%;
        display: flex;
        align-items: center;
        gap: 12px;
        color: #aaa;
        background: transparent;
        border: none;
        padding: 10px;
        font-size: 13px;
        font-family: inherit;
        cursor: pointer;
        text-align: left;
        transition: .2s;
    }

    .logout:hover {
        color: #ff1522;
        background: #171717;
        border-radius: 8px;
    }

    /* ================= MAIN ================= */

    .main {
        margin-left: 272px;
        min-height: 100vh;
    }

    /* ================= TOPBAR ================= */

    .topbar {
        height: 62px;
        border-bottom: 1px solid #202020;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 42px;
        background: rgba(5, 5, 5, .95);
    }

    .search-top {
        width: 395px;
        height: 38px;
        background: #111416;
        border: 1px solid #20262a;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0 15px;
        color: #777;
        font-size: 12px;
    }

    .top-actions {
        display: flex;
        align-items: center;
        gap: 25px;
    }

    .notification {
        position: relative;
        font-size: 19px;
    }

    .notification-dot {
        position: absolute;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #ff1522;
        top: 0;
        right: -2px;
    }

    .profile {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
    }

    .profile-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: #89000a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }

    /* ================= CONTENT ================= */

    .content {
        padding: 0 42px 40px;
    }

    /* ================= RESPONSIVE ================= */

    @media (max-width: 1000px) {

        .sidebar {
            width: 80px;
        }

        .logo-name,
        .menu-title,
        .menu-link span,
        .admin-info,
        .logout span {
            display: none;
        }

        .logo-car {
            width: 45px;
        }

        .menu-link {
            justify-content: center;
        }

        .main {
            margin-left: 80px;
        }
    }

    @media (max-width: 700px) {

        .topbar {
            padding: 0 15px;
        }

        .search-top {
            width: 220px;
        }

        .content {
            padding: 0 15px 30px;
        }
    }

</style>

@yield('styles')
```

</head>

<body>

```
<!-- ================= SIDEBAR ================= -->

<aside class="sidebar">

    <!-- LOGO -->

    <div class="logo">

        <div class="logo-content">

            <div class="logo-car"></div>

            <div class="logo-name">
                LUXORA
                <span>MOTORS</span>
            </div>

        </div>

    </div>


    <!-- MENU -->

    <nav class="menu">

        <p class="menu-title">
            Menu principal
        </p>


        <!-- ================= DASHBOARD ================= -->

        <a
            href="{{ route('dashboard') }}"
            class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
        >

            <div class="menu-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M3 12l9-9 9 9"/>
                    <path d="M5 10v10h14V10"/>
                </svg>

            </div>

            <span>
                Tableau de bord
            </span>

        </a>


        <!-- ================= VEHICULES ================= -->

        @auth

            @if(in_array(auth()->user()->role, ['administrateur', 'gestionnaire']))

                <a
                    href="{{ route('vehicules.index') }}"
                    class="menu-link {{ request()->routeIs('vehicules.*') ? 'active' : '' }}"
                >

                    <div class="menu-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M5 17h-2v-6l2-5h9l4 5h1a2 2 0 0 1 2 2v4h-2"/>
                            <path d="M9 17h6"/>
                            <circle cx="7.5" cy="17" r="2"/>
                            <circle cx="16.5" cy="17" r="2"/>
                        </svg>

                    </div>

                    <span>
                        Véhicules
                    </span>

                </a>


                <!-- ================= MARQUES ================= -->

                <a
                    href="{{ route('marques.index') }}"
                    class="menu-link {{ request()->routeIs('marques.*') ? 'active' : '' }}"
                >

                    <div class="menu-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>

                    </div>

                    <span>
                        Marques
                    </span>

                </a>

            @endif

        @endauth


        <!-- ================= CLIENTS ================= -->

        <a
            href="{{ route('clients.index') }}"
            class="menu-link {{ request()->routeIs('clients.*') ? 'active' : '' }}"
        >

            <div class="menu-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4 21v-1a8 8 0 0 1 16 0v1"/>
                </svg>

            </div>

            <span>
                Clients
            </span>

        </a>


        <!-- ================= VENTES ================= -->

        <a
            href="{{ route('ventes.index') }}"
            class="menu-link {{ request()->routeIs('ventes.*') ? 'active' : '' }}"
        >

            <div class="menu-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <circle cx="9" cy="21" r="1.3"/>
                    <circle cx="18" cy="21" r="1.3"/>
                    <path d="M2 2h3l2.4 12.4a2 2 0 0 0 2 1.6h8.6a2 2 0 0 0 2-1.6L22 6H6"/>
                </svg>

            </div>

            <span>
                Ventes
            </span>

        </a>


        <!-- ================= RENDEZ-VOUS ================= -->

        <a
            href="{{ route('rendez_vous.index') }}"
            class="menu-link {{ request()->routeIs('rendez_vous.*') ? 'active' : '' }}"
        >

            <div class="menu-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <rect x="3" y="5" width="18" height="16" rx="2"/>
                    <path d="M3 10h18"/>
                    <path d="M8 3v4"/>
                    <path d="M16 3v4"/>
                </svg>

            </div>

            <span>
                Rendez-vous
            </span>

        </a>


        <!-- ================= UTILISATEURS ================= -->

        @auth

            @if(auth()->user()->role === 'administrateur')

                <a
                    href="{{ route('users.index') }}"
                    class="menu-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
                >

                    <div class="menu-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M3 21v-1a6 6 0 0 1 12 0v1"/>
                            <path d="M16 11a4 4 0 0 1 5 4v1"/>
                            <path d="M16 3a4 4 0 0 1 0 8"/>
                        </svg>

                    </div>

                    <span>
                        Utilisateurs
                    </span>

                </a>

            @endif

        @endauth

    </nav>


    <!-- ================= SIDEBAR BOTTOM ================= -->

    <div class="sidebar-bottom">

        @auth

            <!-- PROFIL -->

            <div class="admin">

                <div class="admin-avatar">

                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                </div>

                <div class="admin-info">

                    <div class="admin-name">
                        {{ auth()->user()->name }}
                    </div>

                    <div class="admin-role">
                        {{ ucfirst(auth()->user()->role) }}
                    </div>

                </div>

            </div>


            <!-- MON PROFIL -->

            <a
                href="{{ route('profile') }}"
                class="logout"
            >

                <span>
                    👤
                </span>

                <span>
                    Mon profil
                </span>

            </a>


            <!-- DECONNEXION -->

            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="logout"
                >

                    <span>
                        ↪
                    </span>

                    <span>
                        Se déconnecter
                    </span>

                </button>

            </form>

        @endauth

    </div>

</aside>


<!-- ================= MAIN ================= -->

<main class="main">

    <!-- TOPBAR -->

    <header class="topbar">

        <div class="search-top">

            🔍

            <span>
                Rechercher un véhicule...
            </span>

        </div>


        <div class="top-actions">

            <div class="notification">

                ♧

                <span class="notification-dot"></span>

            </div>


            @auth

                <div class="profile">

                    <div class="profile-avatar">

                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                    </div>

                    <span>
                        {{ auth()->user()->name }}
                    </span>

                    <span>
                        ⌄
                    </span>

                </div>

            @endauth

        </div>

    </header>


    <!-- CONTENT -->

    <section class="content">

        @yield('content')

    </section>

</main>
```

</body>

</html>
