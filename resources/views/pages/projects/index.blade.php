<x-front-layout>
    <x-front.page-header 
        title="Proyek Kami" 
        pageName="Proyek"
        subtitle="Melihat langsung kolaborasi besar dan karya unggulan dalam bentuk video dokumenter." 
        :hero="$hero ?? null" 
    />

    <section class="py-24 bg-white">
        <div class="max-w-max-width mx-auto px-margin-desktop">
            <div class="space-y-16">
                @forelse($projects as $project)
                    <div class="bg-surface-container-low p-8 md:p-10 rounded-3xl border border-surface-variant/30 flex flex-col md:flex-row gap-8 shadow-sm hover:shadow-xl transition-all duration-300 relative overflow-hidden group">
                        
                        <!-- Media Container (Interactive Video Player / Cover Image) -->
                        <div class="w-full md:w-1/2 aspect-video rounded-2xl overflow-hidden shadow-sm bg-slate-900 relative"
                             x-data="{ isPlaying: false }"
                        >
                            @if(!empty($project->youtube_embed_url))
                                <!-- On-Demand Video Iframe -->
                                <template x-if="isPlaying">
                                    <iframe class="w-full h-full" 
                                            src="{{ $project->youtube_embed_url }}&autoplay=1" 
                                            title="{{ $project->title }}" 
                                            frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                            allowfullscreen
                                    ></iframe>
                                </template>

                                <!-- Cover Preview with Play Button -->
                                <div x-show="!isPlaying" 
                                     class="relative w-full h-full cursor-pointer group/media overflow-hidden"
                                     @click="isPlaying = true"
                                >
                                    @if($project->cover_image_path)
                                        <img src="{{ Storage::url($project->cover_image_path) }}" 
                                             alt="{{ $project->title }}" 
                                             class="w-full h-full object-cover group-hover/media:scale-105 transition-transform duration-700"
                                        >
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-primary to-slate-900 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-6xl text-white/40">movie</span>
                                        </div>
                                    @endif

                                    <div class="absolute inset-0 bg-black/40 group-hover/media:bg-black/25 transition-colors flex items-center justify-center">
                                        <div class="w-16 h-16 rounded-full bg-gold text-primary flex items-center justify-center shadow-2xl transform group-hover/media:scale-110 transition-transform duration-300">
                                            <span class="material-symbols-outlined text-3xl ml-0.5">play_arrow</span>
                                        </div>
                                    </div>
                                </div>
                            @elseif($project->cover_image_path)
                                <img src="{{ Storage::url($project->cover_image_path) }}" 
                                     alt="{{ $project->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-primary/10 text-primary/40">
                                    <span class="material-symbols-outlined text-5xl">video_library</span>
                                </div>
                            @endif

                            @if($project->is_coming_soon)
                                <div class="absolute top-4 left-4 z-10 pointer-events-none">
                                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-gold text-primary font-bold text-xs uppercase tracking-widest rounded-full shadow-lg backdrop-blur-md">
                                        <span class="material-symbols-outlined text-sm">schedule</span>
                                        Coming Soon
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Project Information -->
                        <div class="w-full md:w-1/2 flex flex-col justify-center">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="inline-block px-3.5 py-1 bg-gold/15 text-secondary rounded-full font-label-sm font-bold uppercase tracking-wider">
                                    {{ $project->category }}
                                </span>
                            </div>

                            <h3 class="font-headline-lg text-2xl md:text-3xl text-primary font-bold mb-4 leading-tight group-hover:text-gold transition-colors">
                                {{ $project->title }}
                            </h3>

                            <div class="font-body-md text-on-surface-variant text-sm md:text-base leading-relaxed rich-text mb-6">
                                {!! Str::limit(strip_tags($project->description ?? $project->content), 250) !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-on-surface-variant italic py-20 bg-surface-container-low rounded-3xl border border-surface-variant/20">
                        Belum ada proyek yang dipublikasikan.
                    </div>
                @endforelse
            </div>

            @if($projects->hasPages())
                <div class="mt-16 flex justify-center">
                    {{ $projects->links() }}
                </div>
            @endif
        </div>
    </section>
</x-front-layout>