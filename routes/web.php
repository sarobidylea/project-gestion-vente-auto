<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MarqueController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientHomeController;
use App\Http\Controllers\ClientVehiculeController;
use App\Http\Controllers\ClientRendezVousController;
use App\Http\Controllers\ClientAuthController;
use App\Http\Controllers\ClientAccountController;
use App\Http\Controllers\AchatController;


/*
|--------------------------------------------------------------------------
| SITE PUBLIC / CLIENT
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| ACCUEIL CLIENT
|--------------------------------------------------------------------------
*/

Route::get('/', [ClientHomeController::class, 'index'])
    ->name('client.home');


/*
|--------------------------------------------------------------------------
| CATALOGUE CLIENT
|--------------------------------------------------------------------------
*/

Route::get('/catalogue', [ClientVehiculeController::class, 'index'])
    ->name('client.vehicules');

Route::get('/catalogue/{vehicule}', [ClientVehiculeController::class, 'show'])
    ->name('client.vehicule.show');


/*
|--------------------------------------------------------------------------
| CONTACT
|--------------------------------------------------------------------------
*/

Route::get('/contact', function () {
    return view('client.contact');
})->name('client.contact');


/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION CLIENT
|--------------------------------------------------------------------------
*/

Route::get('/client-login', [ClientAuthController::class, 'showLogin'])
    ->name('client.login');

Route::post('/client-login', [ClientAuthController::class, 'login'])
    ->name('client.login.post');

Route::get('/inscription', [ClientAuthController::class, 'showRegister'])
    ->name('client.register');

Route::post('/inscription', [ClientAuthController::class, 'register'])
    ->name('client.register.post');

Route::post('/client-logout', [ClientAuthController::class, 'logout'])
    ->name('client.logout');


/*
|--------------------------------------------------------------------------
| ACHAT EN LIGNE - COTE CLIENT
|--------------------------------------------------------------------------
|
| Accessible uniquement aux utilisateurs connectés.
|
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Étape 1 : Checkout
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/vehicules/{vehicule}/acheter',
        [AchatController::class, 'checkout']
    )->name('client.achat.checkout');


    /*
    |--------------------------------------------------------------------------
    | Étape 2 : Informations client
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/vehicules/{vehicule}/acheter',
        [AchatController::class, 'process']
    )->name('client.achat.process');


    /*
    |--------------------------------------------------------------------------
    | Étape 3 : Confirmation du paiement
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/vehicules/{vehicule}/acheter/confirmer',
        [AchatController::class, 'confirm']
    )->name('client.achat.confirm');


    /*
    |--------------------------------------------------------------------------
    | Étape 4 : Page de succès
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/achat/{achat}/confirmation',
        [AchatController::class, 'success']
    )->name('client.achat.success');


    /*
    |--------------------------------------------------------------------------
    | Historique des achats du client
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/mes-achats',
        [AchatController::class, 'index']
    )->name('client.achats.index');

});


/*
|--------------------------------------------------------------------------
| RENDEZ-VOUS CLIENT
|--------------------------------------------------------------------------
|
| Seul un utilisateur connecté avec le rôle "client"
| peut prendre un rendez-vous depuis le catalogue.
|
*/

Route::middleware(['auth', 'role:client'])->group(function () {

    Route::get(
        '/catalogue/{vehicule}/rendez-vous',
        [ClientRendezVousController::class, 'create']
    )->name('client.rendez-vous.create');

    Route::post(
        '/catalogue/{vehicule}/rendez-vous',
        [ClientRendezVousController::class, 'store']
    )->name('client.rendez-vous.store');

});


/*
|--------------------------------------------------------------------------
| COMPTE CLIENT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:client'])->group(function () {

    Route::get(
        '/mon-compte',
        [ClientAccountController::class, 'index']
    )->name('client.account');

});


/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| ADMINISTRATION
|--------------------------------------------------------------------------
|
| Toutes les routes administratives sont protégées par :
|
| 1. auth
| 2. admin.access
|
*/


