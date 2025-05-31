<div class="flex items-center justify-between mb-7">
    <h2 class="text-base font-semibold text-[var(--primary-text)]">
        Manajemen Pengajuan Magang
    </h2>   
</div>

@include('components.admin.pengajuan-magang.filter')

<x-table
    :headers="['ID', 'Tanggal Pengajuan', 'NIM', 'Mahasiswa', 'Perusahaan', 'Posisi', 'Status', 'Aksi']"
    :sortable="[]"
    :rows="$data"
/>
@if ($paginasi->hasPages())
    <div class="mt-4">
        {{ $paginasi->links() }}
    </div>
@else
    <h5 class="mt-4 cursor-default text-xs font-light text-[var(--primary-text)]">
        Menampilkan {{ count($data) ?? 0 }} dari {{ $total_pengajuan_magang ?? 'N/A' }} pengajuan magang
    </h5>
@endif