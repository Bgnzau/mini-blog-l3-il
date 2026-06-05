<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Comment; 
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $articles = Post::limit(3)->orderByDesc('id')->get();

        $categories = Category::limit(5)->get();

        $totalArticles = Post::count();
        $totalCategories = Category::count();
        $totalComments = Comment::count();

        return view('public.index', compact('articles', 'categories', 'totalArticles', 'totalCategories', 'totalComments'));
    }

    public function articles()
    {
        $articles = Post::orderByDesc('id')->limit(10)->get();

        $categories = Category::all();

        $totalArticles = Post::count();
        $totalCategories = Category::count();
        $totalComments = Comment::count();

        return view('public.articles', compact('articles', 'categories', 'totalArticles', 'totalCategories', 'totalComments'));
    }

    public function categories()
  {
    $categories = Category::withCount('posts')->get();

    $totalArticles = Post::count();
    $totalCategories = $categories->count();
    $totalComments = Comment::count();

    return view('public.categories', compact('categories', 'totalArticles', 'totalCategories', 'totalComments'));
  }

  public function about()
  {
    // On récupère tous les utilisateurs pour la section Équipe
    $users = User::all();

    // On récupère toutes les statistiques réelles de la base de données
    $totalArticles = Post::count();
    $totalCategories = Category::count();
    $totalUsers = User::count();
    $totalComments = Comment::count();

    // On renvoie vers la vue public.about avec toutes nos variables
    return view('public.about', compact('users', 'totalArticles', 'totalCategories', 'totalUsers', 'totalComments'));
  }
}



