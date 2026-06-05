@extends('dashboard')

@section('title', 'Catégories — Dashboard')
@section('page_title', 'Catégories')

@section('content')
<div class="grid-layout">

                <div class="panel">
                    <div class="panel-header">
                        <div class="panel-title">Toutes les catégories ({{ $categories->count() }})</div>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Slug</th>
                                <th>Articles</th>
                                <th>Créée le</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td class="text-muted">{{ $category->id }}</td>
                                    <td><strong>{{ $category->name }}</strong></td>
                                    <td class="text-muted">{{ $category->slug ?? strtolower($category->name) }}</td>
                                    <td><span class="cat-count">{{ $category->posts->count() }} articles</span></td>
                                    <td class="text-muted">{{ $category->created_at?->format('d am. Y') ?? '17 avr. 2026' }}</td>
                                    <td>
                                        <div class="actions">
                                            <button class="btn btn-edit"
                                                onclick="openEditCat('{{ addslashes($category->name) }}','{{ $category->slug }}')">Éditer</button>
                                            <button class="btn btn-danger">Suppr.</button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 2rem; color: var(--muted);">
                                        Aucune catégorie présente en base de données.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="panel">
                    <div class="panel-header">
                        <div class="panel-title">Nouvelle catégorie</div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="form-label">Nom <span class="required">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Nom de la catégorie"
                                required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control" name="slug"
                                placeholder="slug-de-la-categorie">
                            <div class="form-hint" style="margin-top:0.3rem">Généré automatiquement depuis le nom si
                                laissé vide.</div>
                        </div>
                        <button class="btn btn-primary" style="width:100%;margin-top:0.5rem">Créer la
                            catégorie</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="editModal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">Modifier la catégorie</div>
                <button class="modal-close"
                    onclick="document.getElementById('editModal').classList.remove('open')">✕</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nom <span class="required">*</span></label>
                    <input type="text" class="form-control" id="edit-name" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control" id="edit-slug">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-ghost"
                    onclick="document.getElementById('editModal').classList.remove('open')">Annuler</button>
                <button class="btn btn-primary">Sauvegarder</button>
            </div>
        </div>
    </div>

    <script>
        function openEditCat(name, slug) {
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-slug').value = slug;
            document.getElementById('editModal').classList.add('open');
        }
        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', e => {
                if (e.target === overlay) overlay.classList.remove('open');
            });
        });
    </script>
@endsection
