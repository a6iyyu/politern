<div class="flex items-center justify-between mb-7">
    <h2 class="text-base font-semibold text-[var(--primary-text)]">
        Manajemen Lowongan Magang
    </h2>
    <a
        href="javascript:void(0)"
        data-target="tambah-lowongan"
        class="open text-sm bg-[var(--primary)] text-white px-4 py-3 rounded-md cursor-pointer hover:bg-[var(--primary)]/90 transition-colors"
    >
        Tambah Data Lowongan
    </a>
</div>
<x-table
    :headers="['Judul Lowongan', 'Perusahaan', 'Kuota', 'Periode', 'Status', 'Aksi']"
    :sortable="['Judul Lowongan', 'Status']"
    :rows="$data"
/>
@if ($paginasi->hasPages())
    <div class="mt-4">
        {{ $paginasi->links() }}
    </div>
@else
    <h5 class="mt-4 cursor-default text-xs font-light text-[var(--primary-text)]">
        Menampilkan {{ count($data) ?? 0 }} dari {{ $total_lowongan ?? 'N/A' }} lowongan
    </h5>
@endif