<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\PageHero;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArtworkController extends Controller
{
    public function index(Request $request): View
    {
        $hero = PageHero::where('page_name', 'Karya')->first();

        $query = Artwork::with('user')
            ->published()
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $artworks = $query->paginate(12)->withQueryString();

        return view('pages.artworks.index', compact('artworks', 'hero'));
    }

    public function show(string $slug): View
    {
        $artwork = Artwork::with('user')
            ->where('slug', $slug)
            ->firstOrFail();

        $related = Artwork::published()
            ->where('id', '!=', $artwork->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('pages.artworks.show', compact('artwork', 'related'));
    }
}
