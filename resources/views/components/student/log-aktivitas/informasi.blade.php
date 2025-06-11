<figure class="cursor-default mt-2 bg-white rounded-lg px-8 py-8 w-full border border-[var(--stroke)]">
    <h4 class="font-semibold text-base text-[#5955b2]">Informasi Magang Aktif</h4>
    <hr class="my-4 border-[var(--primary)]" />
    <figcaption class="grid grid-cols-1 gap-y-3 text-sm text-[#585858] lg:grid-cols-2">
        <span class="flex items-center gap-2">
            <strong>Perusahaan:</strong>
            <h6>{{ $perusahaan ?? "N/A" }}</h6>
        </span>
        <span class="flex items-center gap-2">
            <strong>Periode:</strong>
            <h6>{{ $periode ?? "N/A" }}</h6>
        </span>
        <span class="flex items-center gap-2">
            <strong>Posisi:</strong>
            <h6>{{ $posisi ?? "N/A" }}</h6>
        </span>
        <span class="flex items-center gap-2">
            <strong>Total Log:</strong>
            <h6>{{ $total_log ?? "N/A" }}</h6>
        </span>
        <span class="flex items-center gap-2">
            <strong>Dosen Pembimbing:</strong>
            <h6>{{ $dospem ?? "N/A" }}</h6>
        </span>
        <span class="flex items-center gap-2">
            <strong>Status:</strong>
            @if(strtolower($status ?? '') === 'aktif')
                <span class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">{{ $status }}</span>
            @else
                <span class="bg-yellow-200 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">{{ $status ?? "N/A" }}</span>
            @endif
        </span>
    </figcaption>
</figure>