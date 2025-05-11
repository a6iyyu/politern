<section>
    <h4 class="cursor-default mt-10 mb-5 text-xl font-semibold text-[#5955b2]">
        Rekomendasi Magang
    </h4>
    <article class="max-h-[70vh] overflow-y-auto pr-2">
        <div class="flex flex-col gap-6">
            @foreach ($lowongan as $item)
                <x-card
                    :category="$item->bidang_keahlian"
                    :createdAt="$item->created_at"
                    :industry="$item->perusahaan->nama ?? '-'"
                    :location="$item->lokasi ?? '-'"
                    :maxSalary="$item->gaji_maksimal ?? '-'"
                    :minSalary="$item->gaji_minimal ?? '-'"
                    :name="$item->judul"
                    :status="$item->status"
                    :type="ucwords(strtolower($item->kategori))"
                />
            @endforeach
        </div>
    </article>
</section>