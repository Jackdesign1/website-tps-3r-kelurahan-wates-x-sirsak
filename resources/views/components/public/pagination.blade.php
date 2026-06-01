@if ($paginator->hasPages())
<nav class="flex items-center justify-between mt-6">
    <div class="text-sm text-gray-500">
        Menampilkan {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} dari {{ $paginator->total() }} data
    </div>
    <div class="flex items-center gap-1">
        @if($paginator->onFirstPage())
            <span class="px-3 py-1.5 text-sm rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">‹</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1.5 text-sm rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50">‹</a>
        @endif

        @foreach($elements as $element)
            @if(is_string($element))
                <span class="px-2 py-1.5 text-sm text-gray-400">{{ $element }}</span>
            @endif
            @if(is_array($element))
                @foreach($element as $page => $url)
                    @if($page == $paginator->currentPage())
                        <span class="px-3 py-1.5 text-sm rounded-lg bg-green-600 text-white font-semibold">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-1.5 text-sm rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1.5 text-sm rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50">›</a>
        @else
            <span class="px-3 py-1.5 text-sm rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">›</span>
        @endif
    </div>
</nav>
@endif
