<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Routes Publiques
|--------------------------------------------------------------------------
*/
Route::get('/', [MainController::class, 'index'])->name('home');
// Correction ici : 'articles' au lieu de 'articles.index'
Route::get('/articles', [MainController::class, 'articles'])->name('articles');
Route::get('/articles/{slug}', [MainController::class, 'article'])->name('article');
// Correction ici : 'categories' au lieu de 'categories.index'
Route::get('/categories', [MainController::class, 'categories'])->name('categories');
Route::get('/about', [MainController::class, 'about'])->name('about');

/*
|--------------------------------------------------------------------------
| Routes Dashboard (Groupées)
|--------------------------------------------------------------------------
*/
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    
    // Correction ici : 'posts' au lieu de 'articles' pour matcher la sidebar du prof
    Route::get('/articles', [DashboardController::class, 'articles'])->name('posts');
    
    Route::get('/categories', [DashboardController::class, 'categories'])->name('categories');
    Route::get('/utilisateurs', [DashboardController::class, 'users'])->name('users');
    Route::get('/commentaires', [DashboardController::class, 'comments'])->name('comments');
    Route::get('/reglages', [DashboardController::class, 'settings'])->name('settings');
});