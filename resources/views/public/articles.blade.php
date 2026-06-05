@extends('app')

@section('title', 'Articles — Le Blog')

@section('content')
    <div class="page-header">
        <div class="page-tag">Blog</div>
        <h1 class="page-title">Tous les articles</h1>
        <p class="page-count">{{ $totalArticles }} articles publiés dans {{ $totalCategories }} catégories</p>
    </div>

    <div class="filters-bar">
        <div class="search-wrap">
            <input type="search" placeholder="Rechercher un article...">
        </div>
        <div class="filter-cats">
            <a href="#" class="cat-pill active">Tout</a>
            @foreach($categories as $category)
                <a href="#" class="cat-pill">{{ $category->name }}</a>
            @endforeach
        </div>
        <select class="sort-select">
            <option>Plus récents</option>
            <option>Plus anciens</option>
            <option>Plus commentés</option>
        </select>
    </div>

    <div class="main-layout">
        <div class="articles-col">
            <div class="articles-list">

                @forelse($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}" class="article-item">
                        <div>
                            <div class="ai-cat">{{ $article->category?->name ?? 'Général' }}</div>
                            <div class="ai-title">{{ $article->title }}</div>
                            <div class="ai-excerpt">
                                {{ Str::limit($article->content, 180) }}
                            </div>
                            <div class="ai-meta">
                                <span>{{ $article->user?->name ?? 'Anonyme' }}</span>
                                <span>{{ $article->created_at->translatedFormat('d F Y') }}</span>
                                <span>{{ $article->comments_count ?? 0 }} commentaires</span>
                            </div>
                        </div>
                        <div class="ai-thumb c{{ rand(1, 5) }}">{{ strtoupper(substr($article->title, 0, 1)) }}</div>
                    </a>
                @empty
                    <div class="article-item">
                        <p>Aucun article n'a encore été publié dans la base de données.</p>
                    </div>
                @endforelse

            </div>
            
            <div class="pagination">
                <a href="#" class="page-btn active">1</a>
                <a href="#" class="page-btn">2</a>
                <a href="#" class="page-btn">3</a>
                <a href="#" class="page-btn">4</a>
                <a href="#" class="page-btn">5</a>
                <a href="#" class="page-btn">→</a>
            </div>
        </div>

        <aside class="sidebar-col">
            <div class="sidebar-block">
                <div class="sidebar-label">Catégories</div>
                @foreach($categories as $category)
                    <a href="#" class="cat-item">
                        {{ $category->name }} 
                        <span class="cat-count">{{ $category->posts_count ?? '' }} articles</span>
                    </a>
                @endforeach
            </div>

            <div class="sidebar-block">
                <div class="sidebar-label">Articles populaires</div>
                @foreach($articles->take(5) as $key => $popArticle)
                    <a href="{{ route('articles.show', $popArticle->slug) }}" class="popular-item">
                        <div class="pop-num">0{{ $key + 1 }}</div>
                        <div>
                            <div class="pop-title">{{ Str::limit($popArticle->title, 40) }}</div>
                            <div class="pop-cat">{{ $popArticle->category?->name ?? 'Blog' }}</div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="sidebar-block">
                <div class="sidebar-label">Tags</div>
                <div class="tag-cloud">
                    <a href="#" class="tag">Vitae</a>
                    <a href="#" class="tag">Eligendi</a>
                    <a href="#" class="tag">Laboriosam</a>
                    <a href="#" class="tag">Optio</a>
                    <a href="#" class="tag">Soluta</a>
                    <a href="#" class="tag">Repellat</a>
                    <a href="#" class="tag">Blanditiis</a>
                    <a href="#" class="tag">Veniam</a>
                </div>
            </div>
        </aside>
    </div>
@endsection