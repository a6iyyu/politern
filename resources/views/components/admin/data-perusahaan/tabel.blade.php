<section class="flex items-center justify-between mb-4">
    <h2 class="cursor-default text-base font-semibold text-[var(--primary-text)]">
        Data Perusahaan Mitra
    </h2>
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.data-dosen.ekspor-excel') }}" class="text-sm bg-[var(--primary)] text-white px-4 py-3 rounded-md cursor-pointer hover:bg-[var(--primary)]/90 transition-colors">
            <i class="fa fa-file-excel mr-2"></i> Ekspor Data
        </a>
        <a href="javascript:void(0)" data-target="tambah-perusahaan" class="open text-sm bg-[var(--primary)] text-white px-4 py-3 rounded-md cursor-pointer hover:bg-[var(--primary)]/90 transition-colors">
            Tambah Data Perusahaan
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
@include('components.admin.data-perusahaan.filter')
<x-table :headers="['No', 'Nama Perusahaan', 'NIB', 'Email', 'Lokasi', 'Status', 'Aksi']" :sortable="['Perusahaan']" :rows="$data" />
@if ($paginasi->hasPages())
    <div class="mt-4">
        {{ $paginasi->links() }}
    </div>
@else
    <h5 class="cursor-default mt-4 text-xs font-light text-[var(--primary-text)]">
        Menampilkan {{ count($data) ?? 0 }} dari {{ $total_perusahaan ?? 'N/A' }} perusahaan
    </h5>
@endif