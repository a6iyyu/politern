<section class="flex items-center justify-between mb-7">
    <h5 class="text-base font-semibold text-[var(--primary-text)]">
        Periode Magang
    </h5>
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.periode-magang.ekspor-excel') }}" 
            class="text-sm bg-[var(--primary)] text-white px-4 py-3 rounded-md cursor-pointer hover:bg-[var(--primary)]/90 transition-colors">
            <i class="fa fa-file-excel mr-2"></i> Ekspor Data
        </a>
        <button href="javascript:void(0)" data-target="tambah-periode" 
            class="open text-sm bg-[var(--primary)] text-white px-4 py-3 rounded-md cursor-pointer hover:bg-[var(--primary)]/90 transition-colors">
            Tambah Periode
        </button>
    </div>
</section>
<x-table
    :headers="['Nama Periode', 'Durasi', 'Tanggal Mulai', 'Tanggal Selesai', 'Status', 'Aksi']"
    :sortable="['Nama Periode']"
    :rows="$data"
/>
@if ($paginasi->hasPages())
    <div class="mt-4">
        {{ $paginasi->links() }}
    </div>
@else
    <h5 class="mt-4 cursor-default text-xs font-light text-[var(--primary-text)]">
        Menampilkan {{ count($data) ?? 0 }} dari {{ $total_periode ?? 'N/A' }} periode
    </h5>
@endif