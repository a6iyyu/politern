<section class="flex items-center justify-between mb-5 pt-2">
    <h2 class="cursor-default text-base font-semibold text-[var(--primary-text)]">
        Daftar Data Pengajuan Magang
    </h2>
</section>
@if (session('success'))
    <h5 class="mb-7 p-4 cursor-default rounded-lg bg-emerald-50 border border-emerald-500 list-disc list-inside text-sm text-emerald-500">
        {{ session('success') }}
    </h5>
@elseif ($errors->any())
    <ul class="mb-7 p-4 cursor-default rounded-lg bg-red-50 border border-red-500 list-disc list-inside text-sm text-red-500">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
@include('components.admin.pengajuan-magang.filter')
<x-table :headers="['ID', 'Tanggal Pengajuan', 'Mahasiswa', 'Kode', 'Perusahaan', 'Posisi', 'Status', 'Aksi']" :sortable="['Tanggal Pengajuan', 'Mahasiswa']" :rows="$data" />
@if ($paginasi->hasPages())
    <div class="mt-4">
        {{ $paginasi->links() }}
    </div>
@else
    <h5 class="mt-4 cursor-default text-xs font-light text-[var(--primary-text)]">
        Menampilkan {{ count($data) ?? 0 }} dari {{ $total_pengajuan_magang ?? 'N/A' }} pengajuan magang
    </h5>
@endif