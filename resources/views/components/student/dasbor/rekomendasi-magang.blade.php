@php
    use Carbon\Carbon;
@endphp

<div class="flex justify-between items-center mt-10 mb-5">
    <h4 class="cursor-default text-lg font-semibold text-[var(--primary)]">
        Rekomendasi Magang
    </h4>
</div>
<section class="grid grid-cols-1 gap-6">
    @foreach ($rekomendasi['lowongan'] as $item)
        <figure class="mb-4 w-full px-7 py-5 border border-[var(--stroke)]">
            <div class="cursor-default flex justify-between w-full">
                <figcaption class="flex gap-3 space-y-1">
                    <img src="{{ $item->perusahaan->logo ?? 'N/A' }}" alt="{{ $item->perusahaan->nama ?? 'N/A' }}" class="w-10 object-cover" />
                    <span>
                        <h4 class="text-[#5955b2] font-semibold">
                            {{ $item->bidang->nama_bidang ?? 'N/A' }}
                        </h4>
                        <h5 class="text-[#585858] text-sm font-medium">
                            {{ $item->perusahaan->nama ?? 'N/A' }}
                        </h5>
                    </span>
                </figcaption>
                <h5 class="cursor-default h-fit bg-[#70e459] text-white text-sm px-4 py-2 rounded-lg">
                    {{ $item->status ?? 'N/A' }}
                </h5>
            </div>
            <span class="cursor-default flex items-center justify-between mt-3 text-sm text-[#585858] w-full">
                <h5>{{ $item->perusahaan->lokasi->nama_lokasi ?? 'N/A' }}</h5>
                <h5 class="font-bold italic">{{ $item->gaji ?? 'N/A' }}</h5>
            </span>
            <div class="flex flex-wrap gap-2 mt-4 w-full">
                <h5 class="cursor-pointer bg-[#fbecf1] text-xs text-[#585858] px-5 py-2 rounded-full border border-[#f9d4e2] transition-all duration-300 ease-in-out lg:hover:bg-[#f9d4e2]">
                    {{ $item->jenis_lokasi->nama_jenis_lokasi ?? 'N/A' }}
                </h5>
                @foreach (explode(', ', $item->keahlian->pluck('nama_keahlian')->implode(', ')) as $skillItem)
                    <h5 class="cursor-pointer bg-[#ECEFFB] text-xs text-[#585858] px-4 py-2 rounded-full border border-[#aab5ff] transition-all duration-300 ease-in-out lg:hover:bg-[#aab5ff]">
                        {{ $skillItem ?? 'N/A' }}
                    </h5>
                @endforeach
            </div>
            <h5 class="cursor-default mt-3 text-xs text-[#585858] w-full">
                Diposting {{ Carbon::parse($item->created_at)->translatedFormat('d F Y') ?? 'N/A' }}
            </h5>
            <div class="mt-6 flex items-center justify-between w-full">
                <img src="{{ asset('icons/simpan-biru.svg') }}" alt="Simpan" id="save" class="cursor-pointer transition-all duration-300 ease-in-out lg:hover:scale-102" />
                <span class="space-x-2">
                    <a href="{{ route('mahasiswa.rekomendasi-magang.perhitungan', ['id' => $item->id_lowongan]) }}" class="w-1/8 bg-[#77b2ff] text-white text-sm px-4 py-2 rounded-lg font-medium cursor-pointer transition-all duration-300 ease-in-out lg:hover:bg-[#4f9afb]">
                        Lihat Perhitungan
                    </a>
                    <a href="{{ route('mahasiswa.rekomendasi-magang.detail', ['id' => $item->perusahaan->id_perusahaan_mitra]) }}" class="w-1/12 bg-[#ff77c3] text-white text-sm px-4 py-2 rounded-lg font-medium cursor-pointer transition-all duration-300 ease-in-out lg:hover:bg-[#ff60b8]">
                        Lihat Detail
                    </a>
                </span>
            </div>
        </figure>
    @endforeach
</section>