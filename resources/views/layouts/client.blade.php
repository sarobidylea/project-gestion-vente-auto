<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'LUXORA MOTORS')</title>


    <!-- Google Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    <style>

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


        /* =========================
           NAVBAR
        ========================= */

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

            background: linear-gradient(
                to bottom,
                rgba(0, 0, 0, 0.75),
                transparent
            );
        }


        /* =========================
           LOGO
        ========================= */

        .logo {

            display: flex;

            align-items: center;

            gap: 10px;

            font-size: 22px;

            font-weight: 800;

            letter-spacing: 2px;
        }


        .logo-icon {

            color: #e50914;

            font-size: 28px;
        }


        .logo span {

            color: #e50914;
        }


        /* =========================
           NAVIGATION
        ========================= */

        .nav-links {

            display: flex;

            align-items: center;

            gap: 30px;

            list-style: none;
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


        /* =========================
           CONNEXION
        ========================= */

        .nav-login {

            border: 1px solid rgba(255,255,255,0.4);

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


        /* =========================
           MON COMPTE
        ========================= */

        .nav-account {

            border: 1px solid rgba(255,255,255,0.35);

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


        /* =========================
           DECONNEXION
        ========================= */

        .nav-logout {

            background: transparent;

            border: 1px solid #e50914;

            color: #ffffff;

            padding: 9px 16px;

            cursor: pointer;

            font-family: inherit;

            font-size: 12px;

            font-weight: 600;

            transition: 0.3s;
        }


        .nav-logout:hover {

            background: #e50914;
        }


        /* =========================
           MAIN
        ========================= */

        main {

            min-height: 100vh;
        }


        /* =========================
           FOOTER
        ========================= */

        .client-footer {

            background: #050505;

            border-top: 1px solid rgba(255,255,255,0.08);

            padding: 60px 6% 25px;
        }


        .footer-content {

            display: grid;

            grid-template-columns: 2fr 1fr 1fr 1fr;

            gap: 50px;

            max-width: 1400px;

            margin: auto;
        }


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


        .footer-bottom {

            max-width: 1400px;

            margin: 45px auto 0;

            padding-top: 20px;

            border-top: 1px solid rgba(255,255,255,0.08);

            display: flex;

            justify-content: space-between;

            align-items: center;

            color: #666;

            font-size: 12px;
        }


        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 900px) {

            .client-navbar {

                padding: 20px 5%;
            }


            .nav-links {

                gap: 15px;
            }


            .nav-links a {

                font-size: 11px;
            }


            .footer-content {

                grid-template-columns: 1fr 1fr;
            }
        }


        @media (max-width: 650px) {

            .client-navbar {

                position: absolute;

                padding: 18px 5%;
            }


            .logo {

                font-size: 17px;
            }


            .logo-icon {

                font-size: 22px;
            }


            .nav-links {

                display: none;
            }


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

    </style>


    @stack('styles')

</head>


<body>


    <!-- =========================
         NAVBAR
    ========================= -->

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


        <!-- NAVIGATION -->

        <nav>

            <ul class="nav-links">


                <!-- ACCUEIL -->

                <li>

                    <a href="{{ route('client.home') }}">

                        Accueil

                    </a>

                </li>


                <!-- VEHICULES -->

                <li>

                    <a href="{{ route('client.vehicules') }}">

                        Véhicules

                    </a>

                </li>


                <!-- MARQUES -->

                <li>

                    <a href="{{ route('client.home') }}#marques">

                        Marques

                    </a>

                </li>


                <!-- SERVICES -->

                <li>

                    <a href="{{ route('client.home') }}#services">

                        Services

                    </a>

                </li>


                <!-- A PROPOS -->

                <li>

                    <a href="{{ route('client.home') }}#about">

                        À propos

                    </a>

                </li>


                <!-- CONTACT -->

                <li>

                    <a href="{{ route('client.home') }}#contact">

                        Contact

                    </a>

                </li>


                <!-- =========================
                     UTILISATEUR NON CONNECTÉ
                ========================= -->

                @guest

                    <li>

                        <a
                            href="{{ route('client.login') }}"
                            class="nav-login"
                        >

                            Connexion

                        </a>

                    </li>


                    <li>

                        <a
                            href="{{ route('client.register') }}"
                            class="nav-account"
                        >

                            Inscription

                        </a>

                    </li>


                @else


                    <!-- =========================
                         MON COMPTE
                    ========================= -->

                    <li>

                        <a
                            href="{{ route('client.account') }}"
                            class="nav-account"
                        >

                            Mon compte

                        </a>

                    </li>


                    <!-- =========================
                         DECONNEXION
                    ========================= -->

                    <li>

                        <form
                            action="{{ route('client.logout') }}"
                            method="POST"
                            style="display: inline;"
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

    </header>


    <!-- =========================
         CONTENU
    ========================= -->

    <main>

        @yield('content')

    </main>


    <!-- =========================
         FOOTER
    ========================= -->

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

                        <a href="{{ route('client.home') }}">

                            Accueil

                        </a>

                    </li>


                    <li>

                        <a href="{{ route('client.vehicules') }}">

                            Véhicules

                        </a>

                    </li>


                    <li>

                        <a href="{{ route('client.home') }}#marques">

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

                        <a href="{{ route('client.home') }}#services">

                            Vente automobile

                        </a>

                    </li>


                    <li>

                        <a href="{{ route('client.home') }}#services">

                            Conseil personnalisé

                        </a>

                    </li>


                    <li>

                        <a href="{{ route('client.home') }}#services">

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

                        <a href="{{ route('client.home') }}#contact">

                            Fianarantsoa

                        </a>

                    </li>


                    <li>

                        <a href="{{ route('client.home') }}#contact">

                            Nous contacter

                        </a>

                    </li>

                </ul>

            </div>


        </div>


        <!-- FOOTER BOTTOM -->

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


    @stack('scripts')


</body>

</html>

