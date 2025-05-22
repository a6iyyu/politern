<figure
    class="max-w-1/2 w-full cursor-pointer border border-[var(--stroke)] bg-white pb-6 pt-4 px-6 rounded-xl transition-all duration-300 ease-in-out lg:max-w-1/3 lg:hover:bg-[#f9f9f9] relative overflow-hidden"
    style="border-top: 6px solid {{ $color }};"
>
    <section class="flex items-center justify-between gap-6 text-sm">
        <h5 class="font-medium text-sm text-[var(--secondary-text)]">{{ $title }}</h5>
        <span
            class="h-10 w-10 flex items-center justify-center rounded-full"
            style="background-color: {{ $background }}; color: {{ $color }}"
        >
            <i class="{{ $icon }}"></i>
        </span>
    </section>
    <h4 class="mb-3 mt-2 font-bold text-xl text-[var(--primary-text)]">
        {{ $total }}
    </h4>
    <h6 class="text-xs text-[var(--secondary-text)]">{{ $info }}</h6>
</figure>
