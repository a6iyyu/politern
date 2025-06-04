<x-table :headers="['Tanggal Pengajuan', 'Mahasiswa', 'Perusahaan', 'Posisi', 'Status', 'Aksi', 'Konfirmasi']" :sortable="['Tanggal Pengajuan', 'Mahasiswa']" :rows="$data" />
@if ($paginasi->hasPages())
    <div class="mt-4">
        {{ $paginasi->links() }}
    </div>
@else
    <h5 class="mt-4 cursor-default text-xs font-light text-[var(--primary-text)]">
        Menampilkan {{ count($data) ?? 0 }} dari {{ $total_pengajuan_magang ?? 'N/A' }} pengajuan magang
    </h5>
@endif