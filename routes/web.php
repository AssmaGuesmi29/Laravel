<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController; // Ajoutez cette ligne

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes pour les utilisateurs
Route::resource('users', UserController::class);
