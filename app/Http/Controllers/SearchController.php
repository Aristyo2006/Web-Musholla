<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Campaign;
use App\Models\Gallery;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q', '');
        $trimmed = trim($query);

        $articles = collect();
        $campaigns = collect();
        $galleries = collect();

        if (strlen($trimmed) >= 2) {
            $articles = Article::where('is_published', true)
                ->where(function ($q) use ($trimmed) {
                    $q->where('title', 'LIKE', "%{$trimmed}%")
                      ->orWhere('content', 'LIKE', "%{$trimmed}%");
                })
                ->latest()
                ->take(6)
                ->get();

            $campaigns = Campaign::where('is_active', true)
                ->where(function ($q) use ($trimmed) {
                    $q->where('title', 'LIKE', "%{$trimmed}%")
                      ->orWhere('description', 'LIKE', "%{$trimmed}%");
                })
                ->latest()
                ->take(6)
                ->get();

            $galleries = Gallery::where(function ($q) use ($trimmed) {
                    $q->where('title', 'LIKE', "%{$trimmed}%")
                      ->orWhere('description', 'LIKE', "%{$trimmed}%");
                })
                ->latest()
                ->take(6)
                ->get();
        }

        $totalResults = $articles->count() + $campaigns->count() + $galleries->count();

        return view('search.index', compact('articles', 'campaigns', 'galleries', 'query', 'totalResults'));
    }
}
