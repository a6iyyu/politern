<section class="flex flex-col justify-between mb-5 gap-4 lg:flex-row lg:items-center">
    <h2 class="cursor-default text-base font-semibold text-[var(--primary-text)]">
        Daftar Aktivitas Magang
    </h2>
    <button type="button" data-target="log-mahasiswa" class="open cursor-pointer w-fit text-sm bg-[var(--green-tertiary)] text-[var(--background)] font-medium px-5 py-2.5 rounded transition-all duration-300 ease-in-out lg:hover:bg-[#66c2a3]">
        Tambah Aktivitas
    </button>
</section>

@if (session('success'))
    <h5 class="mb-4 p-4 cursor-default rounded-lg bg-emerald-50 border border-emerald-500 list-disc list-inside text-sm text-emerald-500">
        {{ session('success') }}
    </h5>
@elseif ($errors->any())
    <ul class="mb-7 p-4 cursor-default rounded-lg bg-red-50 border border-red-500 list-disc list-inside text-sm text-red-500">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
@include('components.student.log-aktivitas.filter')

<section class="mt-6 grid grid-cols-2 gap-6">
@foreach($log_aktivitas as $aktivitas)
<div class="rounded-lg border border-[var(--stroke)] overflow-hidden mb-4" style="background-color: white;">
    <div class="py-4 px-6 rounded-t-lg text-white" style="background-color: #5955B2;">
        <h3 class="text-sm">Minggu Ke-{{ $aktivitas->minggu }} : {{ $aktivitas->judul }}</h3>
    </div>
    <div class="py-6 px-6">
        <div class="flex justify-between items-start mb-6">
            <div class="flex-1 pr-6">
                <p class="text-sm text-[var(--secondary-text)] mb-5">Tanggal : <span class="font-medium text-[var(--primary-text)]">{{ \Carbon\Carbon::parse($aktivitas->created_at)->format('d M Y') }}</span></p>
                <p class="text-sm text-[var(--secondary-text)]">Deskripsi : <span class="line-height-8 font-medium text-[var(--primary-text)] text-wrap">{{ $aktivitas->deskripsi ?? 'Tidak ada deskripsi' }}</span></p>
            </div>
            <div class="flex-shrink-0 ml-4">
                <p class="text-sm text-[var(--secondary-text)] mb-2">Bukti Foto :</p>
                @if ($aktivitas->foto)
                    <img src="{{ $aktivitas->foto }}" alt="Foto Aktivitas" class="rounded-lg">
                @else
                    <img src="{{ asset('build/assets/shared/aktivitas.png') }}" alt="No Photo" class="rounded-lg">
                @endif
            </div>
        </div>

        <div class="flex justify-between items-center mt-4">
            <div>
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
            </div>
            
            <div class="flex justify-end gap-2">
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