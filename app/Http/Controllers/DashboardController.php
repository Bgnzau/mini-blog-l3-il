<?php

namespace App\Http\Controllers;


class DashboardController extends Controller
{
    /* Route : GET /dashboard — nom : dashboard.index */
    public function index()
    {
        return view('dashboard.index');
    }

    /* Route : GET /dashboard/articles — nom : dashboard.articles */
    public function articles()
    {
        return view('dashboard.articles');
    }

    /* Route : GET /dashboard/categories — nom : dashboard.categories */
    public function categories()
    {
        return view('dashboard.categories');
    }

    /* Route : GET /dashboard/utilisateurs — nom : dashboard.users */
    public function users()
    {
        return view('dashboard.users');
    }

    /* Route : GET /dashboard/commentaires — nom : dashboard.comments */
    public function comments()
    {
        return view('dashboard.comments');
    }

    /* Route : GET /dashboard/reglages — nom : dashboard.settings */
    public function settings()
    {
        return view('dashboard.settings');
    }
}
