@extends('app')

@section('content')
<main style="max-width: 1200px; margin: 40px auto; padding: 0 20px; font-family: 'Segoe UI', sans-serif;">
    <h2 style="font-size: 2rem; color: #1a1a2e; border-bottom: 2px solid #1a1a2e; padding-bottom: 10px; margin-bottom: 30px;">Tous nos articles</h2>
    
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
        <div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <span style="color: #e74c3c; font-size: 0.8rem; font-weight: bold; text-transform: uppercase;">Technologie</span>
            <h3 style="margin: 10px 0;"><a href="{{ route('article', ['id' => 1]) }}" style="color: #1a1a2e; text-decoration: none; font-family: Georgia, serif;">Excepturi eligendi aliquid iste laboriosam</a></h3>
            <p style="color: #666; font-size: 0.9rem;">Découvrez comment l'ingénierie logicielle moderne transforme nos applications quotidiennes...</p>
        </div>

        <div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <span style="color: #e74c3c; font-size: 0.8rem; font-weight: bold; text-transform: uppercase;">Design</span>
            <h3 style="margin: 10px 0;"><a href="#" style="color: #1a1a2e; text-decoration: none; font-family: Georgia, serif;">Aut repellat ut qui et</a></h3>
            <p style="color: #666; font-size: 0.9rem;">L'importance de l'expérience utilisateur et des interfaces sombres dans le web en 2026.</p>
        </div>

        <div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
            <span style="color: #e74c3c; font-size: 0.8rem; font-weight: bold; text-transform: uppercase;">Laravel</span>
            <h3 style="margin: 10px 0;"><a href="#" style="color: #1a1a2e; text-decoration: none; font-family: Georgia, serif;">Dignissimos et eaque aut sed fugiat et</a></h3>
            <p style="color: #666; font-size: 0.9rem;">Maîtriser les composants Blade et l'architecture MVC pour structurer vos projets rapidement.</p>
        </div>
    </div>
</main>
@endsection