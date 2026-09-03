<?php

namespace App\Http\Controllers;

use App\Models\PageHero;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $hero = PageHero::where('page_name', 'Proyek')->orWhere('page_name', 'Project')->first();

        $query = Project::with('user')
            ->published()
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $projects = $query->paginate(9)->withQueryString();

        return view('pages.projects.index', compact('projects', 'hero'));
    }
}
