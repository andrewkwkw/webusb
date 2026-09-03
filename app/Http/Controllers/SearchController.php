<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\ArtNews;
use App\Models\Artwork;
use App\Models\CulturalExploration;
use App\Models\PageHero;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $query = trim($request->input('q', ''));
        $hero = PageHero::where('page_name', 'Karya')->first();

        if (empty($query)) {
            return view('pages.search', [
                'query' => '',
                'artworks' => collect(),
                'cultures' => collect(),
                'news' => collect(),
                'projects' => collect(),
                'archives' => collect(),
                'totalResults' => 0,
                'hero' => $hero,
            ]);
        }

        // 1. Search Artworks
        $artworks = Artwork::with('user')
            ->published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('creator_name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('category', 'like', "%{$query}%");
            })
            ->latest()
            ->take(12)
            ->get();

        // 2. Search Cultural Explorations
        $cultures = CulturalExploration::with('user')
            ->published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%")
                  ->orWhere('location', 'like', "%{$query}%")
                  ->orWhere('category', 'like', "%{$query}%");
            })
            ->latest()
            ->take(12)
            ->get();

        // 3. Search Art News
        $news = ArtNews::with('user')
            ->published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%")
                  ->orWhere('category', 'like', "%{$query}%");
            })
            ->latest()
            ->take(12)
            ->get();

        // 4. Search Projects
        $projects = Project::with('user')
            ->published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%")
                  ->orWhere('category', 'like', "%{$query}%");
            })
            ->latest()
            ->take(12)
            ->get();

        // 5. Search Archives
        $archives = Archive::with('user')
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('activity_type', 'like', "%{$query}%")
                  ->orWhere('year', 'like', "%{$query}%");
            })
            ->latest()
            ->take(12)
            ->get();

        $totalResults = $artworks->count() + $cultures->count() + $news->count() + $projects->count() + $archives->count();

        return view('pages.search', compact(
            'query',
            'artworks',
            'cultures',
            'news',
            'projects',
            'archives',
            'totalResults',
            'hero'
        ));
    }
}
