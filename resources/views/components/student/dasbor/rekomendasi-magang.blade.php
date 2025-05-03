<h4 class="cursor-default mt-10 mb-5 text-2xl font-semibold text-[#5955b2]">
    Rekomendasi Magang
</h4>
<section class="max-h-[600px] max-w-full w-full overflow-y-auto pr-2 space-y-7 lg:max-h-[450px] lg:max-w-1/2">
    @foreach ($lowongan as $item)
        <x-card
            :category="$item->bidang_keahlian"
            :industry="$item->perusahaan->nama ?? '-'"
            :location="$item->lokasi ?? '-'"
            :name="$item->judul"
            :status="$item->status"
            :type="ucwords(strtolower($item->kategori))"
        />
    @endforeach
</section>