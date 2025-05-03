<figure class="rounded-xl px-7 py-5 border border-[#dadada]">
    <div class="cursor-default flex justify-between">
        <figcaption class="space-y-1">
            <h4 class="text-[#5955b2] font-semibold">
                {{ $name }}
            </h4>
            <h5 class="text-[#585858] text-sm font-medium">
                {{ $industry }}
            </h5>
        </figcaption>
        <h5 class="cursor-default h-fit bg-[#70e459] text-white text-sm px-4 py-2 rounded-lg">
            {{ $status }}
        </h5>
    </div>
    <h5 class="cursor-default mt-3 text-sm text-[#585858]">
        {{ $location }}
    </h5>
    <span class="flex flex-wrap gap-2 mt-5">
        <h5 class="cursor-pointer bg-[#fbecf1] text-xs text-[#585858] px-5 py-2 rounded-full border border-[#f9d4e2] transition-all duration-300 ease-in-out lg:hover:bg-[#f9d4e2]">
            {{ $type }}
        </h5>
        <h5 class="cursor-pointer bg-[#fbecf1] text-xs text-[#585858] px-4 py-2 rounded-full border border-[#f9d4e2] transition-all duration-300 ease-in-out lg:hover:bg-[#f9d4e2]">
            {{ $category }}
        </h5>
    </span>
    <span class="mt-6 flex items-center justify-between">
        <img src="{{ asset('icons/simpan-biru.svg') }}" alt="Simpan" id="save" />
        <a href="" class="bg-[#ff77c3] text-white text-sm px-4 py-2 rounded-lg font-medium cursor-pointer transition-all duration-300 ease-in-out lg:hover:bg-[#ff60b8]">
            Lihat Detail
        </a>
    </span>
</figure>