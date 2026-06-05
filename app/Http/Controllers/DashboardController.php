<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Page d'accueil du Dashboard (Statistiques)
     */
    public function index()
    {
        $totalArticles = Post::count();
        $totalCategories = Category::count();
        $totalComments = Comment::count();
        $totalUsers = User::count();
        
        $recentPosts = Post::latest()->take(7)->get();

        return view('dashboard.index', compact('totalArticles', 'totalCategories', 'totalComments', 'totalUsers', 'recentPosts'));
    }

    /**
     * Liste des articles dans le Dashboard
     */
    public function articles()
    {
        // On récupère tous les articles paginés par 10 avec leurs relations
        $articles = Post::with(['category', 'user'])->latest()->paginate(10);
        
        return view('dashboard.articles', compact('articles'));
    }

    /**
     * Liste des catégories dans le Dashboard
     */
    public function categories()
    {
        $categories = Category::withCount('posts')->latest()->get();
        return view('dashboard.categories', compact('categories'));
    }

    /**
     * Liste des commentaires dans le Dashboard
     */
    public function comments()
    {
        $comments = Comment::with(['post', 'user'])->latest()->paginate(15);
        return view('dashboard.comments', compact('comments'));
    }
}