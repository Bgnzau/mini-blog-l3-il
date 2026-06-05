@extends('dashboard')

@section('title', 'Commentaires — Dashboard')
@section('page_title', 'Commentaires')

@section('content')
<div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon">◇</div>
                    <div class="stat-info">
                        <div class="stat-num">{{ $comments->count() }}</div>
                        <div class="stat-lbl">Total</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="color:var(--success)">◈</div>
                    <div class="stat-info">
                        <div class="stat-num">{{ $comments->count() }}</div>
                        <div class="stat-lbl">Approuvés</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="color:var(--warning)">◎</div>
                    <div class="stat-info">
                        <div class="stat-num">0</div>
                        <div class="stat-lbl">En attente</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="color:#E74C3C">✕</div>
                    <div class="stat-info">
                        <div class="stat-num">0</div>
                        <div class="stat-lbl">Spam</div>
                    </div>
                </div>
            </div>

            <div class="tabs">
                <button class="tab active">Tous ({{ $comments->count() }})</button>
                <button class="tab">En attente (0)</button>
                <button class="tab">Approuvés ({{ $comments->count() }})</button>
                <button class="tab">Spam (0)</button>
            </div>

            <div class="toolbar">
                <input type="search" class="search-input" placeholder="Rechercher dans les commentaires...">
                <select class="filter">
                    <option>Tous les articles</option>
                </select>
                <button class="btn btn-ghost" style="margin-left:auto">Tout approuver</button>
            </div>

            <div class="comments-list">

                @forelse($comments as $comment)
                    <div class="comment-row approved">
                        <div class="c-avatar" style="background:#2E86AB;color:#fff">
                            {{ strtoupper(substr($comment->user?->name ?? 'An', 0, 2)) }}
                        </div>
                        <div>
                            <div class="c-meta">
                                <span class="c-author">{{ $comment->user?->name ?? 'Anonyme' }}</span>
                                <span class="badge badge-approved">Approuvé</span>
                                <span class="c-date">{{ $comment->created_at->format('d am. Y à H:i') }}</span>
                            </div>
                            <div class="c-article">Sur : <a href="{{ route('articles.index') }}">{{ $comment->post?->title ?? 'Article inconnu' }}</a></div>
                            <div class="c-text" style="margin-top:0.5rem">
                                {{ $comment->content }}
                            </div>
                        </div>
                        <div class="c-actions">
                            <button class="btn btn-success" onclick="openView('{{ addslashes($comment->user?->name) }}', '{{ $comment->user?->email }}', '{{ addslashes($comment->post?->title) }}', '{{ $comment->created_at->format('d mmmm Y à H:i') }}', '{{ addslashes($comment->content) }}')">Voir</button>
                            <button class="btn btn-warning">Spam</button>
                            <button class="btn btn-danger">✕</button>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 3rem; color: var(--muted);">
                        Aucun commentaire sur le site pour le moment.
                    </div>
                @endforelse

            </div>

            <div class="pagination">
                <button class="page-btn active">1</button>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="viewModal">
        <div class="modal">
            <div class="modal-header">
                <div class="modal-title">Détail du commentaire</div>
                <button class="modal-close"
                    onclick="document.getElementById('viewModal').classList.remove('open')">✕</button>
            </div>
            <div class="modal-body">
                <div style="margin-bottom:1.5rem">
                    <div class="info-row"><span class="info-label">Auteur</span><span id="modal-author">Weldon Walter</span></div>
                    <div class="info-row"><span class="info-label">Email</span><span id="modal-email" style="color:var(--muted)">luciano.sporer@example.net</span></div>
                    <div class="info-row"><span class="info-label">Article</span><span id="modal-article" style="color:var(--accent); font-size:0.85rem">Sed molestiae omnis</span></div>
                    <div class="info-row"><span class="info-label">Date</span><span id="modal-date" style="color:var(--muted);font-size:0.85rem">17 avril 2026 à 06:35</span></div>
                    <div class="info-row"><span class="info-label">Statut</span><span class="badge badge-approved">Approuvé</span></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Contenu du commentaire</label>
                    <textarea class="form-control" id="modal-content"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-ghost"
                    onclick="document.getElementById('viewModal').classList.remove('open')">Fermer</button>
                <button class="btn" style="background:transparent;color:#E74C3C;border:1px solid #E74C3C">Marquer
                    spam</button>
                <button class="btn btn-primary">Approuver</button>
            </div>
        </div>
    </div>

    <script>
        function openView(author, email, article, date, content) {
            document.getElementById('modal-author').innerText = author;
            document.getElementById('modal-email').innerText = email ?? 'Non renseigné';
            document.getElementById('modal-article').innerText = article;
            document.getElementById('modal-date').innerText = date;
            document.getElementById('modal-content').value = content;
            document.getElementById('viewModal').classList.add('open');
        }
        document.querySelectorAll('.modal-overlay').forEach(o => o.addEventListener('click', e => {
            if (e.target === o) o.classList.remove('open');
        }));
        document.querySelectorAll('.tab').forEach(t => t.addEventListener('click', function() {
            document.querySelectorAll('.tab').forEach(x => x.classList.remove('active'));
            this.classList.add('active');
        }));
    </script>
@endsection