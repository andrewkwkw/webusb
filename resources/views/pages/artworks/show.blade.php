<x-front-layout>
    <section class="py-24 bg-white mt-20">
        <div class="max-w-4xl mx-auto px-margin-desktop">
            <a href="{{ route('artworks.index') }}" class="text-primary hover:text-gold transition-colors font-label-lg mb-8 inline-flex items-center">
                <span class="material-symbols-outlined mr-2">arrow_back</span> Kembali ke Galeri
            </a>
            
            <h1 class="font-headline-lg text-4xl text-primary mb-4">{{ $artwork->title }}</h1>
            <div class="flex items-center space-x-4 text-sm text-on-surface-variant font-label-lg mb-8 border-b border-surface-variant pb-8">
                <span>{{ $artwork->category }}</span>
                <span>•</span>
                <span>{{ $artwork->creator_name ?? 'UKM Seni Budaya' }}</span>
                <span>•</span>
                <span>{{ $artwork->publication_year }}</span>
            </div>

            <div class="prose prose-lg max-w-none font-body-md text-on-surface-variant mb-12">
                {!! $artwork->description !!}
            </div>
            
            @if($artwork->video_url)
                <div class="aspect-video w-full rounded-2xl overflow-hidden mb-12">
                    <iframe src="{{ $artwork->video_url }}" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                </div>
            @endif
        </div>
    </section>
</x-front-layout>