Route::middleware(['auth', 'admin.access'])->group(function () {


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | VEHICULES ET MARQUES
    |--------------------------------------------------------------------------
    |
    | Administrateur + Gestionnaire
    |
    */

    Route::middleware('role:administrateur,gestionnaire')->group(function () {

        Route::resource(
            'vehicules',
            VehiculeController::class
        );

        Route::resource(
            'marques',
            MarqueController::class
        );

    });


    /*
    |--------------------------------------------------------------------------
    | CLIENTS
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/clients',
        [ClientController::class, 'index']
    )->name('clients.index');

    Route::get(
        '/clients/create',
        [ClientController::class, 'create']
    )->name('clients.create');

    Route::post(
        '/clients',
        [ClientController::class, 'store']
    )->name('clients.store');

    Route::get(
        '/clients/{client}',
        [ClientController::class, 'show']
    )->name('clients.show');


    /*
    |--------------------------------------------------------------------------
    | MODIFICATION / SUPPRESSION CLIENTS
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:administrateur,gestionnaire')->group(function () {

        Route::get(
            '/clients/{client}/edit',
            [ClientController::class, 'edit']
        )->name('clients.edit');

        Route::put(
            '/clients/{client}',
            [ClientController::class, 'update']
        )->name('clients.update');

        Route::delete(
            '/clients/{client}',
            [ClientController::class, 'destroy']
        )->name('clients.destroy');

    });


    /*
    |--------------------------------------------------------------------------
    | VENTES
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/ventes',
        [VenteController::class, 'index']
    )->name('ventes.index');

    Route::get(
        '/ventes/create',
        [VenteController::class, 'create']
    )->name('ventes.create');

    Route::post(
        '/ventes',
        [VenteController::class, 'store']
    )->name('ventes.store');

    Route::get(
        '/ventes/{vente}',
        [VenteController::class, 'show']
    )->name('ventes.show');

    Route::get(
        '/ventes/{vente}/facture',
        [VenteController::class, 'facture']
    )->name('ventes.facture');


    /*
    |--------------------------------------------------------------------------
    | MODIFICATION / SUPPRESSION DES VENTES
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:administrateur,gestionnaire')->group(function () {

        Route::get(
            '/ventes/{vente}/edit',
            [VenteController::class, 'edit']
        )->name('ventes.edit');

        Route::put(
            '/ventes/{vente}',
            [VenteController::class, 'update']
        )->name('ventes.update');

        Route::delete(
            '/ventes/{vente}',
            [VenteController::class, 'destroy']
        )->name('ventes.destroy');

    });


    /*
    |--------------------------------------------------------------------------
    | RENDEZ-VOUS ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/rendez-vous',
        [RendezVousController::class, 'index']
    )->name('rendez_vous.index');

    Route::get(
        '/rendez-vous/create',
        [RendezVousController::class, 'create']
    )->name('rendez_vous.create');

    Route::post(
        '/rendez-vous',
        [RendezVousController::class, 'store']
    )->name('rendez_vous.store');

    Route::get(
        '/rendez-vous/{rendezVous}',
        [RendezVousController::class, 'show']
    )->name('rendez_vous.show');


    /*
    |--------------------------------------------------------------------------
    | MODIFICATION / SUPPRESSION DES RENDEZ-VOUS
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:administrateur,gestionnaire')->group(function () {

        Route::get(
            '/rendez-vous/{rendezVous}/edit',
            [RendezVousController::class, 'edit']
        )->name('rendez_vous.edit');

        Route::put(
            '/rendez-vous/{rendezVous}',
            [RendezVousController::class, 'update']
        )->name('rendez_vous.update');

        Route::delete(
            '/rendez-vous/{rendezVous}',
            [RendezVousController::class, 'destroy']
        )->name('rendez_vous.destroy');

    });


    /*
    |--------------------------------------------------------------------------
    | PROFIL ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [ProfileController::class, 'show']
    )->name('profile');

    Route::get(
        '/profile/edit',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::put(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::get(
        '/profile/password',
        [ProfileController::class, 'passwordEdit']
    )->name('profile.password');

    Route::put(
        '/profile/password',
        [ProfileController::class, 'passwordUpdate']
    )->name('profile.password.update');


    /*
    |--------------------------------------------------------------------------
    | UTILISATEURS
    |--------------------------------------------------------------------------
    |
    | Administrateur uniquement
    |
    */

    Route::middleware('role:administrateur')->group(function () {

        Route::resource(
            'users',
            UserController::class
        );

    });

});