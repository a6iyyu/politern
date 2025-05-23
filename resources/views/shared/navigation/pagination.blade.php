@if ($paginator->hasPages())
    <section class="bg-green-medium mt-6 flex flex-col items-center justify-between gap-4 rounded-lg border border-emerald-100 p-4 shadow-sm sm:flex-row" role="navigation">
        <div class="flex items-center">
            <label for="per_page" class="mr-3 text-sm text-white">Show:</label>
            <select
                id="per_page"
                name="per_page"
                onchange="update_per_page(this.value)"
                class="bg-green-medium appearance-none rounded-md border border-gray-200 px-3 py-1.5 text-sm text-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
            >
                @foreach ([5, 10, 25, 50, 100] as $perPageOption)
                    <option value="{{ $perPageOption }}" {{ Request::input('per_page', 10) == $perPageOption ? 'selected' : '' }}>
                        {{ $perPageOption }}
                    </option>
                @endforeach
            </select>
            <span class="ml-2 text-sm text-white">per page</span>
        </div>
        <nav class="hidden text-sm text-white md:block">
            Showing
            <span class="font-medium text-white">{{ $paginator->firstItem() ?? $paginator->count() }}</span>
            to
            <span class="font-medium text-white">{{ $paginator->lastItem() }}</span>
            of
            <span class="font-medium text-white">{{ $paginator->total() }}</span>
            results
        </nav>
        <nav class="flex items-center space-x-1">
            <a
                href="{{ $paginator->previousPageUrl() }}"
                class="{{ $paginator->onFirstPage() ? 'cursor-not-allowed opacity-50' : 'hover:bg-emerald-50' }} text-white-600 flex h-8 w-8 items-center justify-center rounded-md border border-gray-200 bg-white transition-colors"
                {{ $paginator->onFirstPage() ? 'aria-disabled=true' : '' }}
            >
                <i class="fas fa-chevron-left text-xs"></i>
            </a>
            @php
                $current = $paginator->currentPage();
                $last = $paginator->lastPage();
                $start = max(2, $current - 1);
                $end = min($last - 1, $current + 1);
            @endphp
            <a href="{{ $paginator->url(1) }}" class="{{ $current == 1 ? 'border-emerald-600 bg-emerald-600 text-white' : 'text-white-700 border-gray-200 bg-white hover:bg-emerald-50' }} flex h-8 min-w-[2rem] items-center justify-center rounded-md border text-sm transition-colors">
                1
            </a>
            @if ($start > 2)
                <span class="text-white px-1">...</span>
            @endif
            @for ($i = $start; $i <= $end; $i++)
                <a href="{{ $paginator->url($i) }}"
                   class="{{ $current == $i ? 'border-emerald-600 bg-emerald-600 text-white' : 'text-white-700 border-gray-200 bg-white hover:bg-emerald-50' }} flex h-8 min-w-[2rem] items-center justify-center rounded-md border text-sm transition-colors">
                    {{ $i }}
                </a>
            @endfor
            @if ($end < $last - 1)
                <span class="text-white px-1">...</span>
            @endif
            @if ($last > 1)
                <a href="{{ $paginator->url($last) }}"
                   class="{{ $current == $last ? 'border-emerald-600 bg-emerald-600 text-white' : 'text-white-700 border-gray-200 bg-white hover:bg-emerald-50' }} flex h-8 min-w-[2rem] items-center justify-center rounded-md border text-sm transition-colors">
                    {{ $last }}
                </a>
            @endif
            <a
                href="{{ $paginator->nextPageUrl() }}"
                class="{{ $paginator->hasMorePages() ? 'hover:bg-emerald-50' : 'cursor-not-allowed opacity-50' }} text-white-600 flex h-8 w-8 items-center justify-center rounded-md border border-gray-200 bg-white transition-colors"
                {{ $paginator->hasMorePages() ? '' : 'aria-disabled=true' }}
            >
                <i class="fas fa-chevron-right text-xs"></i>
            </a>
        </nav>
    </section>
@endif

<script>
    const update_per_page = (value) => {
        const url = new URL(window.location.href);
        url.searchParams.set('per_page', value);
        if (url.searchParams.get('page') === '1') url.searchParams.delete('page');
        window.location.replace(url.toString());
    };
</script>