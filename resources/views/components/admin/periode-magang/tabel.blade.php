<section class="flex items-center justify-between mb-5">
    <h2 class="cursor-default text-base font-semibold text-[var(--primary-text)]">
        Daftar Periode Magang
    </h2>
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.periode-magang.ekspor-excel') }}" class="text-xs bg-[var(--primary)] text-white font-medium px-4 py-3 rounded-md cursor-pointer hover:bg-[var(--primary)]/90 transition-colors">
            <i class="fa fa-file-excel mr-2"></i> Ekspor Data
        </a>
        <a href="javascript:void(0)" data-target="tambah-periode" class="open text-xs bg-[var(--primary)] text-white font-medium px-4 py-3 rounded-md cursor-pointer hover:bg-[var(--primary)]/90 transition-colors">
            Tambah Data Periode
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
@include('components.admin.periode-magang.filter')
<x-table :headers="['No', 'Nama Periode', 'Tanggal Mulai', 'Tanggal Selesai', 'Status', 'Aksi']" :sortable="['Nama Periode']" :rows="$data" />
@if ($paginasi->hasPages())
    <div class="mt-4">
        {{ $paginasi->links() }}
    </div>
@else
    <h5 class="mt-4 cursor-default text-xs font-light text-[var(--primary-text)]">
        Menampilkan {{ count($data) ?? 0 }} dari {{ $total_periode ?? 'N/A' }} periode
    </h5>
@endif