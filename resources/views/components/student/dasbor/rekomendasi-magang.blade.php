<div class="justify-btween">
    <h4 class="cursor-default mt-10 mb-5 text-lg font-semibold text-[var(--primary)]">
        Rekomendasi Magang
    </h4>

</div>

<section class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    @foreach ($rekomendasi['lowongan'] as $item)
        <div class="mb-4">
            <x-card
                :category="$item->bidang->nama_bidang ?? 'N/A'"
                :createdAt="$item->created_at ?? 'N/A'"
                :industry="$item->perusahaan->nama ?? 'N/A'"
                :location="$item->perusahaan->lokasi->nama_lokasi ?? 'N/A'"
                :logo="$item->perusahaan->logo ?? 'N/A'"
                :name="$item->judul ?? 'N/A'"
                :salary="$item->gaji ?? 'N/A'"
                :skill="$item->keahlian->pluck('nama_keahlian')->implode(', ') ?? 'N/A'"
                :score="'N/A'"  
                :status="$item->status ?? 'N/A'"
                :type="$item->jenis_lokasi->nama_jenis_lokasi ?? 'N/A'"
                :url="route('mahasiswa.rekomendasi-magang.detail', ['id' => $item->perusahaan->id_perusahaan_mitra])"
            />

            <!-- Tombol untuk Lihat Detail Perhitungan hanya akan muncul untuk tiap lowongan -->
            <a href="{{ route('mahasiswa.rekomendasi-magang.perhitungan', ['id' => $item->id_lowongan]) }}"
                class="bg-blue-500 text-white text-sm px-4 py-2 rounded-lg font-medium cursor-pointer transition-all duration-300 ease-in-out hover:bg-blue-600 mt-4 block">
                Lihat Detail Perhitungan
            </a>             
        </div>
    @endforeach
</section>