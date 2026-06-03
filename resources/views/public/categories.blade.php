{{--
    EXERCICE — Questions 1 & 7 : Liste des catégories (route categories.index)
    Liens "Voir tous les articles" → route('articles.index').
--}}
@extends('app')

@section('title', 'Catégories — Le Blog')

@section('content')
<div class="page-header">
        <div class="page-tag">Explorer</div>
        <h1 class="page-title">Catégories</h1>
        <p class="page-desc">Parcourez notre contenu organisé en 5 thématiques distinctes, chacune explorée avec rigueur
            et passion.</p>
    </div>

    <!-- HERO GRID -->
    <div class="cats-hero">
        <a href="#vitae" class="cat-hero-card">
            <div class="ch-num">01</div>
            <div>
                <div class="ch-name">Vitae</div>
                <div class="ch-count">10 articles</div>
                <div class="ch-arrow">→</div>
            </div>
        </a>
        <a href="#dignissimos" class="cat-hero-card">
            <div class="ch-num">02</div>
            <div>
                <div class="ch-name">Dignissimos</div>
                <div class="ch-count">10 articles</div>
                <div class="ch-arrow">→</div>
            </div>
        </a>
        <a href="#optio" class="cat-hero-card">
            <div class="ch-num">03</div>
            <div>
                <div class="ch-name">Optio</div>
                <div class="ch-count">10 articles</div>
                <div class="ch-arrow">→</div>
            </div>
        </a>
        <a href="#aperiam" class="cat-hero-card">
            <div class="ch-num">04</div>
            <div>
                <div class="ch-name">Aperiam</div>
                <div class="ch-count">10 articles</div>
                <div class="ch-arrow">→</div>
            </div>
        </a>
        <a href="#tenetur" class="cat-hero-card">
            <div class="ch-num">05</div>
            <div>
                <div class="ch-name">Tenetur</div>
                <div class="ch-count">10 articles</div>
                <div class="ch-arrow">→</div>
            </div>
        </a>
    </div>
@endsection
