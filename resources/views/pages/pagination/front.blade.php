@if ($paginator->hasPages())
    <!-- Pagination -->    
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <span><i class="fa-solid fa-angles-left"></i></span>
                </li>
                <li class="disabled">
                    <span><i class="fa-solid fa-angle-left"></i></span>
                </li>                
            @else
                <li>
                    <a href="{{ $paginator->toArray()['first_page_url'] }}">
                        <span><i class="fa-solid fa-angles-left"></i></span>
                    </a>
                </li>
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}">
                        <span><i class="fa-solid fa-angle-left"></i></span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @elseif ($page == $paginator->lastPage() - 1)
                            <li class="disabled"><span><i class="fa fa-ellipsis-h"></i></span></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}">
                        <span><i class="fa-solid fa-angle-right"></i></span>
                    </a>
                </li>
                <li>
                    <a href="{{ $paginator->toArray()['last_page_url'] }}">
                        <span><i class="fa-solid fa-angles-right"></i></span>
                    </a>
                </li>
            @else
                <li class="disabled">
                    <span>
                        <i class="fa-solid fa-angle-right"></i>
                    </span>
                </li>
                <li class="disabled">
                    <span><i class="fa-solid fa-angles-right"></i></span>
                </li>
            @endif
        </ul>    
    <!-- Pagination -->
@endif