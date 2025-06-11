<div class="flex justify-between items-center mt-10 mb-5">
    <h4 class="cursor-default text-lg font-semibold text-[var(--primary)]">
        Rekomendasi Magang
    </h4>
    <!-- Debugging URL -->

</div>

<section class="grid grid-cols-1 gap-6 ">
    @foreach ($rekomendasi['lowongan'] as $item)
        <div class="mb-4">
            <x-recomendation-card
                class="w-full"
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
                :detail="route('mahasiswa.rekomendasi-magang.perhitungan', ['id' => $item->id_lowongan])"
            />

            
        </div>
    @endforeach
</section>