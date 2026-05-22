{{--
    EXERCICE — Question 2 : Composant Blade anonyme — en-tête public
    Inclus dans app.blade.php via @include('components.header').
    Question 7 : liens de navigation nommés avec route() et classe active dynamique.
--}}
<nav>
    <a href="{{ route('home') }}" class="nav-logo">Le Blog</a>
    <ul class="nav-links">
        {{-- request()->routeIs() : ajoute "active" si on est sur la route correspondante --}}
        <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a></li>
        <li><a href="{{ route('articles.index') }}" class="{{ request()->routeIs('articles.*') ? 'active' : '' }}">Articles</a></li>
        <li><a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">Catégories</a></li>
        <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">À propos</a></li>
        <li><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    </ul>
</nav>
