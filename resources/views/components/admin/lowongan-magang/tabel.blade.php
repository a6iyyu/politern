<section class="flex flex-col justify-between mb-5 gap-4 lg:flex-row lg:items-center">
    <h2 class="cursor-default text-base font-semibold text-[var(--primary-text)]">
        Daftar Data Lowongan Magang
    </h2>
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.lowongan-magang.ekspor-excel') }}" class="text-xs bg-[var(--primary)] text-white font-medium px-4 py-3 rounded-md cursor-pointer hover:bg-[var(--primary)]/90 transition-colors">
            <i class="fa fa-file-excel mr-2"></i> Ekspor Data
        </a>
        <a href="javascript:void(0)" data-target="tambah-lowongan" class="open text-xs bg-[var(--primary)] text-white font-medium px-4 py-3 rounded-md cursor-pointer hover:bg-[var(--primary)]/90 transition-colors">
            Tambah Data Lowongan
        </a>
    </div>
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
@include('components.admin.lowongan-magang.filter')
<x-table :headers="['No', 'Perusahaan', 'Posisi', 'Periode', 'Durasi', 'Kuota', 'Status', 'Aksi']" :sortable="['Perusahaan', 'Status']" :rows="$data" />
@if ($paginasi->hasPages())
    <div class="mt-4">
        {{ $paginasi->links() }}
    </div>
@else
    <h5 class="mt-4 cursor-default text-xs font-light text-[var(--primary-text)]">
        Menampilkan {{ count($data) ?? 0 }} dari {{ $total_lowongan ?? 'N/A' }} lowongan magang
    </h5>
@endif