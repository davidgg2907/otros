@if ($paginator->hasPages())

  <nav aria-label="Page navigation mb-3">
  <ul class="pagination justify-content-left">


    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Anterior">«</a></li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <li class="disabled"><span></span></li>
            <li class="page-item disabled"><span>{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                    <li class="active"><span></span></li>
                @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    <li><a href="{{ $url }}"></a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">»</a></li>
    @endif


  </ul>
  </nav>
@endif
