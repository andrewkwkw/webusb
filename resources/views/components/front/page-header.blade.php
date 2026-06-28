@props(['title', 'subtitle', 'pageName' => null])
@php
    $queryName = $pageName ?? $title;
    $hero = \App\Models\PageHero::where('page_name', $queryName)->first();
    $bgImage = null;
    if ($hero && $hero->image_path) {
        $bgImage = asset('storage/' . $hero->image_path);
    }
@endphp
<section class="relative h-[60vh] flex items-center overflow-hidden transition-all duration-1000 opacity-100 translate-y-0">
    <div class="absolute inset-0 z-0">
        @if($bgImage)
            <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ $bgImage }}')"></div>
            <div class="absolute inset-0 bg-primary/80 dark:bg-tertiary/90"></div>
        @else
            <div class="w-full h-full bg-white flex items-center justify-center">
                <span class="text-[10vw] font-display-lg text-primary/5 tracking-widest uppercase select-none">HERO</span>
            </div>
        @endif
    </div>
    <div class="relative z-10 max-w-max-width mx-auto px-margin-desktop w-full text-center mt-20">
        <h1 class="font-display-lg text-display-lg {{ $bgImage ? 'text-white' : 'text-primary' }} mb-6">{{ $title }}</h1>
        <p class="font-body-lg {{ $bgImage ? 'text-white/80' : 'text-on-surface-variant' }} max-w-2xl mx-auto">{{ $subtitle }}</p>
    </div>
</section>