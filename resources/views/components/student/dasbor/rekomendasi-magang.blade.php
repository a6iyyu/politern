<section>
    <h4 class="cursor-default mt-10 mb-5 text-lg font-semibold text-[var(--primary)]">
        Rekomendasi Magang
    </h4>
    <article class="max-h-[70vh] overflow-y-auto pr-2">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($lowongan as $item)
                <x-card
                    :category="$item->bidang_keahlian ?? 'N/A'"
                    :createdAt="$item->created_at ?? 'N/A'"
                    :industry="$item->perusahaan->nama ?? 'N/A'"
                    :location="$item->lokasi ?? 'N/A'"
                    :maxSalary="$item->gaji_maksimal ?? 'N/A'"
                    :minSalary="$item->gaji_minimal ?? 'N/A'"
                    :name="$item->judul ?? 'N/A'"
                    :status="$item->status ?? 'N/A'"
                    :type="ucwords(strtolower($item->kategori)) ?? 'N/A'"
                />
            @endforeach
        </div>
    </article>
</section>