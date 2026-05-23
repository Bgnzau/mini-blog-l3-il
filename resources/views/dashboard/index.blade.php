@extends('dashboard')

@section('content')
{{-- Juste un padding pour respirer, Flexbox s'occupe du reste ! --}}
<div style="padding: 40px; background-color: #111116; color: #ffffff; font-family: 'Segoe UI', sans-serif; box-sizing: border-box;">
    
    {{-- Section des 4 cartes de statistiques --}}
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
        <div style="background: #16161f; padding: 20px; border-radius: 6px; border: 1px solid #1f1f2e;">
            <small style="color: #888; text-transform: uppercase; font-size: 0.75rem; font-weight: bold;">Articles publiés</small>
            <h2 style="font-size: 2.2rem; margin: 10px 0 5px 0; font-family: Georgia, serif;">26</h2>
            <span style="color: #2ecc71; font-size: 0.85rem;">↑ Sur 50 total</span>
        </div>
        <div style="background: #16161f; padding: 20px; border-radius: 6px; border: 1px solid #1f1f2e;">
            <small style="color: #888; text-transform: uppercase; font-size: 0.75rem; font-weight: bold;">Commentaires</small>
            <h2 style="font-size: 2.2rem; margin: 10px 0 5px 0; font-family: Georgia, serif;">250</h2>
            <span style="color: #888; font-size: 0.85rem;">5 par article en moyenne</span>
        </div>
        <div style="background: #16161f; padding: 20px; border-radius: 6px; border: 1px solid #1f1f2e;">
            <small style="color: #888; text-transform: uppercase; font-size: 0.75rem; font-weight: bold;">Utilisateurs</small>
            <h2 style="font-size: 2.2rem; margin: 10px 0 5px 0; font-family: Georgia, serif;">305</h2>
            <span style="color: #2ecc71; font-size: 0.85rem;">↑ +12 ce mois</span>
        </div>
        <div style="background: #16161f; padding: 20px; border-radius: 6px; border: 1px solid #1f1f2e;">
            <small style="color: #888; text-transform: uppercase; font-size: 0.75rem; font-weight: bold;">Catégories</small>
            <h2 style="font-size: 2.2rem; margin: 10px 0 5px 0; font-family: Georgia, serif;">5</h2>
            <span style="color: #888; font-size: 0.85rem;">10 articles / catégorie</span>
        </div>
    </div>

    {{-- Section inférieure : Tableau + Activités récentes --}}
    <div style="display: flex; gap: 25px;">
        
        {{-- Tableau des articles récents --}}
        <div style="flex: 2; background: #16161f; padding: 25px; border-radius: 6px; border: 1px solid #1f1f2e;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="margin: 0; font-size: 1.1rem;">Articles récents</h3>
                <a href="#" style="color: #e74c3c; text-decoration: none; font-size: 0.9rem;">Voir tout →</a>
            </div>
            
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem;">
                <thead>
                    <tr style="border-bottom: 1px solid #252538; color: #666; text-transform: uppercase; font-size: 0.75rem;">
                        <th style="padding: 10px 5px;">Titre</th>
                        <th style="padding: 10px 5px;">Catégorie</th>
                        <th style="padding: 10px 5px;">Statut</th>
                        <th style="padding: 10px 5px;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #1f1f2e;">
                        <td style="padding: 15px 5px; font-weight: 500;">Excepturi eligendi aliquid iste laboriosam</td>
                        <td style="padding: 15px 5px; color: #888;">Option</td>
                        <td style="padding: 15px 5px;"><span style="background: rgba(46,204,113,0.1); color: #2ecc71; padding: 3px 8px; border-radius: 4px; font-size: 0.75rem;">PUBLIÉ</span></td>
                        <td style="padding: 15px 5px; color: #666;">15 juil. 2015</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #1f1f2e;">
                        <td style="padding: 15px 5px; font-weight: 500;">Aut repellat ut qui et</td>
                        <td style="padding: 15px 5px; color: #888;">Aperiam</td>
                        <td style="padding: 15px 5px;"><span style="background: rgba(46,204,113,0.1); color: #2ecc71; padding: 3px 8px; border-radius: 4px; font-size: 0.75rem;">PUBLIÉ</span></td>
                        <td style="padding: 15px 5px; color: #666;">8 oct. 2019</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #1f1f2e;">
                        <td style="padding: 15px 5px; font-weight: 500;">Dignissimos et eaque aut sed fugiat et</td>
                        <td style="padding: 15px 5px; color: #888;">Option</td>
                        <td style="padding: 15px 5px;"><span style="background: rgba(46,204,113,0.1); color: #2ecc71; padding: 3px 8px; border-radius: 4px; font-size: 0.75rem;">PUBLIÉ</span></td>
                        <td style="padding: 15px 5px; color: #666;">23 sep. 1988</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Bloc Activité Récente --}}
        <div style="flex: 1; background: #16161f; padding: 25px; border-radius: 6px; border: 1px solid #1f1f2e;">
            <h3 style="margin: 0 0 20px 0; font-size: 1.1rem;">Activité récente</h3>
            
            <div style="display: flex; flex-direction: column; gap: 20px; font-size: 0.85rem;">
                <div>
                    <span style="color: #2ecc71;">●</span> <strong>Nouvel article publié</strong> par Jacklyn Lueilwitz
                    <small style="display: block; color: #666; margin-top: 3px;">Il y a 2 heures</small>
                </div>
                <div>
                    <span style="color: #e74c3c;">●</span> <strong>Nouveau commentaire</strong> sur Excepturi eligendi...
                    <small style="display: block; color: #666; margin-top: 3px;">Il y a 4 heures</small>
                </div>
                <div>
                    <span style="color: #f39c12;">●</span> <strong>Nouvel utilisateur inscrit</strong> : Mikel Lynch
                    <small style="display: block; color: #666; margin-top: 3px;">Il y a 6 heures</small>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection