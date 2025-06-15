<section class="flex items-center justify-between py-2">
    <h5 class="cursor-default mt-4 font-medium text-sm">
        {{ $jumlah_lowongan ?? "N/A" }} lowongan
    </h5>
    <fieldset class="flex items-center gap-1 mt-4 text-sm text-slate-700">
        <h5 class="cursor-default">Urut berdasarkan</h5>
        <select name="sortir" id="sortir" class="rounded-md py-1 text-slate-700 text-sm focus:outline-none focus:ring-1 focus:ring-[var(--primary)]">
            <option value="relevansi">relevansi</option>
            <option value="terbaru">terbaru</option>
            <option value="terlama">terlama</option>
            <option value="gaji_tertinggi">gaji Tertinggi</option>
            <option value="gaji_terendah">gaji Terendah</option>
        </select>
    </fieldset>
</section>
<section class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    @foreach ($lowongan as $item)
        <figure class="rounded-xl px-7 py-5 border border-[var(--stroke)]">
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
                <h5 class="cursor-default h-fit bg-[#70e459] text-white text-sm px-4 py-2 rounded-lg">
                    {{ $item->status ?? 'N/A' }}
                </h5>
            </div>
            <span class="cursor-default flex items-center justify-between mt-3 text-sm text-[#585858]">
                <h5>{{ $item->perusahaan->lokasi->nama_lokasi ?? 'N/A' }}</h5>
                <h5 class="font-bold italic">{{ $item->gaji ?? 'N/A' }}</h5>
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
            <h5 class="cursor-default mt-3 text-xs text-[#585858]">
                Diposting {{ $item->created_at ? $item->created_at->translatedFormat('d F Y') : 'N/A' }}
            </h5>
            <span class="mt-6 flex items-center justify-between">
                <img src="{{ asset('icons/simpan-biru.svg') }}" alt="Simpan" id="save" />
                <a href="{{ route('mahasiswa.lowongan.detail', ['id' => $item->perusahaan->id_perusahaan_mitra]) }}"
                   class="bg-[#ff77c3] text-white text-sm px-4 py-2 rounded-lg font-medium cursor-pointer transition-all duration-300 ease-in-out lg:hover:bg-[#ff60b8]">
                    Lihat Detail
                </a>
            </span>
        </figure>
    @endforeach
</section>