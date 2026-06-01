@if ($paginator->hasPages())
<nav class="flex flex-col sm:flex-row items-center justify-between gap-3 px-4 py-3 border-t border-gray-200">
    <div class="text-sm text-gray-500">
        Menampilkan
        <span class="font-semibold text-gray-700">{{ $paginator->firstItem() }}</span>–<span class="font-semibold text-gray-700">{{ $paginator->lastItem() }}</span>
        dari <span class="font-semibold text-gray-700">{{ $paginator->total() }}</span> data
    </div>
    <div class="flex items-center gap-1">
        {{-- Prev --}}
        @if($paginator->onFirstPage())
            <span class="px-2.5 py-1.5 text-xs rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed select-none">‹</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
               class="px-2.5 py-1.5 text-xs rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors">‹</a>
        @endif

        @foreach($elements as $element)
            @if(is_string($element))
                <span class="px-2 py-1.5 text-xs text-gray-400">{{ $element }}</span>
            @endif
            @if(is_array($element))
                @foreach($element as $page => $url)
                    @if($page == $paginator->currentPage())
                        <span class="px-2.5 py-1.5 text-xs rounded-lg bg-green-600 text-white font-semibold">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                           class="px-2.5 py-1.5 text-xs rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="px-2.5 py-1.5 text-xs rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors">›</a>
        @else
            <span class="px-2.5 py-1.5 text-xs rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed select-none">›</span>
        @endif
    </div>
</nav>
@endif
