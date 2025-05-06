<h4 class="cursor-default mt-10 mb-5 text-2xl font-semibold text-[#5955b2]">
    Rekomendasi Magang
</h4>
<section class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-h-[600px] w-full overflow-y-auto pr-2 lg:max-h-[450px]">
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
