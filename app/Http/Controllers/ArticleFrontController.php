<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleFrontController extends Controller
{
    /**
     * Display a listing of published articles.
     */
    public function index()
    {
        $articles = Article::where('is_published', true)
            ->with('user')
            ->latest('published_at')
            ->paginate(9);

        return view('articles.index', compact('articles'));
    }

    /**
     * Display the specified article.
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('is_published', true)
            ->with(['user'])
            ->firstOrFail();
            
        // Get related articles (random 3 stories from other posts)
        $relatedArticles = Article::where('is_published', true)
            ->where('id', '!=', $article->id)
            ->with('user')
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
