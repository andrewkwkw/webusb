<x-front-layout>
    <x-front.page-header 
        title="Proyek Kami" 
        pageName="Proyek"
        subtitle="Melihat langsung kolaborasi besar dan karya unggulan dalam bentuk video dokumenter."
    />

    <section class="py-24 bg-white">
        <div class="max-w-max-width mx-auto px-margin-desktop">
            <div class="space-y-16">
                @forelse($projects as $project)
                    <div class="bg-surface-container-low p-8 rounded-2xl border border-surface-variant/30 flex flex-col md:flex-row gap-8">
                        @if($project->video_embed_url)
                            <div class="w-full md:w-1/2 aspect-video rounded-lg overflow-hidden shadow-sm">
                                <iframe class="w-full h-full" src="{{ $project->video_embed_url }}" title="{{ $project->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        @elseif($project->cover_image_path)
                            <div class="w-full md:w-1/2 aspect-video rounded-lg overflow-hidden shadow-sm">
                                <img src="{{ Storage::url($project->cover_image_path) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        
                        <div class="w-full md:w-1/2 flex flex-col justify-center">
                            <span class="inline-block px-3 py-1 w-max bg-gold/10 text-gold rounded font-label-sm uppercase mb-4">{{ $project->category }}</span>
                            <h3 class="font-headline-lg text-3xl text-primary mb-4">{{ $project->title }}</h3>
                            <div class="font-body-md text-on-surface-variant mb-6 prose prose-sm">
                                {!! Str::limit($project->description ?? $project->content, 250) !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-on-surface-variant italic py-20">
                        Belum ada proyek yang dipublikasikan.
                    </div>
                @endforelse
            </div>
            
            <div class="mt-16 flex justify-center">
                {{ $projects->links() }}
            </div>
        </div>
    </section>
</x-front-layout>
