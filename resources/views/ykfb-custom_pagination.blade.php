@if ($paginator->hasPages())
    <div class="text-start py-4">
        <div class="custom-pagination">
            @if ($paginator->onFirstPage())
                {{-- <span class="prev">Previous</span> --}}
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="prev">Previous</a>
            @endif

            @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a href="{{ $url }}" class="active">{{ $page }}</a>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="next">Next</a>
            @else
                {{-- <span class="next">Next</span> --}}
            @endif
        </div>
    </div>
@endif
