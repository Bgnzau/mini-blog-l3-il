<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController; // Importé pour gérer le dashboard
use Illuminate\Support\Facades\Route;

// --- ROUTES PUBLIQUES ---
Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/articles', [MainController::class, 'articles'])->name('articles.index');
Route::get('/categories', [MainController::class, 'categories'])->name('categories.index');
Route::get('/articles/{id}', [MainController::class, 'articles'])->name('articles.show');
Route::get('/about', [MainController::class, 'about'])->name('about');


// --- DASHBOARD (Sécurisé par Auth) ---
Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    
    // Accueil du dashboard (Statistiques)
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard.index');

    // Pages de gestion du Dashboard
    Route::get('/articles', [DashboardController::class, 'articles'])->name('dashboard.articles');
    Route::get('/categories', [DashboardController::class, 'categories'])->name('dashboard.categories');
    Route::get('/comments', [DashboardController::class, 'comments'])->name('dashboard.comments');

});


// --- GESTION DES UTILISATEURS (CRUD complet via Resource) ---
Route::resource('users', UserController::class)->middleware(['auth', 'verified']);


// --- PROFIL UTILISATEUR ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';