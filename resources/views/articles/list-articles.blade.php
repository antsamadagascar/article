@extends('layouts.app')

@section('title', 'Liste des articles')

@section('content')
<div class="container mt-5">
    <h2>Liste des articles</h2>
    <div class="row">
        @foreach($articles as $article)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->nom_article }}</h5>
                        <p class="card-text">{{ Str::limit($article->contenus, 100) }}</p>
                        <a href="{{ url($article->url) }}" class="btn btn-outline-primary">
                            Lire l'article
                        </a>
                        <p class="text-muted mt-2">Publié le {{ $article->date->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection