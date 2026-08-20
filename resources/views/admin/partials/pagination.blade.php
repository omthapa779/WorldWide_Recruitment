@if ($paginator->hasPages())
    <div class="adm-pagination">
        <span class="adm-pagination-info">
            Showing {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} of {{ $paginator->total() }}
        </span>

        <div class="adm-pagination-links">
            @if ($paginator->onFirstPage())
                <span class="adm-page-link is-disabled">Prev</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="adm-page-link" rel="prev">Prev</a>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="adm-page-link is-disabled">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="adm-page-link is-active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="adm-page-link">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="adm-page-link" rel="next">Next</a>
            @else
                <span class="adm-page-link is-disabled">Next</span>
            @endif
        </div>
    </div>
@endif
