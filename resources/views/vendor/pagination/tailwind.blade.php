@if ($paginator->hasPages())
    <div class="flex flex-col sm:flex-row gap-4 items-center justify-between w-full mt-10">
        <div>
            <p class="text-sm font-body-md text-on-surface-variant">
                {!! __('Menampilkan') !!}
                @if ($paginator->firstItem())
                    <span class="font-bold text-primary">{{ $paginator->firstItem() }}</span>
                    {!! __('hingga') !!}
                    <span class="font-bold text-primary">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                {!! __('dari') !!}
                <span class="font-bold text-primary">{{ $paginator->total() }}</span>
                {!! __('hasil') !!}
            </p>
        </div>

        <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center space-x-1">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-400 bg-white border border-gray-200 cursor-not-allowed rounded-md shadow-sm">
                    <span class="material-symbols-outlined text-lg">chevron_left</span>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-primary bg-white border border-gray-200 rounded-md shadow-sm hover:bg-gold hover:text-white transition-colors duration-200">
                    <span class="material-symbols-outlined text-lg">chevron_left</span>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-500 bg-white border border-gray-200 cursor-default rounded-md shadow-sm">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="inline-flex items-center justify-center w-10 h-10 text-sm font-bold text-white bg-primary border border-primary cursor-default rounded-md shadow-sm">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-primary bg-white border border-gray-200 rounded-md shadow-sm hover:bg-gold hover:text-white transition-colors duration-200">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-primary bg-white border border-gray-200 rounded-md shadow-sm hover:bg-gold hover:text-white transition-colors duration-200">
                    <span class="material-symbols-outlined text-lg">chevron_right</span>
                </a>
            @else
                <span class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-400 bg-white border border-gray-200 cursor-not-allowed rounded-md shadow-sm">
                    <span class="material-symbols-outlined text-lg">chevron_right</span>
                </span>
            @endif
        </nav>
    </div>
@endif
