<p class="m-0 text-muted">Showing <span>{{ $paginator->firstItem() }}</span> to  <span>{{ $paginator->lastItem() }}</span> of <span>{{ $paginator->total() }}</span> entries</p>
@if ($paginator->hasPages())
<ul class="pagination m-0 ms-auto">
    @if (!$paginator->onFirstPage())
    <li class="page-item">
        <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="15 6 9 12 15 18"></polyline></svg>
            prev
        </a>
    </li>
    @endif

    @foreach ($elements as $element)
        @if (is_array($element))
            @foreach ($element as $page => $url)
                <li class="page-item @if($page == $paginator->currentPage())active @endif"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
    <li class="page-item">
        <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
            next
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><polyline points="9 6 15 12 9 18"></polyline></svg>
        </a>
    </li>
    @endif
</ul>
@endif