@php
    use Carbon\Carbon;
@endphp

<div class="flex justify-between items-center mt-10 mb-5">
    <h4 class="cursor-default text-lg font-semibold text-[var(--primary)]">
        Rekomendasi Magang
    </h4>
    <div class="flex justify-end gap-2">
        <a href="{{ route('mahasiswa.preferensi.edit') }}" class="bg-[#FFB677] text-white text-sm px-4 py-2 rounded-lg font-medium cursor-pointer transition-all duration-300 ease-in-out lg:hover:bg-[#ffa34d]">
            Edit Preferensi
        </a>
        <a href="{{ route('mahasiswa.rekomendasi-magang.perhitungan-keseluruhan') }}" class="bg-[#77b2ff] text-white text-sm px-4 py-2 rounded-lg font-medium cursor-pointer transition-all duration-300 ease-in-out lg:hover:bg-[#4f9afb]">
            Lihat Semua Perhitungan
        </a>
    </div>
</div>
<section class="grid grid-cols-1 gap-6">
    @foreach ($rekomendasi['lowongan'] as $index => $item)
        <figure class="mb-2 w-full px-7 py-5 rounded-2xl border border-[var(--stroke)] custom-border-left bg-white" style="border-left: 6px solid 
            @if ($index == 0) #FFD700;
            @elseif ($index == 1) #C0C0C0; 
            @elseif ($index == 2) #CD7F32; 
            @else #ECEFFB;
            @endif
        ">
            <div class="flex justify-between items-center w-full">
                <figcaption class="flex gap-3 w-full md:w-auto">
                    <img src="{{ $item->perusahaan->logo ?? 'N/A' }}" alt="{{ $item->perusahaan->nama ?? 'N/A' }}" class="w-12 object-cover" />
                    <span class="flex-1">
                        <h4 class="text-[#5955b2] font-semibold">{{ $item->bidang->nama_bidang ?? 'N/A' }}</h4>
                        <h5 class="text-[#585858] text-sm font-medium">{{ $item->perusahaan->nama ?? 'N/A' }}</h5>
                    </span>
                </figcaption>
                <h5 class="bg-[#70e459] text-white text-sm px-4 py-2 rounded-lg">
                    {{ $item->status ?? 'N/A' }}
                </h5>
            </div>
            <div class="flex justify-between items-center mt-3 text-sm text-[#585858] w-full">
                <h5>{{ $item->perusahaan->lokasi->nama_lokasi ?? 'N/A' }}</h5>
                <h5 class="font-bold italic">{{ $item->gaji ?? 'N/A' }}</h5>
            </div>
            <div class="flex flex-wrap gap-2 mt-4 w-full">
                <h5 class="bg-[#fbecf1] text-xs text-[#585858] px-5 py-2 rounded-full border border-[#f9d4e2] transition-all duration-300 ease-in-out lg:hover:bg-[#f9d4e2]">
                    {{ $item->jenis_lokasi->nama_jenis_lokasi ?? 'N/A' }}
                </h5>
                @foreach (explode(', ', $item->keahlian->pluck('nama_keahlian')->implode(', ')) as $skillItem)
                    <h5 class="bg-[#ECEFFB] text-xs text-[#585858] px-4 py-2 rounded-full border border-[#aab5ff] transition-all duration-300 ease-in-out lg:hover:bg-[#aab5ff]">
                        {{ $skillItem ?? 'N/A' }}
                    </h5>
                @endforeach
            </div>
            <h5 class="mt-3 text-xs text-[#585858]">
                Diposting {{ Carbon::parse($item->created_at)->translatedFormat('d F Y') ?? 'N/A' }}
            </h5>
            <div class="mt-6 flex justify-between items-center w-full">
                <img src="{{ asset('icons/simpan-biru.svg') }}" alt="Simpan" id="save" class="cursor-pointer transition-all duration-300 ease-in-out lg:hover:scale-102" />
                <span class="space-x-2">
                    <a href="{{ route('mahasiswa.rekomendasi-magang.perhitungan-lowongan', ['id' => $item->id_lowongan]) }}"
                        class="bg-[#77b2ff] text-white text-sm px-4 py-2 rounded-lg font-medium cursor-pointer transition-all duration-300 ease-in-out lg:hover:bg-[#4f9afb]">
                        Lihat Perhitungan
                    </a>
                    <a href="{{ route('mahasiswa.rekomendasi-magang.detail', ['id' => $item->perusahaan->id_perusahaan_mitra]) }}"
                        class="bg-[#ff77c3] text-white text-sm px-4 py-2 rounded-lg font-medium cursor-pointer transition-all duration-300 ease-in-out lg:hover:bg-[#ff60b8]">
                        Lihat Detail
                    </a>
                </span>
            </div>
        </figure>
    @endforeach
</section>