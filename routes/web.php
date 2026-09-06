<?php

use App\Http\Controllers\MarqueController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;



/*
|--------------------------------------------------------------------------
| AUTHENTIFICATION
|--------------------------------------------------------------------------
*/

// Page de connexion
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

// Traitement de la connexion
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

// Déconnexion
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| ADMINISTRATION
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Véhicules
    Route::middleware('role:administrateur,gestionnaire')->group(function () {
        Route::resource('vehicules', VehiculeController::class);
        Route::resource('marques', MarqueController::class);
    });

    // Clients
    Route::get('/clients', [ClientController::class, 'index'])
    ->name('clients.index');

    Route::get('/clients/create', [ClientController::class, 'create'])
    ->name('clients.create');

    Route::post('/clients', [ClientController::class, 'store'])
    ->name('clients.store');

    Route::get('/clients/{client}', [ClientController::class, 'show'])
    ->name('clients.show');

    Route::middleware('role:administrateur,gestionnaire')->group(function () {

    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])
        ->name('clients.edit');

    Route::put('/clients/{client}', [ClientController::class, 'update'])
        ->name('clients.update');

    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])
        ->name('clients.destroy');


    });

    // Ventes
    Route::get('/ventes', [VenteController::class, 'index'])
        ->name('ventes.index');

    Route::get('/ventes/create', [VenteController::class, 'create'])
        ->name('ventes.create');

    Route::post('/ventes', [VenteController::class, 'store'])
        ->name('ventes.store');

    Route::get('/ventes/{vente}', [VenteController::class, 'show'])
        ->name('ventes.show');

    Route::middleware('role:administrateur,gestionnaire')->group(function () {
    Route::get('/ventes/{vente}/edit', [VenteController::class, 'edit'])
        ->name('ventes.edit');

        
    Route::put('/ventes/{vente}', [VenteController::class, 'update'])
            ->name('ventes.update');

    Route::delete('/ventes/{vente}', [VenteController::class, 'destroy'])
            ->name('ventes.destroy');


    });


    // Rendez-vous
    Route::get('/rendez-vous', [RendezVousController::class, 'index'])
    ->name('rendez_vous.index');

    Route::get('/rendez-vous/create', [RendezVousController::class, 'create'])
    ->name('rendez_vous.create');

    Route::post('/rendez-vous', [RendezVousController::class, 'store'])
    ->name('rendez_vous.store');

    Route::get('/rendez-vous/{rendezVous}', [RendezVousController::class, 'show'])
    ->name('rendez_vous.show');

    Route::middleware('role:administrateur,gestionnaire')->group(function () {

    
    Route::get('/rendez-vous/{rendezVous}/edit', [RendezVousController::class, 'edit'])
        ->name('rendez_vous.edit');

    Route::put('/rendez-vous/{rendezVous}', [RendezVousController::class, 'update'])
        ->name('rendez_vous.update');

    Route::delete('/rendez-vous/{rendezVous}', [RendezVousController::class, 'destroy'])
        ->name('rendez_vous.destroy');

    });


    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');
        
    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
        
    Route::get('/profile/password', [ProfileController::class, 'passwordEdit'])
        ->name('profile.password');
        
    Route::put('/profile/password', [ProfileController::class, 'passwordUpdate'])
        ->name('profile.password.update');
    
    Route::middleware('role:administrateur')->group(function () {
        Route::resource('users', UserController::class);
            });
            

        
});

Route::get('/profile', [ProfileController::class, 'show'])
    ->name('profile');



