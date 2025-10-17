@if ($paginator->hasPages())
<nav>
    <ul class="pagination pagination-gutter pagination-primary no-bg">
        @if ($paginator->onFirstPage())
        <li class="page-item page-indicator">
            <button class="btn btn-primary light px-2 btn-sm" disabled>
                <i class="la la-angle-left"></i>
            </button>
        </li>
        @else
        <li class="page-item page-indicator">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                <i class="la la-angle-left"></i>
            </a>
        </li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span aria-disabled="true">
                    <span class="relative inline-flex items-center px-2 text-sm font-medium cursor-default">{{ $element }}</span>
                </span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <a class="page-link" href="#">{{ $page }}</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
        <li class="page-item page-indicator">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                <i class="la la-angle-right"></i>
            </a>
        </li>
        @else
        <li class="page-item page-indicator">
            <button class="btn btn-primary light px-2 btn-sm" disabled>
                <i class="la la-angle-right"></i>
            </button>
        </li>
        @endif
    </ul>
</nav>
@endif