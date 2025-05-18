<div class="bg-white rounded-lg overflow-hidden shadow-sm mb-6 border border-[var(--stroke)]">
    <div class="bg-[var(--primary)] py-3 px-6 text-white">
        <h3 class="text-sm">{{ $judul }}</h3>
    </div>

    <div class="py-5 px-6 flex flex-col md:flex-row gap-4">
        <div class="flex-1 flex flex-col justify-between">
            <div>
                <p class="text-sm mb-2 text-[var(--text-secondary)]">
                    <span class="font-medium">Tanggal :  </span>
                    <span class="text-[var(--text-primary)]">{{ $tanggal }}</span>
                </p>
                <p class="text-sm mb-4 max-w-[350px] text-[var(--text-secondary)]">
                    <span class="font-medium">Deskripsi : </span>
                    <span class="text-[var(--text-primary)]">{{ $deskripsi }}</span>
                </p>
            </div>

            <!-- Status -->
            @php
                $statusClass = match(strtolower($status)) {
                    'diterima' => 'text-[var(--tersier-hijau)] border-[var(--tersier-hijau)] hover:bg-[var(--tersier-hijau)] hover:text-white',
                    'ditolak' => 'text-[var(--tersier-merah)] border-[var(--tersier-merah)] hover:bg-[var(--tersier-merah)] hover:text-white',
                    'menunggu' => 'text-[var(--tersier-kuning)] border-[var(--tersier-kuning)] hover:bg-[var(--tersier-kuning)] hover:text-white'
                };
            @endphp
            <div class="mt-auto flex justify-end md:justify-start">
                <button class="px-4 py-2 text-sm font-medium border rounded {{ $statusClass }}">
                    {{ $status }}
                </button>
            </div>
        </div>

        <div class="w-full md:w-1/4 flex flex-col justify-between">
            <div>
                <p class="text-sm font-medium mb-1 text-[var(--text-secondary)]">Bukti Foto :</p>
                <img src="{{ $gambar }}" alt="Bukti Aktivitas" class="w-full rounded-md object-cover">
            </div>
            <div class="flex justify-end gap-2 mt-5">
                <a href="{{ $detailUrl }}" class="px-4 py-2 text-sm text-white bg-blue-600 rounded hover:bg-blue-700 text-center text-[var(--text-secondary)]">Detail</a>
                <a href="{{ $editUrl }}" class="px-4 py-2 text-sm text-white bg-yellow-400 rounded hover:bg-yellow-500 text-center text-[var(--text-secondary)]">Edit</a>
                <a href="{{ $hapusUrl }}" class="px-4 py-2 text-sm text-white bg-red-500 rounded hover:bg-red-600 text-center text-[var(--text-secondary)]">Hapus</a>
            </div>
        </div>
    </div>
</div>
