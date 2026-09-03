<x-front-layout>
    @php
        $bgImage1 = $hero && $hero->image_path ? asset('storage/' . $hero->image_path) : null;
        $bgImage2 = $hero && $hero->image_path_2 ? asset('storage/' . $hero->image_path_2) : null;
        $hasMultipleImages = $bgImage1 && $bgImage2;
    @endphp
    <section class="relative h-screen flex items-center overflow-hidden transition-all duration-1000 opacity-100 translate-y-0">
        <div class="absolute inset-0 z-0"
             @if($hasMultipleImages)
                 x-data="{ activeSlide: 1 }" 
                 x-init="setInterval(() => { activeSlide = activeSlide === 1 ? 2 : 1 }, 5000)"
             @endif
        >
            @if($bgImage1)
                <div @if($hasMultipleImages) x-show="activeSlide === 1" x-transition.opacity.duration.1500ms @endif
                     class="absolute inset-0 w-full h-full bg-cover bg-center" style="background-image: url('{{ $bgImage1 }}')"></div>
            @endif
            
            @if($bgImage2)
                <div x-show="activeSlide === 2" x-transition.opacity.duration.1500ms
                     class="absolute inset-0 w-full h-full bg-cover bg-center" style="background-image: url('{{ $bgImage2 }}')"></div>
            @endif

            @if(!$bgImage1 && !$bgImage2)
                <div class="absolute inset-0 w-full h-full bg-white flex items-center justify-center">
                    <span class="text-[15vw] font-display-lg text-primary/5 tracking-widest uppercase select-none">HERO</span>
                </div>
            @endif
            
            <div class="absolute inset-0 hero-gradient"></div>
        </div>
        @php
            $hasAnyImage = $bgImage1 || $bgImage2;
        @endphp
        <div class="relative z-10 max-w-max-width mx-auto px-margin-desktop w-full">
            <div class="max-w-3xl animate-fade-in-up">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="h-[2px] w-16 {{ $hasAnyImage ? 'bg-gold' : 'bg-primary' }}"></div>
                    <span class="inline-block px-4 py-1 border {{ $hasAnyImage ? 'border-gold/30 text-gold bg-black/20' : 'border-primary/20 text-primary bg-white/30' }} rounded-full font-label-sm uppercase tracking-[0.2em] backdrop-blur-md">
                        Pusat Dokumentasi Kreatif
                    </span>
                </div>
                
                <h1 class="font-display-lg text-4xl md:text-5xl {{ $hasAnyImage ? 'text-white drop-shadow-md' : 'text-primary' }} mb-6 leading-tight">
                    Merawat Jejak, <br>
                    <span class="italic font-normal {{ $hasAnyImage ? 'text-gold' : 'text-secondary' }}">Menciptakan Karya</span>
                </h1>
                
                <div class="max-w-2xl border-l-2 {{ $hasAnyImage ? 'border-l-gold' : 'border-l-primary' }} pl-4 mb-10">
                    <p class="font-body-md text-sm md:text-base {{ $hasAnyImage ? 'text-white/95 drop-shadow-sm' : 'text-on-surface-variant' }} leading-relaxed">
                        Sebuah platform kolektif untuk pengarsipan budaya dan ekspresi media kreatif mahasiswa Universitas
                        Pakuan. Menghubungkan masa lalu melalui kurasi seni masa kini.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6">
                    <a class="btn-hover-effect {{ $hasAnyImage ? 'bg-gold text-primary hover:bg-white' : 'bg-primary text-on-primary' }} px-10 py-5 rounded-lg font-label-lg uppercase tracking-widest flex items-center justify-center group shadow-xl"
                        href="#karya">
                        Jelajahi Arsip
                        <span
                            class="material-symbols-outlined ml-2 transition-transform group-hover:translate-x-1">arrow_forward</span>
                    </a>
                    <a class="btn-hover-effect border-2 {{ $hasAnyImage ? 'border-white text-white hover:bg-white hover:text-primary' : 'border-primary text-primary hover:bg-primary hover:text-white' }} px-10 py-5 rounded-lg font-label-lg uppercase tracking-widest flex items-center justify-center backdrop-blur-sm"
                        href="{{ route('about') }}">
                        Tentang Kami
                    </a>
                </div>

                <!-- Hero Search Bar -->
                <div class="mt-10 max-w-2xl">
                    <form action="{{ route('search') }}" method="GET" class="relative flex items-center">
                        <span class="absolute left-5 {{ $hasAnyImage ? 'text-white/70' : 'text-on-surface-variant' }} material-symbols-outlined pointer-events-none text-2xl">search</span>
                        <input type="text" 
                               name="q" 
                               placeholder="Cari karya foto, video, tradisi budaya, atau berita seni..."
                               class="w-full pl-14 pr-16 py-4 {{ $hasAnyImage ? 'bg-black/40 text-white placeholder:text-white/70 border-white/30' : 'bg-white text-on-surface placeholder:text-on-surface-variant/70 border-surface-variant/60' }} border rounded-2xl backdrop-blur-md shadow-2xl focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold transition-all text-sm md:text-base font-body-md"
                        >
                        <button type="submit" class="absolute right-2.5 bg-gold text-primary hover:bg-white p-3 rounded-xl transition-all flex items-center justify-center shadow-lg group">
                            <span class="material-symbols-outlined text-lg transition-transform group-hover:translate-x-0.5">arrow_forward</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce flex flex-col items-center">
            <span class="font-label-sm text-primary/40 uppercase tracking-widest mb-2">Scroll</span>
            <span class="material-symbols-outlined text-primary/40">expand_more</span>
        </div>
    </section>

    <section class="py-32 bg-white transition-all duration-1000 opacity-0 translate-y-10" id="karya">
        <div class="max-w-max-width mx-auto px-margin-desktop">
            <div class="flex justify-between items-end mb-16">
                <x-front.section-title title="Karya Terbaru" />
                <a class="font-label-lg text-primary hover-gold flex items-center transition-colors"
                    href="{{ route('artworks.index') }}">
                    LIHAT SEMUA GALERI <span class="material-symbols-outlined ml-2">open_in_new</span>
                </a>
            </div>

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