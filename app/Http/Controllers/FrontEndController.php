<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artwork;
use App\Models\CulturalExploration;
use App\Models\ArtNews;
use App\Models\Project;
use App\Models\Archive;
use App\Models\CompanyProfile;
use App\Models\ContactSetting;

class FrontEndController extends Controller
{
    public function home()
    {
        $artworks = Artwork::with('user')->where('is_featured', true)->latest()->take(6)->get();
        
        $cultures = CulturalExploration::with('user')->where('is_published', true)->latest()->take(2)->get();
        $news = ArtNews::with('user')->where('is_published', true)->latest()->take(1)->get();
        
        // Merge latest culture and news for the homepage
        $articles = $cultures->merge($news)->sortByDesc('created_at');
        
        return view('pages.home', compact('artworks', 'articles'));
    }

    public function about()
    {
        $profile = CompanyProfile::first();
        $members = \App\Models\OrganizationMember::orderBy('order_column')->get();
        return view('pages.about', compact('profile', 'members'));
    }

    public function oprec()
    {
        $setting = \App\Models\OprecSetting::first();
        return view('pages.oprec', compact('setting'));
    }

    public function storeOprec(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'motivation' => 'nullable|string',
            'portfolio_link' => 'nullable|url',
        ]);

        \App\Models\OprecRegistration::create($validated);

        return redirect()->back()->with('success', 'Pendaftaran berhasil! Silakan tunggu info selanjutnya.');
    }

    public function artworks()
    {
        $artworks = Artwork::with('user')->latest()->paginate(12);
        return view('pages.artworks.index', compact('artworks'));
    }
    
    public function showArtwork($slug)
    {
        $artwork = Artwork::with('user')->where('slug', $slug)->firstOrFail();
        return view('pages.artworks.show', compact('artwork'));
    }

    public function cultures()
    {
        $cultures = CulturalExploration::with('user')->where('is_published', true)->latest()->paginate(9);
        return view('pages.cultures.index', compact('cultures'));
    }
    
    public function showCulture($slug)
    {
        $culture = CulturalExploration::with('user')->where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('pages.cultures.show', compact('culture'));
    }

    public function arts(\Illuminate\Http\Request $request)
    {
        $query = ArtNews::with('user')->where('is_published', true)->latest();
        
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
        
        $news = $query->paginate(9);
        return view('pages.arts.index', compact('news'));
    }

    public function showArt($slug)
    {
        $art = ArtNews::with('user')->where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('pages.arts.show', compact('art'));
    }

    public function projects()
    {
        $projects = Project::with('user')->where('is_published', true)->latest()->paginate(9);
        return view('pages.projects.index', compact('projects'));
    }

    public function archives()
    {
        $archives = Archive::with('user')->latest()->paginate(15);
        return view('pages.archives.index', compact('archives'));
    }

    public function contact()
    {
        $contact = ContactSetting::first();
        return view('pages.contact', compact('contact'));
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $validated['is_read'] = false;
        \App\Models\InboxMessage::create($validated);

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim! Kami akan menghubungi Anda kembali melalui email.');
    }
}
