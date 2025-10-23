@if($paginator->hasPages())
<div class="bg-white shadow-md rounded-lg p-4 mt-6">
    <div class="flex items-center justify-between flex-col sm:flex-row gap-4">
        <!-- Showing results -->
        <div class="text-sm text-gray-700">
            Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
        </div>

        <!-- Pagination Links -->
        <div class="flex space-x-2">
            <!-- Previous Page Link -->
            @if($paginator->onFirstPage())
                <span class="px-3 py-1 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed text-sm">
                    Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm transition-colors">
                    Previous
                </a>
            @endif

            <!-- Pagination Elements -->
            @php
                $elements = $paginator->links()->elements;
                $currentPage = $paginator->currentPage();
                $lastPage = $paginator->lastPage();

                // Show limited pages with ellipsis for better UX
                $start = max(1, $currentPage - 2);
                $end = min($lastPage, $currentPage + 2);

                if ($start > 1) {
                    $start = max(1, $currentPage - 1);
                    $end = min($lastPage, $currentPage + 1);
                }

                if ($end < $lastPage) {
                    $end = min($lastPage, $currentPage + 2);
                }
            @endphp

            @for($page = $start; $page <= $end; $page++)
                @if($page == $currentPage)
                    <span class="px-3 py-1 border border-teal-600 bg-teal-600 text-white rounded-lg text-sm">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $paginator->url($page) }}" class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm transition-colors">
                        {{ $page }}
                    </a>
                @endif
            @endfor

            <!-- Show ellipsis and last page if needed -->
            @if($end < $lastPage)
                <span class="px-3 py-1 text-gray-500">...</span>
                <a href="{{ $paginator->url($lastPage) }}" class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm transition-colors">
                    {{ $lastPage }}
                </a>
            @endif

            <!-- Next Page Link -->
            @if($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 text-sm transition-colors">
                    Next
                </a>
            @else
                <span class="px-3 py-1 border border-gray-300 rounded-lg text-gray-400 cursor-not-allowed text-sm">
                    Next
                </span>
            @endif
        </div>
    </div>
</div>
@endif
