@extends('layouts.app')

@section('title', 'Créer un nouvel article')

@section('content')
<div class="container mt-5">
    <h2>Créer un nouvel article</h2>
    <form action="{{ route('articles.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="nom_article">Nom de l'article</label>
            <input type="text" class="form-control" id="nom_article" name="nom_article" required>
        </div>
        <div class="form-group mb-3">
            <label for="titre">Titre SEO</label>
            <input type="text" class="form-control" id="titre" name="titre" maxlength="60" required>
            <small class="text-muted">Idéalement entre 50-60 caractères pour le SEO</small>
        </div>
        <div class="form-group mb-3">
            <label for="contenus">Contenu</label>
            <textarea class="form-control" id="contenus" name="contenus" rows="10" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Publier l'article</button>
    </form>
</div>
@endsection