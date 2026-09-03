@props([
    'placeholder' => 'Cari...',
    'action' => url()->current(),
])

<form action="{{ $action }}" method="GET" class="w-full max-w-xl mx-auto mb-12">
    @if(request()->has('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
    @endif
    
    <div class="relative flex items-center">
        <span class="absolute left-4 text-on-surface-variant material-symbols-outlined pointer-events-none">search</span>
        <input type="text" 
               name="search" 
               value="{{ request('search') }}" 
               placeholder="{{ $placeholder }}"
               class="w-full pl-12 pr-12 py-3 bg-surface border border-surface-variant/50 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-on-surface placeholder:text-on-surface-variant/70 font-body-md"
        >
        @if(request('search'))
            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="absolute right-4 text-on-surface-variant hover:text-primary transition-colors flex items-center">
                <span class="material-symbols-outlined text-xl">close</span>
            </a>
        @else
            <button type="submit" class="absolute right-2 bg-primary text-white p-1.5 rounded-full hover:bg-gold transition-colors flex items-center justify-center">
                <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </button>
        @endif
    </div>
</form>
