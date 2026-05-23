<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() { return view('public.index'); }
    public function articles() { return view('public.articles'); }
    public function article($slug) { return view('public.article', compact('slug')); }
    public function categories() { return view('public.categories'); }
    public function about() { return view('public.about'); }
}