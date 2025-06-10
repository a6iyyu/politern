<section class="mt-8 flex items-center justify-end">
    <button type="button" data-target="log-mahasiswa" class="open cursor-pointer w-fit text-sm bg-[var(--green-tertiary)] text-[var(--background)] font-medium px-5 py-2.5 rounded transition-all duration-300 ease-in-out lg:hover:bg-[#66c2a3]">
        Tambah Aktivitas
    </button>
</section>

<section class="mt-6 grid grid-cols-1 gap-4">
@foreach($log_aktivitas as $aktivitas)
<div class="rounded-lg shadow-md overflow-hidden mb-4" style="background-color: white;">
    <div class="p-4 rounded-t-lg text-white" style="background-color: #5955B2;">
        <h3 class="font-semibold text-lg">Minggu Ke-{{ $minggu }} : {{ $posisi }}</h3>
    </div>
    <div class="p-4">
        <div class="flex justify-between items-start mb-4">
            <div class="flex-1 pr-4">
                <p class="text-sm text-gray-600 mb-5">Tanggal : {{ \Carbon\Carbon::parse($aktivitas->created_at)->format('d M Y') }}</p>
                <p class="text-sm text-gray-600">Deskripsi : {{ $aktivitas->deskripsi ?? 'Tidak ada deskripsi' }}</p>
            </div>
            <div class="flex-shrink-0 ml-4">
                <p class="text-sm text-gray-600 mb-2">Bukti Foto :</p>
                @if ($aktivitas->foto)
                    <img src="{{ asset('shared/aktivitas.png') }}" alt="No Photo" class="rounded-lg">
                @else
                    <img src="{{ asset('build/assets/shared/aktivitas.png') }}" alt="No Photo" class="rounded-lg">
                @endif
            </div>
        </div>

        <div class="flex justify-start items-center gap-2 mt-4 flex-wrap">
            @if ($aktivitas->status === 'DISETUJUI')
                <span class="px-5 py-2 text-sm font-medium rounded-lg border border-green-500 text-green-500 bg-transparent">
                    Diterima
                </span>
            @elseif ($aktivitas->status === 'DITOLAK')
                <span class="px-5 py-2 text-sm font-medium rounded-lg border border-red-500 text-red-500 bg-transparent">
                    Ditolak
                </span>
            @elseif ($aktivitas->status === 'MENUNGGU')
                <span class="px-5 py-2 text-sm font-medium rounded-lg border border-yellow-500 text-yellow-500 bg-transparent">
                    Menunggu
                </span>
            @else
                <span class="px-3 py-1 text-sm font-medium rounded-full border border-gray-400 text-gray-400 bg-transparent">
                    {{ $aktivitas->status ?? 'Tidak Diketahui' }}
                </span>
            @endif

            <button type="button" class="px-4 py-2 text-sm font-medium rounded-md bg-blue-600 text-white hover:bg-blue-700 transition"
                onclick="showDetail({{ $aktivitas->id_log }})">Detail</button>
            <button type="button" class="px-4 py-2 text-sm font-medium rounded-md bg-yellow-400 text-white hover:bg-yellow-500 transition"
                onclick="editAktivitas({{ $aktivitas->id_log }})">Edit</button>
            <form method="POST" action="{{ route('mahasiswa.log-aktivitas.hapus', $aktivitas->id_log) }}" onsubmit="return confirm('Yakin ingin menghapus log ini?');">
    @csrf
    @method('DELETE')
    <button type="submit" class="px-4 py-2 text-sm font-medium rounded-md bg-red-500 text-white hover:bg-red-600 transition">
        Hapus
    </button>
</form>
        </div>

        @if ($aktivitas->komentar && ($aktivitas->status === 'DITOLAK' || $aktivitas->status === 'DISETUJUI'))
            <div class="mt-4 p-3 bg-gray-100 rounded-md text-sm text-gray-700">
                <strong>Komentar:</strong> {{ $aktivitas->komentar }}
            </div>
        @endif

        @if ($aktivitas->tanggal_evaluasi && ($aktivitas->status === 'DISETUJUI'))
            <div class="mt-2 text-sm text-gray-600">
                Tanggal Konfirmasi: {{ \Carbon\Carbon::parse($aktivitas->tanggal_evaluasi)->format('d M Y H:i') }}
            </div>
        @endif
    </div>
</div>
@endforeach
</section>