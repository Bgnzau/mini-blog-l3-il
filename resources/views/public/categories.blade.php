@extends('app')

@section('content')
<main style="max-width: 1200px; margin: 40px auto; padding: 0 20px; font-family: 'Segoe UI', sans-serif;">
    <h2 style="font-size: 2rem; color: #1a1a2e; border-bottom: 2px solid #1a1a2e; padding-bottom: 10px; margin-bottom: 30px;">Nos Catégories</h2>
    <p style="color: #666; font-size: 1.1rem;">Explorez nos articles classés par thématiques majeures.</p>
    
    <div style="display: flex; gap: 20px; margin-top: 30px;">
        <div style="background: #efece3; padding: 20px 40px; border-radius: 4px; font-weight: bold; color: #1a1a2e;">💻 Technologie (12)</div>
        <div style="background: #efece3; padding: 20px 40px; border-radius: 4px; font-weight: bold; color: #1a1a2e;">🎨 Design (8)</div>
        <div style="background: #efece3; padding: 20px 40px; border-radius: 4px; font-weight: bold; color: #1a1a2e;">🚀 Programmation (15)</div>
        <div style="background: #efece3; padding: 20px 40px; border-radius: 4px; font-weight: bold; color: #1a1a2e;">📚 Actualités (10)</div>
    </div>
</main>
@endsection