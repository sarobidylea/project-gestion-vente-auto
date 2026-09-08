<!DOCTYPE html>

<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'LUXORA MOTORS')
    </title>


    <!-- =========================================
         GOOGLE FONTS
    ========================================== -->

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    <style>

        /* =========================================
           RESET
        ========================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        html {
            scroll-behavior: smooth;
        }


        body {
            font-family: 'Montserrat', sans-serif;
            background: #080808;
            color: #ffffff;
            overflow-x: hidden;
        }


        a {
            color: inherit;
            text-decoration: none;
        }


        button,
        input,
        textarea,
        select {
            font-family: inherit;
        }


        /* =========================================
           NAVBAR
        ========================================== */

        .client-navbar {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;

            display: flex;
            justify-content: space-between;
            align-items: center;

            padding: 25px 6%;

            background:
                linear-gradient(
                    to bottom,
                    rgba(0, 0, 0, 0.80),
                    transparent
                );
        }


        /* =========================================
           LOGO
        ========================================== */

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;

            font-size: 22px;
            font-weight: 800;
            letter-spacing: 2px;

            white-space: nowrap;

            transition: 0.3s ease;
        }


        .logo:hover {
            opacity: 0.9;
        }


        .logo-icon {
            color: #e50914;
            font-size: 28px;

            transition: 0.3s ease;
        }


        .logo:hover .logo-icon {
            transform: rotate(45deg);
        }


        .logo span {
            color: #e50914;
        }


        /* =========================================
           NAVIGATION DESKTOP
        ========================================== */

        .nav-links {
            display: flex;
            align-items: center;

            gap: 30px;

            list-style: none;
        }


        .nav-links li {
            display: flex;
            align-items: center;
        }


        .nav-links a {
            position: relative;

            font-size: 13px;
            font-weight: 500;

            color: #ffffff;

            transition: 0.3s ease;
        }


        .nav-links a::after {
            content: '';

            position: absolute;

            left: 0;
            bottom: -8px;

            width: 0;
            height: 2px;

            background: #e50914;

            transition: width 0.3s ease;
        }


        .nav-links a:hover {
            color: #e50914;
        }


        .nav-links a:hover::after {
            width: 100%;
        }


        /* =========================================
           CONNEXION
        ========================================== */

        .nav-login {
            border:
                1px solid rgba(255,255,255,0.4);

            padding: 10px 18px;

            transition: 0.3s ease;
        }


        .nav-login:hover {
            border-color: #e50914;
            background: #e50914;

            color: #ffffff !important;
        }


        .nav-login::after {
            display: none;
        }


        /* =========================================
           INSCRIPTION / MON COMPTE
        ========================================== */

        .nav-account {
            border:
                1px solid rgba(255,255,255,0.35);

            padding: 10px 18px;

            transition: 0.3s ease;
        }


        .nav-account:hover {
            border-color: #e50914;
            background: #e50914;

            color: #ffffff !important;
        }


        .nav-account::after {
            display: none;
        }


        /* =========================================
           DECONNEXION
        ========================================== */

        .nav-logout {
            background: transparent;

            border: 1px solid #e50914;

            color: #ffffff;

            padding: 9px 16px;

            cursor: pointer;

            font-family: inherit;

            font-size: 12px;
            font-weight: 600;

            transition: 0.3s ease;
        }


        .nav-logout:hover {
            background: #e50914;
            color: #ffffff;
        }


        /* =========================================
           BOUTON HAMBURGER
        ========================================== */

        .mobile-menu-button {
            display: none;

            width: 45px;
            height: 45px;

            padding: 0;

            align-items: center;
            justify-content: center;

            flex-direction: column;

            gap: 5px;

            background: transparent;

            border:
                1px solid rgba(255,255,255,0.25);

            cursor: pointer;

            z-index: 1002;

            transition: 0.3s ease;
        }


        .mobile-menu-button:hover {
            border-color: #e50914;
        }


        .mobile-menu-button span {
            display: block;

            width: 20px;
            height: 2px;

            background: #ffffff;

            transition:
                transform 0.3s ease,
                opacity 0.3s ease,
                background 0.3s ease;
        }


        .mobile-menu-button:hover span {
            background: #e50914;
        }


        /* =========================================
           HAMBURGER → X
        ========================================== */

        .mobile-menu-button.active span:nth-child(1) {
            transform:
                translateY(7px)
                rotate(45deg);
        }


        .mobile-menu-button.active span:nth-child(2) {
            opacity: 0;
        }


        .mobile-menu-button.active span:nth-child(3) {
            transform:
                translateY(-7px)
                rotate(-45deg);
        }


        /* =========================================
           MENU MOBILE
        ========================================== */

        .mobile-nav {
            display: none;

            position: absolute;

            top: 80px;

            left: 5%;
            right: 5%;

            background:
                rgba(8,8,8,0.98);

            border:
                1px solid rgba(255,255,255,0.08);

            box-shadow:
                0 20px 50px rgba(0,0,0,0.45);

            padding: 15px;

            z-index: 1001;

            opacity: 0;

            transform:
                translateY(-10px);

            transition:
                opacity 0.3s ease,
                transform 0.3s ease;
        }


        .mobile-nav.active {
            display: block;

            opacity: 1;

            transform:
                translateY(0);
        }


        .mobile-nav ul {
            list-style: none;

            display: flex;

            flex-direction: column;

            gap: 0;
        }


        .mobile-nav li {
            border-bottom:
                1px solid rgba(255,255,255,0.07);
        }


        .mobile-nav li:last-child {
            border-bottom: none;
        }


        .mobile-nav a {
            display: block;

            padding: 15px 10px;

            color: #ffffff;

            font-size: 13px;
            font-weight: 500;

            transition:
                color 0.3s ease,
                padding-left 0.3s ease;
        }


        .mobile-nav a:hover {
            color: #e50914;

            padding-left: 18px;
        }


        /* =========================================
           BOUTON CONNEXION MOBILE
        ========================================== */

        .mobile-nav .mobile-login {
            margin-top: 12px;

            padding: 13px;

            text-align: center;

            border:
                1px solid rgba(255,255,255,0.3);

            transition: 0.3s ease;
        }


        .mobile-nav .mobile-login:hover {
            padding-left: 13px;

            color: #ffffff;

            background: #e50914;

            border-color: #e50914;
        }


        /* =========================================
           BOUTON INSCRIPTION / COMPTE MOBILE
        ========================================== */

        .mobile-nav .mobile-account {
            margin-top: 10px;

            padding: 13px;

            text-align: center;

            border:
                1px solid rgba(255,255,255,0.3);

            transition: 0.3s ease;
        }


        .mobile-nav .mobile-account:hover {
            padding-left: 13px;

            color: #ffffff;

            background: #e50914;

            border-color: #e50914;
        }


        /* =========================================
           DECONNEXION MOBILE
        ========================================== */

        .mobile-nav .mobile-logout {
            width: 100%;

            margin-top: 10px;

            padding: 13px;

            background: transparent;

            border:
                1px solid #e50914;

            color: #ffffff;

            cursor: pointer;

            font-size: 13px;
            font-weight: 600;

            transition: 0.3s ease;
        }


        .mobile-nav .mobile-logout:hover {
            background: #e50914;
            color: #ffffff;
        }


        /* =========================================
           OVERLAY MOBILE
        ========================================== */

        .mobile-overlay {
            display: none;

            position: fixed;

            inset: 0;

            background:
                rgba(0,0,0,0.55);

            z-index: 998;

            opacity: 0;

            transition: opacity 0.3s ease;
        }


        .mobile-overlay.active {
            display: block;

            opacity: 1;
        }


        /* =========================================
           MAIN
        ========================================== */

        main {
            min-height: 100vh;
        }


        /* =========================================
           FOOTER
        ========================================== */

        .client-footer {
            background: #050505;

            border-top:
                1px solid rgba(255,255,255,0.08);

            padding: 60px 6% 25px;
        }


        .footer-content {
            display: grid;

            grid-template-columns:
                2fr 1fr 1fr 1fr;

            gap: 50px;

            max-width: 1400px;

            margin: auto;
        }


        /* =========================================
           FOOTER BRAND
        ========================================== */

        .footer-brand h2 {
            font-size: 22px;

            letter-spacing: 2px;

            margin-bottom: 15px;
        }


        .footer-brand h2 span {
            color: #e50914;
        }


        .footer-brand p {
            max-width: 400px;

            color: #999;

            line-height: 1.8;

            font-size: 14px;
        }


        /* =========================================
           FOOTER COLUMNS
        ========================================== */

        .footer-column h3 {
            font-size: 14px;

            text-transform: uppercase;

            letter-spacing: 1px;

            margin-bottom: 20px;
        }


        .footer-column ul {
            list-style: none;
        }


        .footer-column li {
            margin-bottom: 12px;
        }


        .footer-column a {
            color: #888;

            font-size: 13px;

            transition: 0.3s ease;
        }


        .footer-column a:hover {
            color: #e50914;
        }


        /* =========================================
           FOOTER BOTTOM
        ========================================== */

        .footer-bottom {
            max-width: 1400px;

            margin: 45px auto 0;

            padding-top: 20px;

            border-top:
                1px solid rgba(255,255,255,0.08);

            display: flex;

            justify-content: space-between;

            align-items: center;

            color: #666;

            font-size: 12px;
        }


        /* =========================================
           RESPONSIVE — TABLET
        ========================================== */

        @media (max-width: 1000px) {

            .client-navbar {
                padding:
                    20px 5%;
            }


            .nav-links {
                gap: 18px;
            }


            .nav-links a {
                font-size: 11px;
            }


            .footer-content {
                grid-template-columns:
                    1fr 1fr;
            }

        }


        /* =========================================
           RESPONSIVE — MOBILE
        ========================================== */

        @media (max-width: 700px) {

            .client-navbar {
                position: absolute;

                padding:
                    18px 5%;
            }


            .logo {
                font-size: 17px;

                gap: 7px;
            }


            .logo-icon {
                font-size: 22px;
            }


            /* Cacher navigation desktop */

            .client-navbar > nav {
                display: none;
            }


            /* Afficher hamburger */

            .mobile-menu-button {
                display: flex;
            }


            /* Footer */

            .footer-content {
                grid-template-columns: 1fr;

                gap: 30px;
            }


            .footer-bottom {
                flex-direction: column;

                gap: 10px;

                text-align: center;
            }

        }


        /* =========================================
           TRES PETITS ECRANS
        ========================================== */

        @media (max-width: 400px) {

            .client-footer {
                padding:
                    45px 5% 20px;
            }


            .footer-brand h2 {
                font-size: 19px;
            }


            .footer-brand p {
                font-size: 13px;
            }


            .mobile-menu-button {
                width: 42px;

                height: 42px;
            }


            .mobile-nav {
                top: 75px;
            }

        }

    </style>


    @stack('styles')

