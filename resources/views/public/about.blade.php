@extends('app')

@section('content')
<main style="max-width: 800px; margin: 40px auto; padding: 0 20px; font-family: 'Segoe UI', sans-serif; line-height: 1.6;">
    <h2 style="font-size: 2rem; color: #1a1a2e; border-bottom: 2px solid #1a1a2e; padding-bottom: 10px; margin-bottom: 30px;">À propos de ce projet</h2>
    <p style="font-size: 1.2rem; color: #333; font-weight: bold;">Bienvenue sur l'application d'évaluation de l'Équipe L3 IL.</p>
    <p style="color: #666; margin-top: 20px;">
        Ce mini-blog a été entièrement développé dans le cadre des travaux pratiques de développement web sous le framework <strong>Laravel</strong>. Il démontre la mise en place d'une architecture MVC propre, d'un système de routage avancé, et de la création de layouts dynamiques et réutilisables grâce au moteur de template Blade.
    </p>
    <p style="color: #666;">
        Le design intègre un espace utilisateur moderne ainsi qu'un tableau de bord d'administration sombre ("dark mode") permettant la gestion des contenus par un super administrateur.
    </p>
</main>
@endsection