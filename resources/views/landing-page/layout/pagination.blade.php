@if ($paginator->hasPages())
<div class="ns-blog-list-pagination mb-50">
    @if (!$paginator->onFirstPage())
    <a href="{{ $paginator->previousPageUrl() }}" class="ns-pagination-btn"><i class="icofont-rounded-left"></i></a>
    @endif

    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="relative inline-flex items-center px-2 text-sm font-medium cursor-default">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <a href="#" class="ns-pagination-btn active">{{ $page }}</a>
                @else
                    <a href="{{ $url }}" class="ns-pagination-btn">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" class="ns-pagination-btn"><i class="icofont-rounded-right"></i></a>
    @endif    

</div>
@endif