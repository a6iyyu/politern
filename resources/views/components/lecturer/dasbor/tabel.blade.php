<section class="flex items-center justify-between mb-6">
    <h3 class="cursor-default text-base font-medium text-[var(--primary-text)] flex items-center gap-2">
        <i class="fa-regular fa-user"></i> Daftar Mahasiswa Bimbingan
    </h3>
    <a href="{{ route('dosen.data-mahasiswa') }}" class="open text-xs bg-[var(--primary)] text-white font-medium px-5 py-3 rounded cursor-pointer hover:bg-[var(--primary)]/90 transition-colors">
        Lihat Semua
    </a>
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

<x-table :headers="['Mahasiswa', 'NIM', 'Perusahaan', 'Posisi', 'Status', 'Aksi']" :sortable="['Mahasiswa', 'Status']" :rows="$data" />
<h5 class="mt-4 cursor-default text-xs font-light text-[var(--primary-text)]">
    Menampilkan {{ count($data) ?? 0 }} dari {{ $total_bimbingan ?? 'N/A' }} mahasiswa bimbingan
</h5>