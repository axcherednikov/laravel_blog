@if ($paginator->hasPages())
    <nav class="blog-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">@lang('pagination.previous')</a>
        @else
            <a class="btn btn-outline-primary" href="{{ $paginator->previousPageUrl() }}">@lang('pagination.previous')</a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="btn btn-outline-primary" href="{{ $paginator->nextPageUrl() }}">@lang('pagination.next')</a>
        @else
            <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">@lang('pagination.next')</a>
        @endif
    </nav>
@endif
