<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| EXERCICE — Question 4 : Routes de la partie PUBLIQUE
| Chaque route est nommée avec ->name() pour pouvoir utiliser route() dans Blade.
| Route::get() = afficher une page (lecture). Route::post() servirait à envoyer
| un formulaire (création / modification) — non utilisé ici (pages statiques).
|--------------------------------------------------------------------------
*/
Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/articles', [MainController::class, 'articles'])->name('articles.index');
// Paramètre dynamique {slug} : transmis à MainController::article($slug)
Route::get('/articles/{slug}', [MainController::class, 'article'])->name('articles.show');
Route::get('/categories', [MainController::class, 'categories'])->name('categories.index');
Route::get('/about', [MainController::class, 'about'])->name('about');

/*
|--------------------------------------------------------------------------
| EXERCICE — Question 5 : Groupe de routes du DASHBOARD
| prefix('dashboard')  → toutes les URL commencent par /dashboard
| name('dashboard.')   → tous les noms commencent par dashboard. (ex. dashboard.index)
|--------------------------------------------------------------------------
*/
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/articles', [DashboardController::class, 'articles'])->name('articles');
    Route::get('/categories', [DashboardController::class, 'categories'])->name('categories');
    Route::get('/utilisateurs', [DashboardController::class, 'users'])->name('users');
    Route::get('/commentaires', [DashboardController::class, 'comments'])->name('comments');
    Route::get('/reglages', [DashboardController::class, 'settings'])->name('settings');
});
