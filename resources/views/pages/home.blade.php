<x-front-layout>
    @php
        $hero = \App\Models\PageHero::where('page_name', 'Beranda')->first();
        $bgImage = $hero && $hero->image_path ? asset('storage/' . $hero->image_path) : null;
    @endphp
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center overflow-hidden transition-all duration-1000 opacity-100 translate-y-0">
        <div class="absolute inset-0 z-0">
            @if($bgImage)
                <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ $bgImage }}')"></div>
                <div class="absolute inset-0 hero-gradient"></div>
            @else
                <div class="w-full h-full bg-white flex items-center justify-center">
                    <span class="text-[15vw] font-display-lg text-primary/5 tracking-widest uppercase select-none">HERO</span>
                </div>
            @endif
        </div>
        <div class="relative z-10 max-w-max-width mx-auto px-margin-desktop w-full">
            <div class="max-w-3xl">
                <span
                    class="inline-block px-4 py-1 mb-6 border border-primary/20 rounded-full font-label-sm text-primary uppercase tracking-[0.2em] bg-white/30 backdrop-blur-md">
                    Pusat Dokumentasi Kreatif
                </span>
                <h1 class="font-display-lg text-display-lg text-primary mb-6">
                    Merawat Jejak, <br>
                    <span class="italic font-normal">Menciptakan Karya</span>
                </h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant mb-10 max-w-xl">
                    Sebuah platform kolektif untuk pengarsipan budaya dan ekspresi media kreatif mahasiswa Universitas
                    Pakuan. Menghubungkan masa lalu melalui kurasi seni masa kini.
                </p>
                <div class="flex space-x-6">
                    <a class="btn-hover-effect bg-primary text-on-primary px-10 py-5 rounded-lg font-label-lg uppercase tracking-widest flex items-center group"
                        href="#karya">
                        Jelajahi Arsip
                        <span
                            class="material-symbols-outlined ml-2 transition-transform group-hover:translate-x-1">arrow_forward</span>
                    </a>
                    <a class="btn-hover-effect border-2 border-primary text-primary px-10 py-5 rounded-lg font-label-lg uppercase tracking-widest hover:bg-primary hover:text-white"
                        href="{{ route('about') }}">
                        Tentang Kami
                    </a>
                </div>
            </div>
        </div>
        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce flex flex-col items-center">
            <span class="font-label-sm text-primary/40 uppercase tracking-widest mb-2">Scroll</span>
            <span class="material-symbols-outlined text-primary/40">expand_more</span>
        </div>
    </section>

    <!-- Featured Artworks (Karya) Section -->
    <section class="py-32 bg-white transition-all duration-1000 opacity-0 translate-y-10" id="karya">
        <div class="max-w-max-width mx-auto px-margin-desktop">
            <div class="flex justify-between items-end mb-16">
                <x-front.section-title title="Karya Terbaru" />
                <a class="font-label-lg text-primary hover-gold flex items-center transition-colors"
                    href="{{ route('artworks.index') }}">
                    LIHAT SEMUA GALERI <span class="material-symbols-outlined ml-2">open_in_new</span>
                </a>
            </div>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse($artworks as $index => $artwork)
                    <div class="{{ $index % 3 === 1 ? 'lg:translate-y-12' : '' }}">
                        <x-front.card-artwork :artwork="$artwork" />
                    </div>
                @empty
                    <p class="text-on-surface-variant italic">Belum ada karya terbaru.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Jurnal & Berita Section -->
    <section
        class="py-32 bg-surface-container-low border-y border-surface-variant/20 transition-all duration-1000 opacity-0 translate-y-10">
        <div class="max-w-max-width mx-auto px-margin-desktop">
            <div class="text-center mb-20">
                <h2 class="font-headline-lg text-headline-lg text-primary mb-4">Jurnal & Berita</h2>
                <p class="font-body-lg text-on-surface-variant max-w-2xl mx-auto">Menelusuri kedalaman budaya dan denyut
                    kesenian di lingkungan Universitas Pakuan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
                @forelse($articles->take(3) as $article)
                    @php
                        $type = $article instanceof \App\Models\CulturalExploration ? 'culture' : 'news';
                    @endphp
                    <x-front.card-article :article="$article" :type="$type" />
                @empty
                    <p class="text-on-surface-variant italic text-center col-span-3">Belum ada artikel terbaru.</p>
                @endforelse
            </div>
        </div>
    </section>

</x-front-layout>