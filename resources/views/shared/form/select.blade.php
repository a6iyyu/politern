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
            class="w-full appearance-none rounded-lg text-[var(--secondary-text)] border border-[var(--stroke)] bg-transparent pl-4 pr-10 py-2.5 focus:ring-1 focus:ring-[var(--primary)] focus:outline-none"
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
        <span class="pointer-events-none absolute inset-y-0 right-0 hidden items-center px-5 text-[var(--primary)] lg:flex">
            <i class="fa-solid fa-chevron-down"></i>
        </span>
    </div>
</fieldset>