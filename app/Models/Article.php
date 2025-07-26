<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nom_article', 'titre', 'contenus', 'date', 'url'
    ];
    
    protected $casts = [
        'date' => 'datetime',
    ];
    
    /**
     * Génère une URL SEO-friendly pour l'article
     */
    public function generateUrl(): string
    {
        // Générer un slug à partir du titre
        $slugTitle = Str::slug($this->titre);

        // Extraire les premiers mots du contenu (par exemple, les 10 premiers mots)
        $contentWords = str_word_count($this->contenus, 1);
        $shortContent = implode('-', array_slice($contentWords, 0, 10)); // Limiter à 10 mots
        $slugContent = Str::slug($shortContent);

        // Formater la date
        $dateFormatted = $this->date->format('d-m-Y');
    
        // Combiner le tout pour créer l'URL
        return "{$this->id}_{$slugTitle}-{$slugContent}-{$dateFormatted}";
    }

    /**
     * Insère un nouvel article avec URL SEO
     */
    public static function insert_article(array $data)
    {
        $data['date'] = now();

        // Générer une URL temporaire basée sur le titre et le contenu
        $slugTitle = Str::slug($data['titre']);
        $contentWords = str_word_count($data['contenus'], 1);
        $shortContent = implode('-', array_slice($contentWords, 0, 10)); // Limiter à 10 mots
        $slugContent = Str::slug($shortContent);
        $data['url'] = "{$slugTitle}-{$slugContent}-" . now()->format('d-m-Y');

        // Créer l'article
        $article = self::create($data);

        // Mettre à jour l'URL avec l'ID de l'article
        $article->url = $article->generateUrl();
        $article->save();

        return $article;
    }
        
    protected static function booted()
{
    static::creating(function ($article) {
        if (!$article->url) {
            // Générer une URL temporaire basée sur le titre et le contenu
            $slugTitle = Str::slug($article->titre);
            $contentWords = str_word_count($article->contenus, 1);
            $shortContent = implode('-', array_slice($contentWords, 0, 10)); // Limiter à 10 mots
            $slugContent = Str::slug($shortContent);
            $article->url = "{$slugTitle}-{$slugContent}-" . now()->format('d-m-Y');
        }
    });

    static::created(function ($article) {
        // Mettre à jour l'URL avec l'ID de l'article
        $article->url = $article->generateUrl();
        $article->save();
    });
}
        
    /**
     * Récupère tous les articles
     */
    public static function getAllArticles()
    {
        return self::orderBy('date', 'desc')->get();
    }
}