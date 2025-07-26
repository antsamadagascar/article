<?php
namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Affiche la liste des articles
     */
    public function index()
    {
        $articles = Article::getAllArticles();
        return view('articles.list-articles', compact('articles'));
    }
    
    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('articles.create-article');
    }
    
    /**
     * Enregistre un nouvel article
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_article' => 'required|string|max:255',
            'titre' => 'required|string|max:100',
            'contenus' => 'required|string',
        ]);
    
        // Insérer l'article en utilisant la méthode du modèle
        $article = Article::insert_article($validated);
    
        return redirect()->route('articles.show', $article->url)
            ->with('success', 'Article créé avec succès!');
    }
    
    /**
     * Affiche un article spécifique
     */
    public function show($url)
    {
        $article = Article::where('url', $url)->firstOrFail();
        return view('articles.info-article', compact('article'));
    }
}