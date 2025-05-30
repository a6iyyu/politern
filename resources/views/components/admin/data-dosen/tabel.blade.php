<div class="flex items-center justify-between mb-7">
    <h2 class="text-base font-semibold text-[var(--primary-text)]">
        Daftar Data Dosen
    </h2>
    <a
        href="javascript:void(0)"
        data-target="tambah-dosen"
        class="open text-sm bg-[var(--primary)] text-white px-4 py-3 rounded-md cursor-pointer hover:bg-[var(--primary)]/90 transition-colors"
    >
        Tambah Data Dosen
    </a>
</div>
<x-table
    :headers="['No', 'Dosen', 'NIP', 'Nomor Telepon', 'Aksi']"
    :sortable="['Dosen']"
    :rows="$data"
/>
@if ($paginasi->hasPages())
    <div class="mt-4">
        {{ $paginasi->links() }}
    </div>
@else
    <h5 class="cursor-default mt-4 text-xs font-light text-[var(--primary-text)]">
        Menampilkan {{ count($data) ?? 0 }} dari {{ $total_dosen ?? 'N/A' }} dosen
    </h5>
@endif