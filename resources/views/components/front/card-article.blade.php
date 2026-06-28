@props(['article', 'type' => 'culture'])
{{-- type can be 'culture' (CulturalExploration) or 'news' (ArtNews) --}}
@php
    $route = $type === 'culture' ? route('cultures.show', $article->slug ?? '#') : route('arts.show', $article->slug ?? '#');
@endphp
<article class="bg-white p-10 rounded-2xl border border-surface-variant/20 shadow-sm hover:shadow-md transition-shadow duration-300">
    <div class="inline-block px-3 py-1 bg-gold/10 text-gold rounded mb-6 font-label-sm uppercase">{{ $article->category }}</div>
    <h4 class="font-headline-md text-headline-md text-primary mb-4 leading-tight">{{ $article->title }}</h4>
    <p class="font-body-md text-on-surface-variant mb-8 line-clamp-3">
        {{ Str::limit(strip_tags($article->content), 120) }}
    </p>
    <a href="{{ $route }}" class="font-label-lg text-primary flex items-center group">
        Baca Selengkapnya
        <span class="material-symbols-outlined ml-2 transition-transform group-hover:translate-x-1">trending_flat</span>
    </a>
</article>
