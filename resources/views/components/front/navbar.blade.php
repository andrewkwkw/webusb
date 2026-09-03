<nav x-data="{ open: false }"
    class="fixed top-0 w-full z-50 glass-nav bg-white/70 shadow-[0_20px_40px_rgba(0,56,168,0.08)]">
    <div class="flex justify-between items-center max-w-max-width mx-auto px-margin-mobile md:px-margin-desktop h-20">
        <div class="h-16 w-auto flex items-center">
            <img src="{{ asset('assets/logo.webp') }}" alt="UKM Seni Budaya Logo" class="h-16 w-auto object-contain">
            <div class="ml-4 flex items-center font-headline-md text-primary uppercase tracking-wider">
                <span class="text-base sm:text-lg whitespace-nowrap font-bold">UKM SENI BUDAYA</span>
            </div>
        </div>

        <div class="hidden lg:flex items-center space-x-8 font-label-lg text-label-lg uppercase tracking-wider">
            <a class="{{ request()->routeIs('home') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover-gold transition-colors' }}"
                href="{{ route('home') }}">Beranda</a>
            <a class="{{ request()->routeIs('artworks.*') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover-gold transition-colors' }}"
                href="{{ route('artworks.index') }}">Karya</a>
            <a class="{{ request()->routeIs('cultures.*') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover-gold transition-colors' }}"
                href="{{ route('cultures.index') }}">Budaya</a>
            <div class="relative group">
                <a class="{{ request()->routeIs('arts.*') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover-gold transition-colors' }} flex items-center gap-1"
                    href="{{ route('arts.index') }}">
                    Denyut Seni <span class="material-symbols-outlined text-[16px]">expand_more</span>
                </a>
                <div
                    class="absolute top-full left-0 mt-4 w-48 bg-white shadow-[0_10px_30px_rgba(0,56,168,0.1)] rounded opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 flex flex-col py-2 z-50">
                    <a href="{{ route('arts.index', ['category' => 'Seni Musik']) }}"
                        class="px-4 py-2 text-sm text-on-surface-variant hover:bg-gray-50 hover:text-primary transition-colors">Seni
                        Musik</a>
                    <a href="{{ route('arts.index', ['category' => 'Seni Rupa']) }}"
                        class="px-4 py-2 text-sm text-on-surface-variant hover:bg-gray-50 hover:text-primary transition-colors">Seni
                        Rupa</a>
                    <a href="{{ route('arts.index', ['category' => 'Seni Teater']) }}"
                        class="px-4 py-2 text-sm text-on-surface-variant hover:bg-gray-50 hover:text-primary transition-colors">Seni
                        Teater</a>
                </div>
            </div>
            <a class="{{ request()->routeIs('projects.*') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover-gold transition-colors' }}"
                href="{{ route('projects.index') }}">Project</a>
            <a class="{{ request()->routeIs('archives.*') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover-gold transition-colors' }}"
                href="{{ route('archives.index') }}">Arsip</a>
            <a class="{{ request()->routeIs('about') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover-gold transition-colors' }}"
                href="{{ route('about') }}">Tentang</a>
            <a class="{{ request()->routeIs('contact') ? 'text-primary border-b-2 border-primary pb-1' : 'text-on-surface-variant hover-gold transition-colors' }}"
                href="{{ route('contact') }}">Kontak</a>
        </div>

        <button @click="open = !open" class="lg:hidden p-2 text-primary focus:outline-none">
            <span class="material-symbols-outlined text-3xl" x-text="open ? 'close' : 'menu'">menu</span>
        </button>
    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="lg:hidden absolute top-20 left-0 w-full bg-white shadow-lg border-t border-surface-variant/20 z-40"
        @click.away="open = false" style="display: none;">
        <div class="flex flex-col py-4 px-6 space-y-4 font-label-lg text-label-lg uppercase tracking-wider text-center">
            <a class="{{ request()->routeIs('home') ? 'text-primary font-bold' : 'text-on-surface-variant' }}"
                href="{{ route('home') }}">Beranda</a>
            <a class="{{ request()->routeIs('artworks.*') ? 'text-primary font-bold' : 'text-on-surface-variant' }}"
                href="{{ route('artworks.index') }}">Karya</a>
            <a class="{{ request()->routeIs('cultures.*') ? 'text-primary font-bold' : 'text-on-surface-variant' }}"
                href="{{ route('cultures.index') }}">Budaya</a>
            <div x-data="{ openSub: false }">
                <button @click="openSub = !openSub"
                    class="w-full flex items-center justify-center gap-1 {{ request()->routeIs('arts.*') ? 'text-primary font-bold' : 'text-on-surface-variant' }}">
                    Seni <span class="material-symbols-outlined text-[16px]"
                        :class="{'rotate-180': openSub}">expand_more</span>
                </button>
                <div x-show="openSub"
                    class="flex flex-col space-y-3 mt-3 pb-2 text-sm text-on-surface-variant/80 bg-surface/50 rounded-lg py-2">
                    <a href="{{ route('arts.index', ['category' => 'Seni Musik']) }}">Seni Musik</a>
                    <a href="{{ route('arts.index', ['category' => 'Seni Rupa']) }}">Seni Rupa</a>
                    <a href="{{ route('arts.index', ['category' => 'Seni Teater']) }}">Seni Teater</a>
                </div>
            </div>
            <a class="{{ request()->routeIs('projects.*') ? 'text-primary font-bold' : 'text-on-surface-variant' }}"
                href="{{ route('projects.index') }}">Project</a>
            <a class="{{ request()->routeIs('archives.*') ? 'text-primary font-bold' : 'text-on-surface-variant' }}"
                href="{{ route('archives.index') }}">Arsip</a>
            <a class="{{ request()->routeIs('about') ? 'text-primary font-bold' : 'text-on-surface-variant' }}"
                href="{{ route('about') }}">Tentang</a>
            <a class="{{ request()->routeIs('contact') ? 'text-primary font-bold' : 'text-on-surface-variant' }}"
                href="{{ route('contact') }}">Kontak</a>
        </div>
    </div>
</nav>