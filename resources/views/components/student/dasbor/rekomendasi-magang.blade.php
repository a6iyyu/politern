<h4 class="cursor-default mt-10 mb-5 text-lg font-semibold text-[var(--primary)]">
    Rekomendasi Magang
</h4>
<section class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    @foreach ($rekomendasi as $item)
        @php
            $lowongan = $item['lowongan'];
        @endphp

        <x-card
            :category="$lowongan->bidang->first()->nama_bidang ?? 'N/A'"
            :createdAt="$lowongan->created_at ?? 'N/A'"
            :industry="$lowongan->perusahaan->nama ?? 'N/A'"
            :location="$lowongan->perusahaan->lokasi->nama_lokasi ?? 'N/A'"
            :logo="$lowongan->perusahaan->logo ?? 'N/A'"
            :name="$lowongan->judul ?? 'N/A'"
            :salary="$lowongan->gaji ?? 'N/A'"
            :status="$lowongan->status ?? 'N/A'"
            :type="$lowongan->jenis_lokasi->nama_jenis_lokasi ?? 'N/A'"
            :url="route('mahasiswa.rekomendasi-magang', ['id' => $lowongan->perusahaan->id_perusahaan_mitra])"
        >
            <div class="mt-2 text-sm text-gray-500">
                Skor Rekomendasi: <strong>{{ number_format($item['skor'], 4) }}</strong>
            </div>
        </x-card>   
    @endforeach
</section>
