<fieldset class="flex w-full flex-col justify-between @if (empty($info)) space-y-4 @endif">
    <label for="{{ $name }}" class="font-medium text-sm">
        @if (!empty($required))
            {{ $label }} <span class="text-red-500">*</span>
        @endif
    </label>
    @if (!empty($info))
        <h6 class="cursor-default mt-1 mb-3 text-xs text-red-500">{{ $info }}</h6>
    @endif
    <div class="relative">
        @if (!empty($icon) && $type !== 'file')
            <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-500">
                <i class="{{ $icon }}"></i>
            </span>
        @endif
        <input
            name="{{ $name }}"
            type="{{ $type ?? 'text' }}"
            id="{{ $name }}"
            class="appearance-none w-full rounded-lg border-1 text-sm transition-all duration-200 border-[#8d8d8d]/50
                @if ($type !== 'file') pl-12 py-2.5 @endif
                {{ $type === 'password' ? 'pr-12' : 'pr-4' }}
                lg:focus:outline-none lg:focus:border-[#5955b2]
                @if ($type === 'file') file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded file:bg-[var(--green-tertiary)] file:text-white file:cursor-pointer @endif"
            value="{{ $type !== 'file' ? $value : '' }}"
            @if ($type === 'number') oninput="this.value = this.value.replace(/[^0-9]/g, '')" onwheel="this.blur()" @endif
            @if ($type === 'text') oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" @endif
            @if (!empty($required)) required @endif
            {{ $attributes ?? '' }}
        />
        @if ($type === 'password')
            <i class="fa-solid fa-eye cursor-pointer absolute top-1/2 right-0 -translate-y-1/2 pr-4 text-gray-500"></i>
        @endif
    </div>
</fieldset>