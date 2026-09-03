<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\PageHero;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArchiveController extends Controller
{
    public function index(Request $request): View
    {
        $hero = PageHero::where('page_name', 'Arsip')->orWhere('page_name', 'arsip')->first();

        $query = Archive::with('user')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('activity_type', 'like', "%{$search}%")
                  ->orWhere('year', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('activity_type', $request->type);
        }

        if ($request->filled('year') && $request->year !== 'all') {
            $query->where('year', $request->year);
        }

        $archives = $query->paginate(12)->withQueryString();

        $types = ['Latihan Rutin', 'Workshop', 'Kunjungan', 'Event Internal', 'Dokumentasi'];
        $years = Archive::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');

        return view('pages.archives.index', compact('archives', 'hero', 'types', 'years'));
    }
}
