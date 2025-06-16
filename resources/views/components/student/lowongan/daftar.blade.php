
<section class="flex flex-col justify-between mb-5 gap-4 lg:flex-row lg:items-center">
    <h2 class="cursor-default text-base font-semibold text-[var(--primary-text)]">
        Daftar Lowongan Magang
    </h2>
</section>
@include('components.student.lowongan.filter')
<section class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    @foreach ($lowongan as $item)
        <figure class="rounded-xl px-7 py-5 border border-[#edcce7] shadow-sm bg-white">
            <div class="cursor-default flex justify-between">
                <figcaption class="flex gap-3 space-y-1">
                    <img src="{{ asset($item->perusahaan->logo) ?? 'N/A' }}" alt="{{ $item->perusahaan->nama ?? 'N/A' }}" class="w-7 object-cover md:w-10" />
                    <span>
                        <h4 class="text-[#5955b2] font-semibold">
                            {{ $item->bidang->nama_bidang ?? 'N/A' }}
                        </h4>
                        <h5 class="text-[#585858] text-sm font-medium">
                            {{ $item->perusahaan->nama ?? 'N/A' }}
                        </h5>
                    </span>
                </figcaption>
                <h5 class="cursor-default h-fit text-[var(--green-tertiary)] text-xs px-4 py-2 rounded-full border border-[var(--green-tertiary)]">
                    {{ $item->gaji ?? 'N/A' }}
                </h5>
            </div>
            <span class="cursor-default flex items-center justify-between mt-3 text-sm text-[#585858]">
                <h5>{{ $item->perusahaan->lokasi->nama_lokasi ?? 'N/A' }}</h5>
            </span>
            <div class="flex flex-wrap gap-2 mt-4">
                <h5 class="cursor-pointer bg-[#fbecf1] text-xs text-[#585858] px-5 py-2 rounded-full border border-[#f9d4e2] transition-all duration-300 ease-in-out lg:hover:bg-[#f9d4e2]">
                    {{ $item->jenis_lokasi->nama_jenis_lokasi ?? 'N/A' }}
                </h5>
                @foreach ($item->keahlian as $skillItem)
                    <h5 class="cursor-pointer bg-[#ECEFFB] text-xs text-[#585858] px-4 py-2 rounded-full border border-[#aab5ff] transition-all duration-300 ease-in-out lg:hover:bg-[#aab5ff]">
                        {{ $skillItem->nama_keahlian ?? 'N/A' }}
                    </h5>
                @endforeach
            </div>
            <span class="mt-4 flex justify-between">
                <h5 class="cursor-default mt-3 text-xs text-[#585858]">
                    Diposting {{ $item->created_at ? $item->created_at->translatedFormat('d F Y') : 'N/A' }}
                </h5>
                <a href="{{ route('mahasiswa.lowongan.detail', ['id' => $item->perusahaan->id_perusahaan_mitra]) }}"
                   class="bg-[var(--secondary)] text-white text-sm px-6 py-2 rounded-sm font-medium cursor-pointer transition-all duration-300 ease-in-out lg:hover:bg-[var(--green-tertiary)/90]">
                    Lihat Detail
                </a>
            </span>
        </figure>
    @endforeach
</section>