<div class="p-6 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
    <h4 class="cursor-default mb-5 text-base font-semibold text-[var(--primary)]">
        Riwayat Lamaran
    </h4>
    <x-table
        :headers="['Tanggal Pengajuan', 'Nama Perusahaan', 'Posisi Magang',  'Status', 'Aksi']"
        :sortable="['Tanggal Pengajuan']"
        :rows="$data"
    />
</div>
@if ($paginasi->hasPages())
    <div class="mt-4">
        {{ $paginasi->links() }}
    </div>
@else
    <h5 class="mt-4 cursor-default text-xs font-light text-[var(--primary-text)]">
        Menampilkan {{ count($data) ?? 0 }} dari {{ $total_pengajuan_magang ?? 'N/A' }} pengajuan magang
    </h5>
@endif