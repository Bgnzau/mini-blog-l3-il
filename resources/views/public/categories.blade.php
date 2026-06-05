{{--
    EXERCICE — Question 3 : Liste des catégories dynamisées (route categories.index)
--}}
@extends('app')

@section('title', 'Catégories — Le Blog')

@section('content')
    <div class="page-header">
        <div class="page-tag">Explorer</div>
        <h1 class="page-title">Catégories</h1>
        <p class="page-desc">Parcourez notre contenu organisé en {{ $totalCategories }} thématiques distinctes, chacune explorée avec rigueur et passion.</p>
    </div>

    <div class="cats-hero">
        
        @foreach($categories as $key => $category)
            <a href="{{ route('articles.index') }}?category={{ $category->id }}" class="cat-hero-card">
                <div class="ch-num">{{ sprintf('%02d', $key + 1) }}</div>
                <div>
                    <div class="ch-name">{{ $category->name }}</div>
                    
                    <div class="ch-count">
                        {{ $category->posts_count ?? 0 }} {{ Str::plural('article', $category->posts_count) }}
                    </div>
                    <div class="ch-arrow">→</div>
                </div>
            </a>
        @endforeach

    </div>
@endsection
