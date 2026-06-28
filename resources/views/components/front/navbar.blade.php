@php
    $contact = \App\Models\ContactSetting::first();
    $profile = \App\Models\CompanyProfile::first();
@endphp
<nav class="fixed top-0 w-full z-50 glass-nav bg-white/70 shadow-[0_20px_40px_rgba(0,56,168,0.08)]">
    <div class="flex justify-between items-center max-w-max-width mx-auto px-margin-desktop h-20">
        <div class="h-12 w-auto flex items-center">
            <img src="{{ asset('assets/logo.webp') }}" alt="UKM Seni Budaya Logo" class="h-12 w-auto object-contain">
            <div class="ml-4 flex flex-col justify-center font-headline-md text-primary uppercase tracking-wider leading-tight">
                <span class="text-sm">UKM SENI</span>
                <span class="text-sm">& BUDAYA</span>
            </div>
        </div>
        <div class="hidden lg:flex items-center space-x-8 font-label-lg text-label-lg uppercase tracking-wider">
            <a class="{{ request()->routeIs('home') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover-gold transition-colors' }}" href="{{ route('home') }}">Beranda</a>
            <a class="{{ request()->routeIs('about') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover-gold transition-colors' }}" href="{{ route('about') }}">Tentang</a>
            <a class="{{ request()->routeIs('artworks.*') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover-gold transition-colors' }}" href="{{ route('artworks.index') }}">Karya</a>
            <a class="{{ request()->routeIs('cultures.*') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover-gold transition-colors' }}" href="{{ route('cultures.index') }}">Budaya</a>
            <a class="{{ request()->routeIs('arts.*') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover-gold transition-colors' }}" href="{{ route('arts.index') }}">Seni</a>
            <a class="{{ request()->routeIs('projects.*') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover-gold transition-colors' }}" href="{{ route('projects.index') }}">Proyek</a>
            <a class="{{ request()->routeIs('archives.*') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover-gold transition-colors' }}" href="{{ route('archives.index') }}">Arsip</a>
            <a class="{{ request()->routeIs('contact') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover-gold transition-colors' }}" href="{{ route('contact') }}">Kontak</a>
    </div>
</nav>
