<?php

namespace App\Http\Controllers;

use App\Models\ArtNews;
use App\Models\PageHero;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArtNewsController extends Controller
{
    public function index(Request $request): View
    {
        $hero = PageHero::where('page_name', 'Seni')->first();

        $query = ArtNews::with('user')
            ->published()
            ->latest();

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $news = $query->paginate(9)->withQueryString();

        return view('pages.arts.index', compact('news', 'hero'));
    }

    public function show(string $slug): View
    {
        $art = ArtNews::with('user')
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        $related = ArtNews::published()
            ->where('id', '!=', $art->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('pages.arts.show', compact('art', 'related'));
    }
}
