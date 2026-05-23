<header style="background: transparent; color: #1a1a2e; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <h1 style="margin: 0; font-size: 1.5rem; font-weight: bold;">Le Blog</h1>
    <nav style="display: flex; gap: 20px; font-weight: 500;">
        <a href="{{ route('home') }}" style="color: #1a1a2e; text-decoration: none;">Accueil</a>
        <a href="{{ route('articles') }}" style="color: #1a1a2e; text-decoration: none;">Articles</a>
        <a href="#" style="color: #666; text-decoration: none;">Catégories</a> {{-- Lien inactif pour simplifier --}}
        <a href="{{ route('about') }}" style="color: #1a1a2e; text-decoration: none;">À propos</a>
        <a href="{{ route('dashboard.index') }}" style="color: #1a1a2e; text-decoration: none;">Dashboard</a>
    </nav>
</header>