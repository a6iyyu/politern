<div class="flex items-center justify-between mb-7">
    <h2 class="text-base font-semibold text-[var(--primary-text)]">
        Daftar Mahasiswa Bimbingan
    </h2>
    <a
        href="javascript:void(0)"
        data-target="tambah-mahasiswa"
        class="open text-sm bg-[var(--primary)] text-white px-4 py-3 rounded-md cursor-pointer hover:bg-[var(--primary)]/90 transition-colors"
    >
        Tambah Data Mahasiswa
    </a>
</div>
<x-table
    :headers="['No', 'Mahasiswa', 'NIM', 'Program Studi', 'Angkatan', 'Semester', 'Status', 'Aksi']"
    :sortable="['Mahasiswa', 'Status']"
    :rows="$data"
/>
@if ($paginasi->hasPages())
    <div class="mt-4">
        {{ $paginasi->links() }}
    </div>
@else
    <h5 class="mt-4 cursor-default text-xs font-light text-[var(--primary-text)]">
        Menampilkan {{ count($data) ?? 0 }} dari {{ $total_mahasiswa ?? 'N/A' }} mahasiswa
    </h5>
@endif