<x-front-layout>
    <section class="py-24 bg-white mt-20">
        <div class="max-w-4xl mx-auto px-margin-desktop">
            <a href="{{ route('arts.index') }}" class="text-primary hover:text-gold transition-colors font-label-lg mb-8 inline-flex items-center">
                <span class="material-symbols-outlined mr-2">arrow_back</span> Kembali ke Denyut Seni
            </a>
            
            <h1 class="font-headline-lg text-4xl text-primary mb-4">{{ $art->title }}</h1>
            <div class="flex items-center space-x-4 text-sm text-on-surface-variant font-label-lg mb-8 border-b border-surface-variant pb-8">
                <span>{{ $art->category }}</span>
                <span>•</span>
                <span>{{ $art->created_at->format('d M Y') }}</span>
            </div>

            @if($art->image_path)
                <img src="{{ Storage::url($art->image_path) }}" alt="{{ $art->title }}" class="w-full h-auto max-h-[500px] object-cover rounded-2xl mb-12">
            @endif

            <div class="prose prose-lg max-w-none font-body-md text-on-surface-variant">
                {!! $art->content !!}
            </div>
        </div>
    </section>
</x-front-layout>
