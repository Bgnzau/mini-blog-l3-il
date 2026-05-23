<div style="width: 250px; min-width: 250px; background: #0d0d0f; color: #fff; height: 100vh; padding: 20px; border-right: 1px solid #1a1a1e; font-family: 'Segoe UI', sans-serif; box-sizing: border-box; position: sticky; top: 0;">
    <div style="display: flex; flex-direction: column; height: 100%;">
        <div>
            <h2 style="font-size: 1.2rem; margin-top: 0; margin-bottom: 5px;">Le Blog</h2>
            <small style="color: #666; display: block; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px;">Administration</small>
            
            <h4 style="color: #666; text-transform: uppercase; font-size: 0.8rem; margin: 30px 0 10px;">Vue d'ensemble</h4>
            <a href="{{ route('dashboard.index') }}" style="color: #fff; text-decoration: none; display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                <span>◇</span> Dashboard
            </a>

            <h4 style="color: #666; text-transform: uppercase; font-size: 0.8rem; margin: 25px 0 10px;">Contenu</h4>
            <a href="{{ route('dashboard.posts') }}" style="color: #fff; text-decoration: none; display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                <span>◇</span> Articles
            </a>
            <a href="{{ route('dashboard.categories') }}" style="color: #fff; text-decoration: none; display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                <span>◇</span> Catégories
            </a>
            <a href="{{ route('dashboard.comments') }}" style="color: #fff; text-decoration: none; display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                <span>◇</span> Commentaires
            </a>

            <h4 style="color: #666; text-transform: uppercase; font-size: 0.8rem; margin: 25px 0 10px;">Utilisateurs</h4>
            <a href="{{ route('dashboard.users') }}" style="color: #fff; text-decoration: none; display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                <span>◇</span> Utilisateurs
            </a>

            <h4 style="color: #666; text-transform: uppercase; font-size: 0.8rem; margin: 25px 0 10px;">Paramètres</h4>
            <a href="{{ route('dashboard.settings') }}" style="color: #fff; text-decoration: none; display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
                <span>◇</span> Réglages
            </a>
        </div>
        
        <div style="margin-top: auto; border-top: 1px solid #1a1a1e; padding-top: 15px; display: flex; align-items: center; gap: 10px;">
            <div style="width: 32px; height: 32px; background: #c0392b; border-radius: 50%; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                A
            </div>
            <div>
                <strong style="display: block; font-size: 0.95rem;">Admin</strong>
                <small style="display: block; color: #666; font-size: 0.8rem;">Super administrateur</small>
            </div>
        </div>
    </div>
</div>