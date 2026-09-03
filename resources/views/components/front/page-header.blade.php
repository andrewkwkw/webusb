@props(['title', 'subtitle', 'pageName' => null, 'hero' => null])
@php
    if (!$hero) {
        $queryName = $pageName ?? $title;
        $hero = \App\Models\PageHero::where('page_name', $queryName)->first();
    }
    $bgImage1 = $hero && $hero->image_path ? asset('storage/' . $hero->image_path) : null;
    $bgImage2 = $hero && $hero->image_path_2 ? asset('storage/' . $hero->image_path_2) : null;
    $hasMultipleImages = $bgImage1 && $bgImage2;
    $hasAnyImage = $bgImage1 || $bgImage2;
@endphp
<section class="relative h-[60vh] flex items-center overflow-hidden transition-all duration-1000 opacity-100 translate-y-0">
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

        @if(!$hasAnyImage)
            <div class="absolute inset-0 w-full h-full bg-white flex items-center justify-center">
                <span class="text-[10vw] font-display-lg text-primary/5 tracking-widest uppercase select-none">HERO</span>
            </div>
        @endif
        
        @if($hasAnyImage)
            <div class="absolute inset-0 bg-primary/80 dark:bg-tertiary/90"></div>
        @endif
    </div>
    <div class="relative z-10 max-w-max-width mx-auto px-margin-desktop w-full h-full flex flex-col justify-end pb-24 pt-32">
        <div class="max-w-3xl animate-fade-in-up">
            <div class="flex items-center space-x-4 mb-6">
                <div class="h-[2px] w-16 {{ $hasAnyImage ? 'bg-gold' : 'bg-primary' }}"></div>
                <span class="font-label-md uppercase tracking-[0.3em] {{ $hasAnyImage ? 'text-gold' : 'text-primary' }} font-semibold">
                    {{ $pageName ?? 'Halaman' }}
                </span>
            </div>
            
            <h1 class="font-display-lg text-3xl md:text-4xl {{ $hasAnyImage ? 'text-white drop-shadow-md' : 'text-primary' }} mb-4 leading-tight">
                {{ $title }}
            </h1>
            
            @if($subtitle)
            <div class="max-w-2xl border-l-2 {{ $hasAnyImage ? 'border-l-gold' : 'border-l-primary' }} pl-4">
                <p class="font-body-md text-sm md:text-base {{ $hasAnyImage ? 'text-white/90 drop-shadow-sm' : 'text-on-surface-variant' }} leading-relaxed">
                    {{ $subtitle }}
                </p>
            </div>
            @endif
        </div>
    </div>
</section>