<figure class="border cursor-pointer border-[#dadada] p-6 rounded-xl transition-all duration-300 ease-in-out lg:hover:bg-[#f9f9f9]">
    <section class="flex items-center justify-between gap-6 text-sm">
        <h5 class="font-medium text-sm text-[#4f4f4f]">{{ $title }}</h5>
        <span
            class="h-10 w-10 flex items-center justify-center rounded-full"
            style="background-color: {{ $background }}; color: {{ $color }}"
        >
            <i class="{{ $icon }}"></i>
        </span>
    </section>
    <h4 class="mb-2 mt-1 font-semibold text-xl">
        {{ $total }}
    </h4>
    <h6 class="text-xs text-[#4f4f4f]">{{ $info }}</h6>
</figure>