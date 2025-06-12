<h4 class="cursor-default my-5 text-base font-semibold text-[var(--primary)]">
    Riwayat Lamaran
</h4>
<x-table
    :headers="['No', 'Nama Perusahaan', 'Posisi Magang', 'Periode Magang', 'Tanggal Pengajuan',  'Status', 'Aksi']"
    :sortable="['Tanggal Pengajuan']"
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