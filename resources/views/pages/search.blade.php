<x-front-layout>
    <x-front.page-header 
        title="Pencarian Terpadu" 
        pageName="Pencarian"
        subtitle="Temukan karya seni, eksplorasi tradisi budaya, kabar kegiatan, dan arsip dokumentasi UKM Seni Budaya."
        :hero="$hero ?? null"
    />

    <section class="py-24 bg-surface-container-low min-h-screen"
             x-data="{
                 activeTab: 'all',
                 setTab(tab) {
                     this.activeTab = tab;
                 }
             }"
    >
        <div class="max-w-max-width mx-auto px-margin-desktop space-y-12">

            <!-- Refine Search Input -->
            <div class="max-w-2xl mx-auto">
                <form action="{{ route('search') }}" method="GET" class="relative flex items-center">
                    <span class="absolute left-5 text-on-surface-variant/70 material-symbols-outlined pointer-events-none text-2xl">search</span>
                    <input type="text" 
                           name="q" 
                           value="{{ $query }}" 
                           placeholder="Ketik kata kunci pencarian..."
                           class="w-full pl-14 pr-16 py-4.5 bg-white text-on-surface placeholder:text-on-surface-variant/60 border border-surface-variant/40 rounded-2xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-base font-body-md"
                    >
                    <button type="submit" class="absolute right-2.5 bg-primary text-white hover:bg-gold p-3 rounded-xl transition-all flex items-center justify-center shadow-md">
                        <span class="material-symbols-outlined text-lg">arrow_forward</span>
                    </button>
                </form>
            </div>

            @if(!empty($query))
                <!-- Result Summary & Filter Tabs -->
                <div class="border-b border-surface-variant/30 pb-6 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h2 class="font-headline-md text-2xl md:text-3xl text-primary font-bold">
                            Hasil Pencarian
                        </h2>
                        <p class="text-sm text-on-surface-variant mt-1">
                            Ditemukan <strong class="text-primary font-bold">{{ $totalResults }}</strong> konten untuk kata kunci: <span class="italic font-bold text-gold">"{{ $query }}"</span>
                        </p>
                    </div>

                    <!-- Category Tabs -->
                    @if($totalResults > 0)
                        <div class="flex items-center gap-2 overflow-x-auto pb-2 md:pb-0 flex-wrap">
                            <button @click="setTab('all')" 
                                    :class="activeTab === 'all' ? 'bg-primary text-white shadow-md' : 'bg-white text-on-surface-variant hover:bg-surface-variant/40 border border-surface-variant/30'"
                                    class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all cursor-pointer whitespace-nowrap">
                                Semua ({{ $totalResults }})
                            </button>

                            @if($artworks->count() > 0)
                                <button @click="setTab('artworks')" 
                                        :class="activeTab === 'artworks' ? 'bg-primary text-white shadow-md' : 'bg-white text-on-surface-variant hover:bg-surface-variant/40 border border-surface-variant/30'"
                                        class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all cursor-pointer whitespace-nowrap">
                                    Karya ({{ $artworks->count() }})
                                </button>
                            @endif

                            @if($cultures->count() > 0)
                                <button @click="setTab('cultures')" 
                                        :class="activeTab === 'cultures' ? 'bg-primary text-white shadow-md' : 'bg-white text-on-surface-variant hover:bg-surface-variant/40 border border-surface-variant/30'"
                                        class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all cursor-pointer whitespace-nowrap">
                                    Budaya ({{ $cultures->count() }})
                                </button>
                            @endif

                            @if($news->count() > 0)
                                <button @click="setTab('news')" 
                                        :class="activeTab === 'news' ? 'bg-primary text-white shadow-md' : 'bg-white text-on-surface-variant hover:bg-surface-variant/40 border border-surface-variant/30'"
                                        class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all cursor-pointer whitespace-nowrap">
                                    Berita ({{ $news->count() }})
                                </button>
                            @endif

                            @if($projects->count() > 0)
                                <button @click="setTab('projects')" 
                                        :class="activeTab === 'projects' ? 'bg-primary text-white shadow-md' : 'bg-white text-on-surface-variant hover:bg-surface-variant/40 border border-surface-variant/30'"
                                        class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all cursor-pointer whitespace-nowrap">
                                    Proyek ({{ $projects->count() }})
                                </button>
                            @endif

                            @if($archives->count() > 0)
                                <button @click="setTab('archives')" 
                                        :class="activeTab === 'archives' ? 'bg-primary text-white shadow-md' : 'bg-white text-on-surface-variant hover:bg-surface-variant/40 border border-surface-variant/30'"
                                        class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider transition-all cursor-pointer whitespace-nowrap">
                                    Arsip ({{ $archives->count() }})
                                </button>
                            @endif
                        </div>
                    @endif
                </div>

                @if($totalResults === 0)
                    <!-- Empty State -->
                    <div class="text-center py-20 bg-white rounded-3xl border border-surface-variant/30 p-8 max-w-2xl mx-auto space-y-4">
                        <span class="material-symbols-outlined text-6xl text-on-surface-variant/40">search_off</span>
                        <h3 class="font-headline-md text-2xl text-primary font-bold">Tidak Ada Hasil Ditemukan</h3>
                        <p class="text-on-surface-variant text-sm leading-relaxed max-w-md mx-auto">
                            Tidak ada data karya, artikel budaya, berita, atau arsip yang cocok dengan kata kunci <strong class="text-primary">"{{ $query }}"</strong>.
                        </p>
                        <div class="pt-4 flex flex-wrap justify-center gap-3">
                            <a href="{{ route('artworks.index') }}" class="px-5 py-2.5 bg-primary text-white rounded-full text-xs font-semibold uppercase tracking-wider hover:bg-gold transition-colors">
                                Jelajahi Semua Galeri
                            </a>
                            <a href="{{ route('home') }}" class="px-5 py-2.5 border border-surface-variant/50 text-on-surface rounded-full text-xs font-semibold uppercase tracking-wider hover:bg-surface-variant/30 transition-colors">
                                Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                @else
                    <!-- Results Sections -->
                    <div class="space-y-16">

                        <!-- 1. Artworks Result -->
                        @if($artworks->count() > 0)
                            <div x-show="activeTab === 'all' || activeTab === 'artworks'" class="space-y-6">
                                <div class="flex items-center justify-between border-b border-surface-variant/20 pb-3">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-gold text-2xl">palette</span>
                                        <h3 class="font-headline-md text-2xl text-primary font-bold">Karya Seni ({{ $artworks->count() }})</h3>
                                    </div>
                                    <a href="{{ route('artworks.index', ['search' => $query]) }}" class="text-xs text-primary hover:text-gold font-bold uppercase tracking-wider">
                                        Buka di Galeri →
                                    </a>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                    @foreach($artworks as $artwork)
                                        <x-front.card-artwork :artwork="$artwork" />
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- 2. Cultural Explorations Result -->
                        @if($cultures->count() > 0)
                            <div x-show="activeTab === 'all' || activeTab === 'cultures'" class="space-y-6">
                                <div class="flex items-center justify-between border-b border-surface-variant/20 pb-3">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-gold text-2xl">temple_buddhist</span>
                                        <h3 class="font-headline-md text-2xl text-primary font-bold">Telusur Budaya ({{ $cultures->count() }})</h3>
                                    </div>
                                    <a href="{{ route('cultures.index', ['search' => $query]) }}" class="text-xs text-primary hover:text-gold font-bold uppercase tracking-wider">
                                        Buka di Budaya →
                                    </a>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                    @foreach($cultures as $culture)
                                        <x-front.card-article :article="$culture" type="culture" />
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- 3. Art News Result -->
                        @if($news->count() > 0)
                            <div x-show="activeTab === 'all' || activeTab === 'news'" class="space-y-6">
                                <div class="flex items-center justify-between border-b border-surface-variant/20 pb-3">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-gold text-2xl">newspaper</span>
                                        <h3 class="font-headline-md text-2xl text-primary font-bold">Denyut Seni ({{ $news->count() }})</h3>
                                    </div>
                                    <a href="{{ route('arts.index', ['search' => $query]) }}" class="text-xs text-primary hover:text-gold font-bold uppercase tracking-wider">
                                        Buka di Berita Seni →
                                    </a>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                    @foreach($news as $article)
                                        <x-front.card-article :article="$article" type="news" />
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- 4. Projects Result -->
                        @if($projects->count() > 0)
                            <div x-show="activeTab === 'all' || activeTab === 'projects'" class="space-y-6">
                                <div class="flex items-center justify-between border-b border-surface-variant/20 pb-3">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-gold text-2xl">movie</span>
                                        <h3 class="font-headline-md text-2xl text-primary font-bold">Proyek Kreatif ({{ $projects->count() }})</h3>
                                    </div>
                                    <a href="{{ route('projects.index') }}" class="text-xs text-primary hover:text-gold font-bold uppercase tracking-wider">
                                        Buka di Proyek →
                                    </a>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    @foreach($projects as $proj)
                                        <div class="bg-white p-6 rounded-2xl border border-surface-variant/20 shadow-sm flex flex-col justify-between">
                                            <div>
                                                <span class="inline-block px-3 py-0.5 bg-gold/15 text-secondary rounded-full font-label-sm font-bold text-xs uppercase mb-3">
                                                    {{ $proj->category }}
                                                </span>
                                                <h4 class="font-headline-md text-xl text-primary font-bold mb-2 leading-snug">
                                                    {{ $proj->title }}
                                                </h4>
                                                <p class="font-body-md text-on-surface-variant text-sm line-clamp-3">
                                                    {{ Str::limit(strip_tags($proj->description ?? $proj->content), 120) }}
                                                </p>
                                            </div>
                                            <a href="{{ route('projects.index') }}" class="mt-4 text-xs text-primary font-bold uppercase hover:text-gold transition-colors inline-flex items-center">
                                                Lihat Proyek <span class="material-symbols-outlined text-sm ml-1">arrow_forward</span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- 5. Archives Result -->
                        @if($archives->count() > 0)
                            <div x-show="activeTab === 'all' || activeTab === 'archives'" class="space-y-6">
                                <div class="flex items-center justify-between border-b border-surface-variant/20 pb-3">
                                    <div class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-gold text-2xl">inventory_2</span>
                                        <h3 class="font-headline-md text-2xl text-primary font-bold">Arsip Digital ({{ $archives->count() }})</h3>
                                    </div>
                                    <a href="{{ route('archives.index', ['search' => $query]) }}" class="text-xs text-primary hover:text-gold font-bold uppercase tracking-wider">
                                        Buka di Arsip →
                                    </a>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @foreach($archives as $arc)
                                        <div class="bg-white p-6 rounded-2xl border border-surface-variant/20 shadow-sm flex flex-col justify-between">
                                            <div>
                                                <div class="flex items-center justify-between mb-2">
                                                    <span class="text-xs font-bold uppercase px-2.5 py-0.5 rounded bg-primary/10 text-primary">
                                                        {{ $arc->activity_type }}
                                                    </span>
                                                    <span class="text-xs font-semibold text-on-surface-variant/70">
                                                        {{ $arc->year }}
                                                    </span>
                                                </div>
                                                <h4 class="font-headline-md text-lg text-primary font-bold leading-snug mb-2">
                                                    {{ $arc->title }}
                                                </h4>
                                                <p class="text-xs text-on-surface-variant line-clamp-2">
                                                    {{ Str::limit(strip_tags($arc->description), 90) }}
                                                </p>
                                            </div>
                                            <a href="{{ route('archives.index', ['search' => $arc->title]) }}" class="mt-4 text-xs text-primary font-bold uppercase hover:text-gold transition-colors inline-flex items-center">
                                                Buka Arsip <span class="material-symbols-outlined text-sm ml-1">arrow_forward</span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>
                @endif
            @else
                <!-- Initial State (No keyword entered yet) -->
                <div class="text-center py-20 bg-white rounded-3xl border border-surface-variant/30 p-8 max-w-xl mx-auto space-y-4">
                    <span class="material-symbols-outlined text-6xl text-gold">search</span>
                    <h3 class="font-headline-md text-2xl text-primary font-bold">Pencarian Terpadu USB</h3>
                    <p class="text-on-surface-variant text-sm leading-relaxed">
                        Masukkan kata kunci di kolom atas untuk mencari karya seni, artikel budaya, agenda pementasan, atau arsip dokumentasi.
                    </p>
                </div>
            @endif

        </div>
    </section>
</x-front-layout>
