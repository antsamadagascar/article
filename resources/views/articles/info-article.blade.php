@extends('layouts.app')

@section('title', 'Liste des articles')

@section('content')
<div class="container mt-5">
    <article>
        <h1>{{ $article->nom_article }}</h1>
        <div class="metadata mb-4">
            <span class="date">Publié le {{ $article->date->format('d/m/Y à H:i') }}</span>
        </div>
        <div class="content">
            {!! nl2br(e($article->contenus)) !!}
        </div>
        
        <div class="seo-info mt-5 p-3 bg-light">
            <h4>Informations SEO</h4>
            <p><strong>Titre SEO:</strong> {{ $article->titre }}</p>
            <p><strong>URL optimisée:</strong> {{ url($article->url) }}</p>
        </div>
    </article>
    
    <a href="{{ route('articles.index') }}" class="btn btn-secondary mt-3">
        Retour à la liste des articles
    </a>
</div>
@endsection