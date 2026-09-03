<x-front-layout>
    <x-front.page-header 
        title="Arsip Digital" 
        pageName="Arsip"
        subtitle="Kilas balik dokumentasi, latihan rutin, workshop, dan event internal UKM Seni & Budaya Universitas Pakuan."
        :hero="$hero ?? null"
    />

    <section class="py-24 bg-surface-container-low min-h-screen" 
             x-data="{
                 openModal: false,
                 activeArchive: null,
                 showDetail(item) {
                     this.activeArchive = item;
                     this.openModal = true;
                     document.body.style.overflow = 'hidden';
                 },
                 hideDetail() {
                     this.openModal = false;
                     document.body.style.overflow = 'auto';
                 }
             }"
             @keydown.escape.window="hideDetail()"
    >
        <div class="max-w-max-width mx-auto px-margin-desktop">
            
            <!-- Search & Filters -->
            <div class="mb-14 space-y-8">
                <!-- Search Bar -->
                <form action="{{ route('archives.index') }}" method="GET" class="w-full max-w-xl mx-auto">
                    @if(request('type'))
                        <input type="hidden" name="type" value="{{ request('type') }}">
                    @endif
                    @if(request('year'))
                        <input type="hidden" name="year" value="{{ request('year') }}">
                    @endif
                    <div class="relative flex items-center">
                        <span class="absolute left-4 text-on-surface-variant material-symbols-outlined pointer-events-none text-xl">search</span>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Cari arsip kegiatan, judul, atau tahun..."
                               class="w-full pl-12 pr-12 py-3.5 bg-white border border-surface-variant/40 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-on-surface placeholder:text-on-surface-variant/60 font-body-md"
                        >
                        @if(request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="absolute right-4 text-on-surface-variant hover:text-primary transition-colors flex items-center">
                                <span class="material-symbols-outlined text-xl">close</span>
                            </a>
                        @else
                            <button type="submit" class="absolute right-2 bg-primary text-white p-2 rounded-full hover:bg-gold transition-colors flex items-center justify-center shadow-sm">
                                <span class="material-symbols-outlined text-base">arrow_forward</span>
                            </button>
                        @endif
                    </div>
                </form>

                <!-- Filter Category Badges -->
                <div class="flex flex-wrap items-center justify-center gap-2 md:gap-3">
                    <a href="{{ request()->fullUrlWithQuery(['type' => null, 'page' => 1]) }}" 
                       class="px-5 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition-all {{ !request('type') || request('type') === 'all' ? 'bg-primary text-white shadow-md' : 'bg-white text-on-surface-variant hover:bg-surface-variant/40 border border-surface-variant/30' }}">
                        Semua Kategori
                    </a>
                    @foreach($types as $type)
                        <a href="{{ request()->fullUrlWithQuery(['type' => $type, 'page' => 1]) }}" 
                           class="px-5 py-2 rounded-full text-xs font-semibold uppercase tracking-wider transition-all {{ request('type') === $type ? 'bg-primary text-white shadow-md' : 'bg-white text-on-surface-variant hover:bg-surface-variant/40 border border-surface-variant/30' }}">
                            {{ $type }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Grid Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($archives as $archive)
                    @php
                        $badgeClasses = match($archive->activity_type) {
                            'Latihan Rutin' => 'bg-blue-50 text-blue-700 border-blue-200/60',
                            'Workshop' => 'bg-amber-50 text-amber-700 border-amber-200/60',
                            'Kunjungan' => 'bg-emerald-50 text-emerald-700 border-emerald-200/60',
                            'Event Internal' => 'bg-purple-50 text-purple-700 border-purple-200/60',
                            default => 'bg-rose-50 text-rose-700 border-rose-200/60',
                        };

                        $archiveData = [
                            'id' => $archive->id,
                            'title' => $archive->title,
                            'description' => $archive->description,
                            'activity_type' => $archive->activity_type,
                            'year' => $archive->year,
                            'document_url' => $archive->document_path ? Storage::url($archive->document_path) : null,
                            'badge_class' => $badgeClasses,
                            'user_name' => $archive->user->name ?? 'Admin USB',
                        ];
                    @endphp

                    <div class="bg-white rounded-2xl border border-surface-variant/20 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col group cursor-pointer"
                         @click="showDetail({{ json_encode($archiveData) }})"
                    >
                        <!-- Card Media / Banner -->
                        <div class="aspect-[16/10] bg-surface-variant/30 relative overflow-hidden flex items-center justify-center">
                            @if($archive->document_path)
                                <img src="{{ Storage::url($archive->document_path) }}" 
                                     alt="{{ $archive->title }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                >
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-primary/5 to-surface-variant flex flex-col items-center justify-center text-primary/40 group-hover:text-primary/60 transition-colors">
                                    <span class="material-symbols-outlined text-5xl mb-2">folder_open</span>
                                    <span class="text-xs uppercase tracking-widest font-semibold">Arsip USB</span>
                                </div>
                            @endif

                            <div class="absolute top-4 left-4 right-4 flex items-center justify-between pointer-events-none">
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border shadow-sm backdrop-blur-md {{ $badgeClasses }}">
                                    {{ $archive->activity_type }}
                                </span>
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-black/60 text-white backdrop-blur-md shadow-sm">
                                    {{ $archive->year }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-7 flex-1 flex flex-col justify-between">
                            <div>
                                <h3 class="font-headline-md text-xl text-primary font-bold mb-3 leading-snug group-hover:text-gold transition-colors line-clamp-2">
                                    {{ $archive->title }}
                                </h3>

                                <div class="font-body-md text-on-surface-variant text-sm line-clamp-3 mb-6 leading-relaxed">
                                    {{ Str::limit(strip_tags($archive->description), 130) }}
                                </div>
                            </div>

                            <div class="pt-4 border-t border-surface-variant/20 flex items-center justify-between">
                                <span class="text-xs text-on-surface-variant/70 flex items-center">
                                    <span class="material-symbols-outlined text-sm mr-1 text-gold">event</span>
                                    Tahun {{ $archive->year }}
                                </span>

                                <button type="button" 
                                        class="inline-flex items-center text-xs font-bold uppercase tracking-wider text-primary group-hover:text-gold transition-colors"
                                >
                                    Detail Arsip
                                    <span class="material-symbols-outlined text-sm ml-1 transition-transform group-hover:translate-x-1">arrow_forward</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20 bg-white rounded-2xl border border-surface-variant/20">
                        <span class="material-symbols-outlined text-5xl text-on-surface-variant/40 mb-3">folder_off</span>
                        <h4 class="font-headline-md text-xl text-primary font-bold mb-2">Arsip Tidak Ditemukan</h4>
                        <p class="text-on-surface-variant text-sm">
                            Tidak ada arsip kegiatan yang sesuai dengan kriteria pencarian atau filter Anda.
                        </p>
                        @if(request()->anyFilled(['search', 'type', 'year']))
                            <a href="{{ route('archives.index') }}" class="mt-6 inline-block px-6 py-2.5 bg-primary text-white rounded-full text-xs font-semibold uppercase tracking-wider hover:bg-gold transition-colors">
                                Reset Filter
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($archives->hasPages())
                <div class="mt-16 flex justify-center">
                    {{ $archives->links() }}
                </div>
            @endif

        </div>

        <!-- Detail Modal with Alpine.js -->
        <div x-show="openModal" 
             x-cloak
             class="fixed inset-0 z-50 overflow-y-auto" 
             style="display: none;"
        >
            <!-- Backdrop -->
            <div x-show="openModal"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-black/60 backdrop-blur-sm"
                 @click="hideDetail()"
            ></div>

            <!-- Modal Dialog -->
            <div class="min-h-full flex items-center justify-center p-4 md:p-6 text-center">
                <div x-show="openModal"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                     class="w-full max-w-2xl bg-white rounded-3xl text-left shadow-2xl border border-surface-variant/30 overflow-hidden transform transition-all relative z-10"
                     @click.stop
                >
                    <!-- Modal Header Image -->
                    <template x-if="activeArchive && activeArchive.document_url">
                        <div class="relative aspect-video w-full bg-slate-900 overflow-hidden">
                            <img :src="activeArchive.document_url" 
                                 :alt="activeArchive ? activeArchive.title : ''" 
                                 class="w-full h-full object-cover"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            
                            <!-- Close button overlay -->
                            <button @click="hideDetail()" 
                                    class="absolute top-4 right-4 w-10 h-10 rounded-full bg-black/50 hover:bg-black/80 text-white flex items-center justify-center transition-colors backdrop-blur-md"
                            >
                                <span class="material-symbols-outlined text-xl">close</span>
                            </button>

                            <!-- Badges in Overlay -->
                            <div class="absolute bottom-4 left-6 right-6 flex items-center gap-3">
                                <span class="px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-gold text-primary shadow-sm"
                                      x-text="activeArchive ? activeArchive.activity_type : ''">
                                </span>
                                <span class="px-3.5 py-1 rounded-full text-xs font-bold bg-white/20 text-white backdrop-blur-md border border-white/30"
                                      x-text="activeArchive ? 'Tahun ' + activeArchive.year : ''">
                                </span>
                            </div>
                        </div>
                    </template>

                    <!-- Header without image -->
                    <template x-if="activeArchive && !activeArchive.document_url">
                        <div class="p-6 md:p-8 border-b border-surface-variant/20 flex items-center justify-between bg-surface-container-low">
                            <div class="flex items-center gap-3">
                                <span class="px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider"
                                      :class="activeArchive ? activeArchive.badge_class : ''"
                                      x-text="activeArchive ? activeArchive.activity_type : ''">
                                </span>
                                <span class="px-3.5 py-1 rounded-full text-xs font-bold bg-primary/10 text-primary"
                                      x-text="activeArchive ? 'Tahun ' + activeArchive.year : ''">
                                </span>
                            </div>
                            <button @click="hideDetail()" 
                                    class="w-9 h-9 rounded-full bg-surface-variant/60 hover:bg-surface-variant text-on-surface-variant flex items-center justify-center transition-colors"
                            >
                                <span class="material-symbols-outlined text-lg">close</span>
                            </button>
                        </div>
                    </template>

                    <!-- Modal Body -->
                    <div class="p-6 md:p-8 space-y-6">
                        <div>
                            <h2 class="font-headline-md text-2xl md:text-3xl text-primary font-bold leading-snug"
                                x-text="activeArchive ? activeArchive.title : ''">
                            </h2>
                            <div class="flex items-center gap-4 mt-3 text-xs text-on-surface-variant/80">
                                <span class="flex items-center">
                                    <span class="material-symbols-outlined text-sm mr-1 text-gold">calendar_today</span>
                                    <span x-text="activeArchive ? 'Arsip ' + activeArchive.year : ''"></span>
                                </span>
                                <span>•</span>
                                <span class="flex items-center">
                                    <span class="material-symbols-outlined text-sm mr-1 text-primary">person</span>
                                    <span x-text="activeArchive ? activeArchive.user_name : ''"></span>
                                </span>
                            </div>
                        </div>

                        <!-- Full Description -->
                        <div class="border-t border-surface-variant/20 pt-6">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-on-surface-variant/80 mb-3">Deskripsi & Catatan Kegiatan:</h4>
                            <div class="prose prose-sm md:prose-base max-w-none text-on-surface-variant font-body-md leading-relaxed"
                                 x-html="activeArchive ? activeArchive.description : ''">
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer Actions -->
                    <div class="p-6 md:p-8 bg-surface-container-low border-t border-surface-variant/20 flex items-center justify-end">
                        <button @click="hideDetail()" 
                                type="button" 
                                class="px-8 py-3 bg-primary text-white rounded-xl font-semibold text-xs uppercase tracking-wider hover:bg-gold transition-colors shadow-sm"
                        >
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</x-front-layout>