</head>


<body>


    <!-- =========================================
         NAVBAR
    ========================================== -->

    <header class="client-navbar">


        <!-- LOGO -->

        <a
            href="{{ route('client.home') }}"
            class="logo"
        >

            <span class="logo-icon">
                ◆
            </span>

            LUXORA

            <span>
                MOTORS
            </span>

        </a>


        <!-- =====================================
             NAVIGATION DESKTOP
        ====================================== -->

        <nav>

            <ul class="nav-links">


                <!-- ACCUEIL -->

                <li>

                    <a
                        href="{{ route('client.home') }}"
                    >
                        Accueil
                    </a>

                </li>


                <!-- VEHICULES -->

                <li>

                    <a
                        href="{{ route('client.vehicules') }}"
                    >
                        Véhicules
                    </a>

                </li>


                <!-- MARQUES -->

                <li>

                    <a
                        href="{{ route('client.home') }}#marques"
                    >
                        Marques
                    </a>

                </li>


                <!-- SERVICES -->

                <li>

                    <a
                        href="{{ route('client.home') }}#services"
                    >
                        Services
                    </a>

                </li>


                <!-- A PROPOS -->

                <li>

                    <a
                        href="{{ route('client.home') }}#about"
                    >
                        À propos
                    </a>

                </li>


                <!-- CONTACT -->

                <li>

                    <a
                        href="{{ route('client.contact') }}"
                    >
                        Contact
                    </a>

                </li>


                <!-- =================================
                     UTILISATEUR NON CONNECTÉ
                ================================= -->

                @guest


                    <!-- CONNEXION -->

                    <li>

                        <a
                            href="{{ route('client.login') }}"
                            class="nav-login"
                        >
                            Connexion
                        </a>

                    </li>


                    <!-- INSCRIPTION -->

                    <li>

                        <a
                            href="{{ route('client.register') }}"
                            class="nav-account"
                        >
                            Inscription
                        </a>

                    </li>


                @else


                    <!-- =================================
                         UTILISATEUR CONNECTÉ
                    ================================= -->


                    <!-- MON COMPTE -->

                    <li>

                        <a
                            href="{{ route('client.account') }}"
                            class="nav-account"
                        >
                            Mon compte
                        </a>

                    </li>


                    <!-- DECONNEXION -->

                    <li>

                        <form
                            action="{{ route('client.logout') }}"
                            method="POST"
                            style="display:inline;"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="nav-logout"
                            >
                                Déconnexion
                            </button>

                        </form>

                    </li>


                @endguest


            </ul>

        </nav>


        <!-- =====================================
             BOUTON HAMBURGER
        ====================================== -->

        <button
            type="button"
            class="mobile-menu-button"
            id="mobileMenuButton"
            aria-label="Ouvrir le menu"
            aria-expanded="false"
        >

            <span></span>
            <span></span>
            <span></span>

        </button>

    </header>


    <!-- =========================================
         MENU MOBILE
    ========================================== -->

    <div
        class="mobile-nav"
        id="mobileNav"
    >

        <ul>


            <!-- ACCUEIL -->

            <li>

                <a
                    href="{{ route('client.home') }}"
                >
                    Accueil
                </a>

            </li>


            <!-- VEHICULES -->

            <li>

                <a
                    href="{{ route('client.vehicules') }}"
                >
                    Véhicules
                </a>

            </li>


            <!-- MARQUES -->

            <li>

                <a
                    href="{{ route('client.home') }}#marques"
                >
                    Marques
                </a>

            </li>


            <!-- SERVICES -->

            <li>

                <a
                    href="{{ route('client.home') }}#services"
                >
                    Services
                </a>

            </li>


            <!-- A PROPOS -->

            <li>

                <a
                    href="{{ route('client.home') }}#about"
                >
                    À propos
                </a>

            </li>


            <!-- CONTACT -->

            <li>

                <a
                    href="{{ route('client.contact') }}"
                >
                    Contact
                </a>

            </li>


            @guest


                <!-- CONNEXION -->

                <li>

                    <a
                        href="{{ route('client.login') }}"
                        class="mobile-login"
                    >
                        Connexion
                    </a>

                </li>


                <!-- INSCRIPTION -->

                <li>

                    <a
                        href="{{ route('client.register') }}"
                        class="mobile-account"
                    >
                        Inscription
                    </a>

                </li>


            @else


                <!-- MON COMPTE -->

                <li>

                    <a
                        href="{{ route('client.account') }}"
                        class="mobile-account"
                    >
                        Mon compte
                    </a>

                </li>


                <!-- DECONNEXION -->

                <li>

                    <form
                        action="{{ route('client.logout') }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="mobile-logout"
                        >
                            Déconnexion
                        </button>

                    </form>

                </li>


            @endguest


        </ul>

    </div>


    <!-- =========================================
         OVERLAY MOBILE
    ========================================== -->

    <div
        class="mobile-overlay"
        id="mobileOverlay"
    ></div>


    <!-- =========================================
         CONTENU PRINCIPAL
    ========================================== -->

    <main>

        @yield('content')

    </main>


    <!-- =========================================
         FOOTER
    ========================================== -->

    <footer class="client-footer">


        <div class="footer-content">


            <!-- BRAND -->

            <div class="footer-brand">

                <h2>

                    LUXORA

                    <span>
                        MOTORS
                    </span>

                </h2>


                <p>

                    Découvrez une sélection exceptionnelle
                    de véhicules premium.
                    Performance, élégance et excellence
                    au service de votre expérience automobile.

                </p>

            </div>


            <!-- NAVIGATION -->

            <div class="footer-column">

                <h3>
                    Navigation
                </h3>


                <ul>

                    <li>

                        <a
                            href="{{ route('client.home') }}"
                        >
                            Accueil
                        </a>

                    </li>


                    <li>

                        <a
                            href="{{ route('client.vehicules') }}"
                        >
                            Véhicules
                        </a>

                    </li>


                    <li>

                        <a
                            href="{{ route('client.home') }}#marques"
                        >
                            Marques
                        </a>

                    </li>

                </ul>

            </div>


            <!-- SERVICES -->

            <div class="footer-column">

                <h3>
                    Services
                </h3>


                <ul>

                    <li>

                        <a
                            href="{{ route('client.home') }}#services"
                        >
                            Vente automobile
                        </a>

                    </li>


                    <li>

                        <a
                            href="{{ route('client.home') }}#services"
                        >
                            Conseil personnalisé
                        </a>

                    </li>


                    <li>

                        <a
                            href="{{ route('client.home') }}#services"
                        >
                            Rendez-vous
                        </a>

                    </li>

                </ul>

            </div>


            <!-- CONTACT -->

            <div class="footer-column">

                <h3>
                    Contact
                </h3>


                <ul>

                    <li>

                        <a
                            href="{{ route('client.contact') }}"
                        >
                            Fianarantsoa
                        </a>

                    </li>


                    <li>

                        <a
                            href="{{ route('client.contact') }}"
                        >
                            Nous contacter
                        </a>

                    </li>

                </ul>

            </div>


        </div>


        <!-- =================================
             FOOTER BOTTOM
        ================================= -->

        <div class="footer-bottom">

            <span>

                © {{ date('Y') }}

                LUXORA MOTORS.

                Tous droits réservés.

            </span>


            <span>

                Performance without compromise.

            </span>

        </div>


    </footer>


    <!-- =========================================
         JAVASCRIPT MENU MOBILE
    ========================================== -->

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const button =
                    document.getElementById(
                        'mobileMenuButton'
                    );

                const menu =
                    document.getElementById(
                        'mobileNav'
                    );

                const overlay =
                    document.getElementById(
                        'mobileOverlay'
                    );


                /*
                 * Vérification
                 */

                if (
                    !button ||
                    !menu ||
                    !overlay
                ) {
                    return;
                }


                /*
                 * OUVRIR / FERMER LE MENU
                 */

                button.addEventListener(
                    'click',
                    function () {

                        const isOpen =
                            menu.classList.contains(
                                'active'
                            );


                        if (isOpen) {

                            closeMenu();

                        } else {

                            openMenu();

                        }

                    }
                );


                /*
                 * OUVRIR
                 */

                function openMenu() {

                    menu.classList.add(
                        'active'
                    );

                    overlay.classList.add(
                        'active'
                    );

                    button.classList.add(
                        'active'
                    );

                    button.setAttribute(
                        'aria-expanded',
                        'true'
                    );

                    button.setAttribute(
                        'aria-label',
                        'Fermer le menu'
                    );

                    document.body.style.overflow =
                        'hidden';

                }


                /*
                 * FERMER
                 */

                function closeMenu() {

                    menu.classList.remove(
                        'active'
                    );

                    overlay.classList.remove(
                        'active'
                    );

                    button.classList.remove(
                        'active'
                    );

                    button.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                    button.setAttribute(
                        'aria-label',
                        'Ouvrir le menu'
                    );

                    document.body.style.overflow =
                        '';

                }


                /*
                 * FERMER EN CLIQUANT
                 * SUR L'OVERLAY
                 */

                overlay.addEventListener(
                    'click',
                    function () {

                        closeMenu();

                    }
                );


                /*
                 * FERMER APRÈS CLIC
                 * SUR UN LIEN
                 */

                const links =
                    menu.querySelectorAll(
                        'a'
                    );


                links.forEach(
                    function (link) {

                        link.addEventListener(
                            'click',
                            function () {

                                closeMenu();

                            }
                        );

                    }
                );


                /*
                 * TOUCHE ESC
                 */

                document.addEventListener(
                    'keydown',
                    function (event) {

                        if (
                            event.key === 'Escape'
                        ) {

                            closeMenu();

                        }

                    }
                );


                /*
                 * SI LA FENÊTRE REPASSE
                 * EN DESKTOP
                 */

                window.addEventListener(
                    'resize',
                    function () {

                        if (
                            window.innerWidth > 700
                        ) {

                            closeMenu();

                        }

                    }
                );

            }
        );

    </script>


    @stack('scripts')


</body>

</html>