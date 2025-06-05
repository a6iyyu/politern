@if ($paginator->hasPages())
    <section class="mt-6 flex flex-col items-center justify-between gap-4 rounded-lg border border-[var(--stroke)] p-4 sm:flex-row" role="navigation">
        <div class="flex items-center text-sm text-[var(--secondary-text)]">
            <label for="per_page" class="mr-3">Tampil:</label>
            <select
                id="per_page"
                name="per_page"
                onchange="update_per_page(this.value)"
                class="appearance-none rounded-md border border-[var(--stroke)] px-3 py-1.5"
            >
                @foreach ([10, 25, 50, 100] as $perPageOption)
                    <option value="{{ $perPageOption }}" {{ Request::input('per_page', 10) == $perPageOption ? 'selected' : '' }}>
                        {{ $perPageOption }}
                    </option>
                @endforeach
            </select>
            <span class="ml-2 text-sm">per halaman</span>
        </div>
        <nav class="hidden text-xs text-[var(--secondary-text)] md:block">
            Tampilkan
            <span>{{ $paginator->firstItem() ?? $paginator->count() }}</span>
            sampai
            <span>{{ $paginator->lastItem() }}</span>
            dari
            <span>{{ $paginator->total() }}</span>
            hasil
        </nav>
        <nav class="flex items-center space-x-1">
            <a
                href="{{ $paginator->previousPageUrl() }}"
                class="{{ $paginator->onFirstPage() ? 'cursor-not-allowed opacity-50' : 'lg:hover:bg-[#c0bbff]' }} text-white-600 flex h-8 w-8 items-center justify-center rounded-md border border-gray-200 bg-white transition-colors"
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
            <a href="{{ $paginator->url(1) }}" class="{{ $current == 1 ? 'bg-[var(--primary)] text-white' : 'text-white-700 border-gray-200 bg-white lg:hover:bg-[#c0bbff]' }} flex h-8 min-w-[2rem] items-center justify-center rounded-md border text-sm transition-colors">
                1
            </a>
            @if ($start > 2)
                <span class="text-white px-1">...</span>
            @endif
            @for ($i = $start; $i <= $end; $i++)
                <a href="{{ $paginator->url($i) }}" class="{{ $current == $i ? 'bg-[var(--primary)] text-white' : 'text-white-700 border-gray-200 bg-white lg:hover:bg-[#c0bbff]' }} flex h-8 min-w-[2rem] items-center justify-center rounded-md border text-sm transition-colors">
                    {{ $i }}
                </a>
            @endfor
            @if ($end < $last - 1)
                <span class="text-white px-1">...</span>
            @endif
            @if ($last > 1)
                <a href="{{ $paginator->url($last) }}" class="{{ $current == $last ? 'bg-[var(--primary)] text-white' : 'text-white-700 border-gray-200 bg-white lg:hover:bg-[#c0bbff]' }} flex h-8 min-w-[2rem] items-center justify-center rounded-md border text-sm transition-colors">
                    {{ $last }}
                </a>
            @endif
            <a
                href="{{ $paginator->nextPageUrl() }}"
                class="{{ $paginator->hasMorePages() ? 'lg:hover:bg-[#c0bbff]' : 'cursor-not-allowed opacity-50' }} text-white-600 flex h-8 w-8 items-center justify-center rounded-md border border-gray-200 bg-white transition-colors"
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