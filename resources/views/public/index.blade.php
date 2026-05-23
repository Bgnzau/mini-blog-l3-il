@extends('app')

@section('content')
<main style="max-width: 1200px; margin: 40px auto; padding: 0 20px; font-family: 'Segoe UI', sans-serif; background-color: #fcfaf2; min-height: 80vh;">
    <div style="display: flex; justify-content: space-between; align-items: center; gap: 40px; padding-top: 60px;">
        
        <div style="flex: 1;">
            <span style="color: #e74c3c; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; font-size: 0.85rem;">Bienvenue sur notre blog</span>
            <h1 style="font-size: 3.5rem; color: #1a1a2e; margin: 20px 0; font-family: 'Playfair Display', Georgia, serif; font-weight: bold; line-height: 1.2;">
                Des idées qui valent la peine d'être lues
            </h1>
            <p style="color: #666; font-size: 1.1rem; line-height: 1.6; max-width: 500px; margin-bottom: 50px;">
                Un espace de réflexion, d'exploration et de partage. Nous publions des articles soignés sur des sujets qui comptent vraiment.
            </p>
            
            <div style="display: flex; gap: 60px; border-top: 1px solid #e0dacb; padding-top: 30px;">
                <div>
                    <h3 style="font-size: 2.5rem; margin: 0; color: #1a1a2e; font-family: Georgia, serif;">50</h3>
                    <small style="color: #888; text-transform: uppercase; font-size: 0.75rem; font-weight: bold;">Articles publiés</small>
                </div>
                <div>
                    <h3 style="font-size: 2.5rem; margin: 0; color: #1a1a2e; font-family: Georgia, serif;">5</h3>
                    <small style="color: #888; text-transform: uppercase; font-size: 0.75rem; font-weight: bold;">Catégories</small>
                </div>
                <div>
                    <h3 style="font-size: 2.5rem; margin: 0; color: #1a1a2e; font-family: Georgia, serif;">250</h3>
                    <small style="color: #888; text-transform: uppercase; font-size: 0.75rem; font-weight: bold;">Commentaires</small>
                </div>
            </div>
        </div>

        <div style="flex: 1; display: flex; justify-content: flex-end;">
            <div style="background: #111116; color: white; padding: 40px; width: 450px; border-radius: 4px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); position: relative;">
                <span style="color: #e74c3c; font-size: 0.8rem; font-weight: bold; text-transform: uppercase;">À la une</span>
                <h2 style="font-size: 1.8rem; margin: 20px 0 10px 0; font-family: Georgia, serif; font-weight: normal; line-height: 1.4;">
                    Excepturi eligendi aliquid iste laboriosam
                </h2>
                <p style="color: #888; font-size: 0.95rem; margin-bottom: 0;">
                    Le dernier article qui fait parler tout le monde...
                </p>
            </div>
        </div>

    </div>
</main>
@endsection