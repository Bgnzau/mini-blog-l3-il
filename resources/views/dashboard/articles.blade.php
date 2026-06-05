@extends('dashboard')

@section('title', 'Articles — Dashboard')
@section('page_title', 'Articles')

@section('topbar_actions')
<button class="btn btn-primary" onclick="document.getElementById('createModal').classList.add('open')">
    + Nouvel article
</button>
@endsection

@section('content')
<div class="toolbar">
    <form action="{{ route('dashboard.articles') }}" method="GET" style="display: flex; gap: 0.5rem; width: 100%;">
        <input type="search" name="search" class="search-input" value="{{ request('search') }}" placeholder="Rechercher un article...">
        
        <select class="filter" name="category">
            <option value="">Toutes les catégories</option>
            @foreach(\App\Models\Category::all() as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </form>
</div>

<div class="panel">
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Auteur</th>
                <th>Publié le</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td><strong>{{ $article->title }}</strong></td>
                    <td><span class="badge">{{ $article->category->name ?? 'Sans catégorie' }}</span></td>
                    <td>{{ $article->user->name ?? 'Inconnu' }}</td>
                    <td>{{ $article->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="actions">
                            <button class="btn btn-edit" onclick="openEdit(
                                {{ $article->id }}, 
                                '{{ addslashes($article->title) }}', 
                                '{{ $article->slug }}', 
                                {{ $article->category_id ?? 'null' }}, 
                                {{ $article->user_id ?? 'null' }}, 
                                '{{ addslashes($article->content) }}'
                            )">
                                Éditer
                            </button>
                            <button class="btn btn-danger" onclick="confirmDelete({{ $article->id }})">
                                Suppr.
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem;" class="text-muted">
                        Aucun article disponible pour le moment.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="pagination">
        {{ $articles->links() }}
    </div>
</div>

<div class="modal-overlay" id="createModal">
    <div class="modal font-sans text-gray-900">
        <form action="#" method="POST">
            @csrf
            <div class="modal-header">
                <div class="modal-title">Nouvel article</div>
                <button type="button" class="modal-close" onclick="document.getElementById('createModal').classList.remove('open')">✕</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Titre <span class="required">*</span></label>
                    <input type="text" class="form-control" name="title" placeholder="Titre de l'article" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control" name="slug" placeholder="slug-de-l-article">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Catégorie <span class="required">*</span></label>
                        <select class="form-control" name="category_id" required>
                            <option value="">— Choisir —</option>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Auteur <span class="required">*</span></label>
                        <select class="form-control" name="user_id" required>
                            <option value="">— Choisir —</option>
                            @foreach(\App\Models\User::all() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Contenu <span class="required">*</span></label>
                    <textarea class="form-control" name="content" placeholder="Contenu de l'article..." rows="5" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-ghost" onclick="document.getElementById('createModal').classList.remove('open')">Annuler</button>
                <button type="submit" class="btn btn-primary">Créer l'article</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="editModal">
    <div class="modal font-sans text-gray-900">
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <div class="modal-title">Modifier l'article</div>
                <button type="button" class="modal-close" onclick="document.getElementById('editModal').classList.remove('open')">✕</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Titre <span class="required">*</span></label>
                    <input type="text" class="form-control" id="edit-title" name="title" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control" id="edit-slug" name="slug">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Catégorie <span class="required">*</span></label>
                        <select class="form-control" id="edit-category" name="category_id" required>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Auteur <span class="required">*</span></label>
                        <select class="form-control" id="edit-user" name="user_id" required>
                            @foreach(\App\Models\User::all() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Contenu <span class="required">*</span></label>
                    <textarea class="form-control" id="edit-content" name="content" rows="5" required></textarea>
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
    // Remplissage dynamique des champs lors du clic sur Éditer
    function openEdit(id, title, slug, categoryId, userId, content) {
        document.getElementById('edit-title').value = title;
        document.getElementById('edit-slug').value = slug;
        document.getElementById('edit-category').value = categoryId;
        document.getElementById('edit-user').value = userId;
        document.getElementById('edit-content').value = content;
        
        // Ajustement dynamique de l'action du formulaire (ex: /dashboard/articles/id)
        document.getElementById('editForm').action = `/dashboard/articles/${id}`;
        
        document.getElementById('editModal').classList.add('open');
    }

    function confirmDelete(id) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cet article ?")) {
            const form = document.getElementById('deleteForm');
            form.action = `/dashboard/articles/${id}`;
            form.submit();
        }
    }

    // Fermeture des modals en cliquant à l'extérieur
    document.querySelectorAll('.modal-overlay').forEach(overlay => {
        overlay.addEventListener('click', e => {
            if (e.target === overlay) overlay.classList.remove('open');
        });
    });
</script>
@endsection