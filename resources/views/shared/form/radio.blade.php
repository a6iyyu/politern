<fieldset class="flex w-full flex-col justify-between space-y-4">
    <h5 class="font-medium">
        {{ $label }}
        @if (!empty($required))
            <span class="text-red-500">*</span>
        @endif
    </h5>
    <div class="flex items-center space-x-6">
        @foreach ($options as $checked => $text)
            <span class="inline-flex cursor-pointer items-center">
                <input
                    type="radio"
                    name="{{ $name }}"
                    id="{{ "{$name}_{$checked}" }}"
                    value="{{ $checked }}"
                    class="h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                    {{ $value === $checked ? 'checked' : '' }}
                />
                <label for="{{ "{$name}_{$checked}" }}" class="ml-2 cursor-pointer">{{ $text }}</label>
            </span>
        @endforeach
    </div>
</fieldset>