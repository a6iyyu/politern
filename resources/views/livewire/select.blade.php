<fieldset class="flex w-full flex-col justify-between space-y-4">
    <label for="{{ $name }}" class="font-medium">
        {{ $label }}
        @if ($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
    <div class="relative">
        <select name="{{ $name }}" id="{{ $name }}" class="w-full appearance-none rounded-md border-2 border-gray-700 bg-transparent px-4 py-3 focus:ring-0 focus:outline-none" required>
            <option value="" hidden>Pilih {{ $label }}</option>
            @if (is_array($options))
                @foreach ($options as $value => $label)
                    <option value="{{ $value }}" {{ (old($name, $selected ?? '') == $value) ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            @endif
        </select>
        <span class="pointer-events-none absolute inset-y-0 right-0 hidden items-center px-5 text-xs text-gray-400 lg:flex">
            <i class="fa-solid fa-chevron-down"></i>
        </span>
    </div>
</fieldset>