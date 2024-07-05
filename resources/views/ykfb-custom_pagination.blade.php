<div class="text-start py-4">
    <div class="custom-pagination">
        {{-- <nav class="mt-4"> --}}
        <!-- pagination -->
        {{-- <nav class="mb-md-50"> --}}

        {{-- <a href="#" class="prev">Prevous</a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#" class="next">Next</a> --}}
        @if ($paginator->hasPages())
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="prev">Previous</a>
            @else
                <a class="active" href="{{ $paginator->previousPageUrl() }}"></a>
            @endif

            @if ($paginator->currentPage() > 3)
                <a class="active" href="{{ $paginator->url(1) }}"></a>
            @endif
            @if ($paginator->currentPage() > 4)
                <a>...</a>
            @endif
            @foreach (range(1, $paginator->lastPage()) as $i)
                @if ($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                    @if ($i == $paginator->currentPage())
                        {{-- <li class="active "><a class="active page-numbers">{{ $i }}</a></li> --}}
                        <span class="active">{{ $i }}</span>
                    @else
                        <a class="active" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    @endif
                @endif
            @endforeach
            @if ($paginator->currentPage() < $paginator->lastPage() - 3)
                <a>...</a>
            @endif
            @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                <a class="active" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="next" href="{{ $paginator->nextPageUrl() }}" rel="next"></a>
            @else
                <a class="next">Previous</a>
            @endif
            {{-- </ul> --}}
        @endif
        {{-- </nav>
    </nav> --}}

    </div>
</div>
