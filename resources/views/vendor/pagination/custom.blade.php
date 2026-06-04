<nav>
    <ul class="pagination">
        {{-- Always show page 1 --}}
        <li class="page-item {{ $paginator->currentPage() == 1 ? 'active' : '' }}">
            @if ($paginator->currentPage() == 1)
                <span class="page-link">1</span>
            @else
                <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
            @endif
        </li>
        
        {{-- Show other pages if they exist --}}
        @if ($paginator->lastPage() > 1)
            {{-- Calculate range around current page --}}
            @php
                $start = max(2, $paginator->currentPage() - 2);
                $end = min($paginator->lastPage() - 1, $paginator->currentPage() + 2);
                
                // Ensure we always show some pages
                if ($end - $start < 4) {
                    if ($start == 2) {
                        $end = min($paginator->lastPage() - 1, $start + 4);
                    } else {
                        $start = max(2, $end - 4);
                    }
                }
            @endphp
            
            {{-- Show dots after page 1 if needed --}}
            @if ($start > 2)
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif
            
            {{-- Show pages around current page --}}
            @for ($page = $start; $page <= $end; $page++)
                <li class="page-item {{ $paginator->currentPage() == $page ? 'active' : '' }}">
                    @if ($paginator->currentPage() == $page)
                        <span class="page-link">{{ $page }}</span>
                    @else
                        <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                    @endif
                </li>
            @endfor
            
            {{-- Show dots before last page if needed --}}
            @if ($end < $paginator->lastPage() - 1)
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif
            
            {{-- Always show last page if different from page 1 --}}
            @if ($paginator->lastPage() > 1)
                <li class="page-item {{ $paginator->currentPage() == $paginator->lastPage() ? 'active' : '' }}">
                    @if ($paginator->currentPage() == $paginator->lastPage())
                        <span class="page-link">{{ $paginator->lastPage() }}</span>
                    @else
                        <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
                    @endif
                </li>
            @endif
        @endif
    </ul>
</nav>
