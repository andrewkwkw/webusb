@props(['artwork'])
<div class="group cursor-pointer">
    <a href="{{ route('artworks.show', $artwork->slug ?? '#') }}">
        <div class="aspect-[4/5] overflow-hidden rounded-lg mb-6 border border-surface-variant/30 shadow-sm transition-all duration-500 group-hover:shadow-xl">
            @php
                $image = $artwork->images ? (is_array($artwork->images) ? $artwork->images[0] : json_decode($artwork->images)[0]) : null;
            @endphp
            @if($image)
                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="{{ Storage::url($image) }}" alt="{{ $artwork->title }}">
            @else
                <div class="w-full h-full bg-surface-variant flex items-center justify-center transition-transform duration-700 group-hover:scale-105">
                    <span class="material-symbols-outlined text-4xl text-on-surface-variant/50">image</span>
                </div>
            @endif
        </div>
        <div class="space-y-2">
            <span class="font-label-sm text-gold uppercase">{{ $artwork->category }}</span>
            <h3 class="font-headline-md text-headline-md text-primary leading-tight">{{ $artwork->title }}</h3>
            <p class="font-body-md text-on-surface-variant italic">Karya: {{ $artwork->creator_name ?? 'Anggota USB' }}</p>
        </div>
    </a>
</div>
