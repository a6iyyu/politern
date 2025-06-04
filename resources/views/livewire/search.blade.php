<fieldset class="flex w-full flex-col justify-between">
    <label for="{{ $name }}" class="font-medium text-sm">
        @if ($required)
            {{ $label }} <span class="text-red-500">*</span>
        @endif
    </label>
    <div class="relative">
        @if (!empty($icon))
            <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-500">
                <i class="{{ $icon }}"></i>
            </span>
        @endif
        <input
            wire:model.debounce.500ms="query"
            name="{{ $name }}"
            type="search"
            placeholder="{{ $placeholder ?? 'Masukkan kata kunci' }}"
            class="appearance-none w-full rounded-lg border-1 text-sm transition-all duration-200 border-[var(--stroke)] pl-12 py-2.5 pr-4 lg:focus:outline-none lg:focus:border-[var(--primary)]"
            @if ($required) required @endif
        />
    </div>
    @if (!empty($results))
        <section class="relative mt-2 bg-white border rounded shadow">
            <ul>
                @foreach ($results as $item)
                    <li class="p-2 hover:bg-gray-100 cursor-pointer">
                        {{ $item['name'] ?? 'No Name' }}
                    </li>
                @endforeach
            </ul>
        </section>
    @endif
</fieldset>