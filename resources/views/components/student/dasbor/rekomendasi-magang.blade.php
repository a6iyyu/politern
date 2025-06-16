@php
    use Carbon\Carbon;
@endphp

<div class="flex justify-between items-center mb-8">
    <h4 class="cursor-default text-lg font-semibold text-[var(--primary)]">
        Rekomendasi Magang
    </h4>
    <div class="flex justify-end gap-2">
        <a href="{{ route('mahasiswa.preferensi.edit') }}" class="bg-[var(--blue-tertiary)] text-white text-sm px-4 py-2 rounded-sm cursor-pointer transition-all duration-300 ease-in-out">
            Edit Preferensi
        </a>
        <a href="{{ route('mahasiswa.rekomendasi-magang.perhitungan-keseluruhan') }}" class="bg-[var(--secondary)] text-white text-sm px-4 py-2 rounded-sm cursor-pointer transition-all duration-300 ease-in-out">
            Lihat Semua Perhitungan
        </a>
    </div>
</div>
<section class="grid grid-cols-1 gap-4">
    @foreach ($rekomendasi['lowongan'] as $index => $item)
        <figure class="mb-2 w-full px-7 py-5 rounded-2xl border border-[#edcce7] shadow-sm bg-white custom-border-left" style="border-left: 6px solid 
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
                <h5 class="cursor-default h-fit text-[var(--green-tertiary)] text-xs px-4 py-2 rounded-full border border-[var(--green-tertiary)]">
                    {{ $item->gaji ?? 'N/A' }}
                </h5>
            </div>
            <div class="flex justify-between items-center mt-3 text-sm text-[#585858] w-full">
                <h5>{{ $item->perusahaan->lokasi->nama_lokasi ?? 'N/A' }}</h5>
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
            <div class="mt-4 flex justify-between w-full">
                <div class="flex flex-col">
                <h5 class="cursor-default text-xs text-[#585858]">
                    Diposting {{ Carbon::parse($item->created_at)->translatedFormat('d F Y') ?? 'N/A' }}
                </h5>
                </div>
                <span class="space-x-4">
                    <a href="{{ route('mahasiswa.rekomendasi-magang.perhitungan-lowongan', ['id' => $item->id_lowongan]) }}"
                        class="border border-[var(--blue-tertiary)] text-[var(--blue-tertiary)] text-sm px-6 py-2 rounded-sm font-medium cursor-pointer transition-all duration-300 ease-in-out lg:hover:bg-[var(--green-tertiary)/90]">
                        Lihat Perhitungan
                    </a>
                    <a href="{{ route('mahasiswa.rekomendasi-magang.detail', ['id' => $item->perusahaan->id_perusahaan_mitra]) }}"
                        class="bg-[var(--secondary)] text-white text-sm px-6 py-2 rounded-sm font-medium cursor-pointer transition-all duration-300 ease-in-out">
                        Lihat Detail
                    </a>
                </span>
            </div>
            <span class="text-xs mt-2 text-white text-[var(--primary)] bg-[var(--primary)] px-4 py-1 rounded-full">
                Rank: {{ $index + 1 }}
            </span>
        </figure>
    @endforeach
</section>