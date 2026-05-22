<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    /** Route : GET / — nom : home — Vue : public/index.blade.php */
    public function index()
    {
        return view('public.index');
    }

    /** Route : GET /articles — nom : articles.index */
    public function articles()
    {
        return view('public.articles');
    }

    /**
     * Route : GET /articles/{slug} — nom : articles.show
     
     */
    public function article(string $slug)
    {
       
        return view('public.article', compact('slug'));
    }

    /** Route : GET /categories — nom : categories.index */
    public function categories()
    {
        return view('public.categories');
    }

    /** Route : GET /about — nom : about */
    public function about()
    {
        return view('public.about');
    }
}
