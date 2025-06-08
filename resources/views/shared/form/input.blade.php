<fieldset class="flex w-full flex-col justify-between @if (empty($info)) space-y-4 @endif">
    <label for="{{ $name }}" class="font-medium text-sm text-[var(--primary-text)]">
        @if (!empty($required))
            {{ $label }} <span class="text-red-500">*</span>
        @elseif (empty($required) && $type === 'file')
            {{ $label }}
        @endif
    </label>
    @if (!empty($info))
        <h6 class="cursor-default mt-1 mb-3 text-xs text-red-500">{{ $info }}</h6>
    @endif
    <div class="relative">
        @if (!empty($icon) && $type !== 'file')
            <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-[var(--stroke)]">
                <i class="{{ $icon }}"></i>
            </span>
        @endif
        <input
            name="{{ $name }}"
            type="{{ $type ?? 'text' }}"
            class="{{ $name }} appearance-none w-full rounded-lg border-1 text-sm transition-all duration-200 border-[var(--stroke)]
                @if ($type !== 'file') pl-12 py-2.5 @endif
                {{ $type === 'password' ? 'pr-12' : 'pr-4' }}
                lg:focus:outline-none lg:focus:border-[var(--primary)] text-[var(--primary-text)]
                @if ($type === 'file') file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded file:bg-[var(--green-tertiary)] file:text-white file:cursor-pointer @endif"
            value="{{ $type !== 'file' ? $value : '' }}"
            @if ($type === 'number') step="any" oninput="this.value = this.value.replace(/[^0-9.,]/g, ''); if ((this.value.match(/,/g) || []).length > 1) this.value = this.value.slice(0, -1)))" onwheel="this.blur()" @endif
            @if ($type === 'text') oninput="this.value = this.value.replace(/[^a-zA-Z0-9\s.,?!:;'\-&quot;\-\()\/]/g, '')" @endif
            @if (!empty($required)) required @endif
            {{ $attributes ?? '' }}
        />
        @if ($type === 'password')
            <i class="fa-solid fa-eye cursor-pointer absolute top-1/2 right-0 -translate-y-1/2 pr-4 text-gray-500"></i>
        @endif
    </div>
</fieldset>