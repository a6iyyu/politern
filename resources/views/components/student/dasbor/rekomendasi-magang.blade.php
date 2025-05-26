<h4 class="cursor-default mt-10 mb-5 text-lg font-semibold text-[var(--primary)]">
    Rekomendasi Magang
</h4>
<section class="max-h-[70vh] overflow-y-auto pr-2">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        @foreach ($lowongan as $item)
            <x-card
                :category="$item->bidang->nama_bidang ?? 'N/A'"
                :createdAt="$item->created_at ?? 'N/A'"
                :industry="$item->perusahaan->nama ?? 'N/A'"
                :location="$item->perusahaan->lokasi->nama_lokasi ?? 'N/A'"
                :logo="$item->perusahaan->logo ?? 'N/A'"
                :name="$item->judul ?? 'N/A'"
                :salary="$item->gaji ?? 'N/A'"
                :status="$item->status ?? 'N/A'"
                :type="$item->jenis_lokasi->nama_jenis_lokasi ?? 'N/A'"
            />
        @endforeach
    </div>
</section>