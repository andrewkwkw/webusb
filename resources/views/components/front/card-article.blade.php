@props(['article', 'type' => 'culture'])
@php
    $route = $type === 'culture' ? route('cultures.show', $article->slug ?? '#') : route('arts.show', $article->slug ?? '#');
@endphp
<article class="bg-white rounded-2xl border border-surface-variant/20 shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden flex flex-col h-full">
    @if(!empty($article->image_path))
        <a href="{{ $route }}" class="block aspect-[16/10] overflow-hidden group">
            <img src="{{ Storage::url($article->image_path) }}" alt="{{ $article->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
        </a>
    @endif
    <div class="p-8 flex-1 flex flex-col">
        <div class="inline-block px-3 py-1 bg-gold/10 text-gold rounded mb-4 font-label-sm uppercase self-start">{{ $article->category }}</div>
        <h4 class="font-headline-md text-headline-md text-primary mb-3 leading-tight font-bold">
            <a href="{{ $route }}" class="hover:text-gold transition-colors">{{ $article->title }}</a>
        </h4>
        <p class="font-body-md text-on-surface-variant mb-6 line-clamp-3 flex-1 text-sm leading-relaxed">
            {{ Str::limit(strip_tags($article->content), 120) }}
        </p>
        <a href="{{ $route }}" class="font-label-lg text-primary flex items-center group mt-auto hover:text-gold transition-colors text-sm font-semibold">
            Baca Selengkapnya
            <span class="material-symbols-outlined ml-2 transition-transform group-hover:translate-x-1">trending_flat</span>
        </a>
    </div>
</article>
