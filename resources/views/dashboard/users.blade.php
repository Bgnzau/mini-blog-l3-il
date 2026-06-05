@extends('dashboard')

@section('title', 'Utilisateurs — Dashboard')
@section('page_title', 'Utilisateurs')

@section('topbar_actions')
<button class="btn btn-primary" onclick="document.getElementById('createModal').classList.add('open')">
    + Nouvel utilisateur
</button>
@endsection

@section('content')
<div class="toolbar">
    <form action="{{ route('users.index') }}" method="GET" style="width: 100%;">
        <input type="search" name="search" class="search-input" value="{{ request('search') }}" placeholder="Rechercher un utilisateur...">
    </form>
</div>

<div class="panel">
    <div class="panel-header">
        <div class="panel-title">Tous les utilisateurs ({{ $users->total() }})</div>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Vérifié</th>
                <th>Inscrit le</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td class="text-muted">{{ $user->id }}</td>
                    <td>
                        <div class="user-cell">
                            @php
                                // Génération de deux initiales à partir du nom
                                $words = explode(' ', $user->name);
                                $initials = strtoupper(substr($words[0] ?? '', 0, 1) . substr($words[1] ?? '', 0, 1));
                                
                                // Tableau de couleurs pour alterner un peu le visuel des avatars
                                $colors = ['#7B4F9E', '#2E86AB', '#C0392B', '#27AE60', '#E67E22', '#8E44AD', '#1ABC9C'];
                                $bgColor = $colors[$user->id % count($colors)];
                            @@endphp
                            <div class="user-init" style="background:{{ $bgColor }}; color:#fff">{{ $initials }}</div>
                            {{ $user->name }}
                        </div>
                    </td>
                    <td class="text-muted">{{ $user->email }}</td>
                    <td>
                        @if($user->email_verified_at)
                            <span class="verified">✓ Vérifié</span>
                        @else
                            <span class="text-muted" style="font-size: 0.85rem;">Non vérifié</span>
                        @@endif
                    </td>
                    <td class="text-muted">{{ $user->created_at->translatedFormat('d M. Y') }}</td>
                    <td>
                        <div class="actions">
                            <button class="btn btn-edit" 
                                    onclick="openEdit({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ $user->email }}')">
                                Éditer
                            </button>
                            
                            <button class="btn btn-danger" onclick="confirmDelete({{ $user->id }})">
                                Suppr.
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem;" class="text-muted">
                        Aucun utilisateur trouvé.
                    </td>
                </tr>
            @@endforelse
        </tbody>
    </table>
    
    <div class="pagination">
        {{ $users->links() }}
    </div>
</div>

<div class="modal-overlay" id="createModal">
    <div class="modal">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="modal-header">
                <div class="modal-title">Nouvel utilisateur</div>
                <button type="button" class="modal-close" onclick="document.getElementById('createModal').classList.remove('open')">✕</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nom complet <span class="required">*</span></label>
                    <input type="text" class="form-control" name="name" placeholder="Prénom Nom" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email <span class="required">*</span></label>
                    <input type="email" class="form-control" name="email" placeholder="utilisateur@exemple.com" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Mot de passe <span class="required">*</span></label>
                        <input type="password" class="form-control" name="password" placeholder="••••••••" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirmation <span class="required">*</span></label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="••••••••" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" style="display:flex;align-items:center;gap:0.5rem;cursor:pointer">
                        <input type="checkbox" name="email_verified" value="1" style="accent-color:var(--accent)">
                        Marquer l'email comme vérifié
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-ghost" onclick="document.getElementById('createModal').classList.remove('open')">Annuler</button>
                <button type="submit" class="btn btn-primary">Créer l'utilisateur</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="editModal">
    <div class="modal">
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <div class="modal-title">Modifier l'utilisateur</div>
                <button type="button" class="modal-close" onclick="document.getElementById('editModal').classList.remove('open')">✕</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nom complet <span class="required">*</span></label>
                    <input type="text" class="form-control" id="edit-name" name="name" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email <span class="required">*</span></label>
                    <input type="email" class="form-control" id="edit-email" name="email" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nouveau mot de passe</label>
                    <input type="password" class="form-control" name="password" placeholder="Laisser vide pour ne pas changer">
                    <div class="form-hint" style="margin-top:0.3rem">Laisser vide pour conserver le mot de passe actuel.</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-ghost" onclick="document.getElementById('editModal').classList.remove('open')">Annuler</button>
                <button type="submit" class="btn btn-primary">Sauvegarder</button>
            </div>
        </form>
    </div>
</div>

<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
    // Ouverture et configuration du modal d'édition
    function openEdit(id, name, email) {
        // Injection des valeurs actuelles
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-email').value = email;
        
        // Configuration de l'URL du formulaire de mise à jour (ex: /users/1)
        const form = document.getElementById('editForm');
        form.action = `/users/${id}`; 
        
        document.getElementById('editModal').classList.add('open');
    }

    // Gestion de la suppression avec confirmation locale simple
    function confirmDelete(id) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
            const form = document.getElementById('deleteForm');
            form.action = `/users/${id}`;
            form.submit();
        }
    }

    // Fermeture des modals en cliquant en dehors
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', e => {
            if (e.target === overlay) overlay.classList.remove('open');
        });
    });
</script>
@endsection