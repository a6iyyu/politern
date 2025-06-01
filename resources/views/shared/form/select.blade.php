<fieldset class="flex w-full flex-col justify-between text-sm">
    @if ($label)
        <label for="{{ $name }}" class="font-medium">
            @if ($required)
                {{ $label }} <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    <div class="relative">
        <select
            name="{{ $name }}"
            id="{{ $name }}"
            class="w-full appearance-none rounded-lg border border-[#8d8d8d]/50 bg-transparent pl-4 pr-10 py-2.5 focus:ring-0 focus:outline-none"
            {{ $required ? 'required' : '' }}
        >
            @if ($placeholder)
                <option value="" disabled {{ empty(old($name, $selected)) ? 'selected' : '' }}>
                    {{ $placeholder }}
                </option>
            @endif
            @foreach ($options as $value => $label)
                <option value="{{ $value }}" {{ (string) old($name, $selected) === (string) $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        <span class="pointer-events-none absolute inset-y-0 right-0 hidden items-center px-5 text-xs text-gray-400 lg:flex">
            <i class="fa-solid fa-chevron-down"></i>
        </span>
    </div>
</fieldset>