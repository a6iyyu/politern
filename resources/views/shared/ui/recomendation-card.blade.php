<figure class="w-full px-7 py-5 border border-[var(--stroke)]">
    <div class="cursor-default flex justify-between w-full">
        <figcaption class="flex gap-3 space-y-1">
            <img src="{{ $logo ?? 'N/A' }}" alt="{{ $industry }}" class="w-10 object-cover" />
            <span>
                <h4 class="text-[#5955b2] font-semibold">
                    {{ $category ?? 'N/A' }}
                </h4>
                <h5 class="text-[#585858] text-sm font-medium">
                    {{ $industry ?? 'N/A' }}
                </h5>
            </span>
        </figcaption>
        <h5 class="cursor-default h-fit bg-[#70e459] text-white text-sm px-4 py-2 rounded-lg">
            {{ $status ?? 'N/A' }}
        </h5>
    </div>
    
    <span class="cursor-default flex items-center justify-between mt-3 text-sm text-[#585858] w-full">
        <h5>{{ $location ?? 'N/A' }}</h5>
        <h5 class="font-bold italic">{{ $salary ?? 'N/A' }}</h5>
    </span>

    <div class="flex flex-wrap gap-2 mt-4 w-full">
        <h5 class="cursor-pointer bg-[#fbecf1] text-xs text-[#585858] px-5 py-2 rounded-full border border-[#f9d4e2] transition-all duration-300 ease-in-out lg:hover:bg-[#f9d4e2]">
            {{ $type ?? 'N/A' }}
        </h5>
        @foreach(explode(', ', $skill) as $skillItem)
            <h5 class="cursor-pointer bg-[#ECEFFB] text-xs text-[#585858] px-4 py-2 rounded-full border border-[#aab5ff] transition-all duration-300 ease-in-out lg:hover:bg-[#aab5ff]">
                {{ $skillItem ?? 'N/A' }}
            </h5>
        @endforeach
    </div>

    <span class="flex items-center justify-between cursor-default mt-3 text-xs text-[#585858] w-full">
        <h5>Diposting {{ $formattedDate() ?? 'N/A' }}</h5>
        {{-- @if (isset($score) || !empty($score))
            <h6 class="italic">Skor: {{ $score ?? 'N/A' }}</h6>
        @endif --}}
        <a href="{{ $detail }}" class="w-1/8 bg-[#77b2ff] text-white text-sm px-4 py-2 rounded-lg font-medium cursor-pointer transition-all duration-300 ease-in-out lg:hover:bg-[#4f9afb]">
            Lihat Perhitungan
        </a>    
    </span>

    <span class="mt-6 flex items-center justify-between w-full">
        <img src="{{ asset('icons/simpan-biru.svg') }}" alt="Simpan" id="save" />
        <a href="{{ $url }}" class="w-1/12 bg-[#ff77c3] text-white text-sm px-4 py-2 rounded-lg font-medium cursor-pointer transition-all duration-300 ease-in-out lg:hover:bg-[#ff60b8]">
            Lihat Detail
        </a>
    </span>
</figure>
