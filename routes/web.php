<?php

use App\Http\Controllers\MarqueController;
use App\Http\Controllers\VehiculeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\VenteController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('vehicules', VehiculeController::class);

Route::resource('marques', MarqueController::class);

Route::resource('clients', ClientController::class);

Route::resource('ventes', VenteController::class);
