<?php

namespace App\Http\Controllers;

use App\Models\CulturalExploration;
use App\Models\PageHero;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CultureController extends Controller
{
    public function index(Request $request): View
    {
        $hero = PageHero::where('page_name', 'Budaya')->first();

        $query = CulturalExploration::with('user')
            ->published()
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $cultures = $query->paginate(9)->withQueryString();

        return view('pages.cultures.index', compact('cultures', 'hero'));
    }

    public function show(string $slug): View
    {
        $culture = CulturalExploration::with('user')
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        $related = CulturalExploration::published()
            ->where('id', '!=', $culture->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('pages.cultures.show', compact('culture', 'related'));
    }
}
