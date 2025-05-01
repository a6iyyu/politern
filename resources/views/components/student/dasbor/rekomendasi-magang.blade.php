<h4 class="cursor-default mt-10 mb-5 text-2xl font-semibold text-[#5955b2]">
    Rekomendasi Magang
</h4>

<div id="scrollable" class="max-h-[450px] overflow-y-auto pr-2 space-y-4 cursor-grab active:cursor-grabbing">
    @foreach ($lowongan as $item)
        @include('shared.ui.card', [
            'title' => $item->judul,
            'company' => $item->perusahaan->nama ?? '-',
            'location' => $item->lokasi ?? '-',
            'status' => $item->status,
            'kategori' => $item->kategori,
            'bidang' => $item->bidang_keahlian
        ])
    @endforeach
</div>


