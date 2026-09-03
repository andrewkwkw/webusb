<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Models\ArtNews;
use App\Models\Artwork;
use App\Models\CompanyProfile;
use App\Models\ContactSetting;
use App\Models\CulturalExploration;
use App\Models\InboxMessage;
use App\Models\OrganizationMember;
use App\Models\PageHero;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $hero = PageHero::where('page_name', 'Beranda')->first();

        $artworks = Artwork::with('user')
            ->featured()
            ->latest()
            ->take(6)
            ->get();

        $cultures = CulturalExploration::with('user')
            ->published()
            ->latest()
            ->take(2)
            ->get();

        $news = ArtNews::with('user')
            ->published()
            ->latest()
            ->take(1)
            ->get();

        $articles = $cultures->merge($news)->sortByDesc('created_at');

        return view('pages.home', compact('artworks', 'articles', 'hero'));
    }

    public function about(): View
    {
        $profile = CompanyProfile::first();
        $members = OrganizationMember::orderBy('order_column')->get();

        return view('pages.about', compact('profile', 'members'));
    }

    public function contact(): View
    {
        $contact = ContactSetting::first();

        return view('pages.contact', compact('contact'));
    }

    public function sendMessage(StoreContactMessageRequest $request): RedirectResponse
    {
        InboxMessage::create([
            ...$request->validated(),
            'is_read' => false,
        ]);

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim! Kami akan menghubungi Anda kembali melalui email.');
    }
}
