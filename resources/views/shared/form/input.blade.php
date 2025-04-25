<fieldset class="flex w-full flex-col justify-between @if (empty($info)) space-y-4 @endif">
    <label for="{{ $name }}" class="font-medium">
        {{ $label }}
        @if (!empty($required))
            <span class="text-red-500">*</span>
        @endif
    </label>
    @if (!empty($info))
        <h6 class="cursor-default mt-1 mb-3 text-xs text-red-500">{{ $info }}</h6>
    @endif
    <div class="relative">
        @if (!empty($icon))
            <span class="absolute inset-y-0 left-0 flex items-center pl-5 text-gray-500">
                <i class="{{ $icon }}"></i>
            </span>
        @endif
        <input
            name="{{ $name }}"
            type="{{ $type ?? 'text' }}"
            id="{{ $name }}"
            class="appearance-none w-full rounded-lg border-2 pl-12 pr-4 py-2.75 transition-all duration-200 focus:outline-none focus:border-[#1a4167] focus:ring-2 focus:ring-[#1a4167]/20 @error($name) border-red-500 @enderror"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            @if ($type === 'number') oninput="this.value = this.value.replace(/[^0-9]/g, '')" @endif
            @if (!empty($required)) required @endif
            {{ $attributes ?? '' }}
            autofocus
        />
    </div>
</fieldset>