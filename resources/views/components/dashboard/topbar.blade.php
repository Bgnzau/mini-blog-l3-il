{{--
    EXERCICE — Question 3 : Composant topbar du dashboard
    @yield('page_title') : titre affiché dans la barre (défini par chaque vue enfant).
    @yield('topbar_actions') : boutons optionnels (ex. "+ Nouvel article").
    Question 7 : lien "Voir le blog" vers la partie publique (route home).
--}}
<div class="topbar">
    <div class="topbar-title">@yield('page_title', 'Dashboard')</div>
    <div class="topbar-actions" style="display:flex;gap:0.8rem;align-items:center">
        @yield('topbar_actions')
        <a href="{{ route('home') }}"
            style="font-size:0.78rem;color:var(--muted);text-decoration:none;padding:0.45rem 1rem;border:1px solid var(--border)">↗
            Voir le blog</a>
    </div>
</div>
