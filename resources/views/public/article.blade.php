@extends('app')

@section('content')
<main style="max-width: 800px; margin: 40px auto; padding: 0 20px; font-family: 'Segoe UI', sans-serif; line-height: 1.8;">
    <span style="color: #e74c3c; font-weight: bold; text-transform: uppercase; font-size: 0.9rem;">Technologie</span>
    <h1 style="font-size: 2.8rem; color: #1a1a2e; margin: 10px 0 20px 0; font-family: Georgia, serif;">Excepturi eligendi aliquid iste laboriosam</h1>
    <p style="color: #888; font-size: 0.9rem; margin-bottom: 40px;">Publié le 15 juillet 2015 par l'équipe L3 IL</p>
    
    <div style="font-size: 1.1rem; color: #333; text-align: justify;">
        <p style="font-weight: bold; font-size: 1.2rem;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
    
    <div style="margin-top: 50px; padding-top: 20px; border-top: 1px solid #ddd;">
        <a href="{{ route('articles') }}" style="color: #e74c3c; text-decoration: none; font-weight: bold;">← Retour aux articles</a>
    </div>
</main>
@endsection