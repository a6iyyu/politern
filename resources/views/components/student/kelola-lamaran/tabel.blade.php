<h4 class="cursor-default my-2 text-base font-semibold text-[var(--primary)]">
    Riwayat Lamaran
</h4>
@if (session('success'))
    <h5 class="mb-4 p-4 cursor-default rounded-lg bg-emerald-50 border border-emerald-500 list-disc list-inside text-sm text-emerald-500">
        {{ session('success') }}
    </h5>
@elseif ($errors->any())
    <ul class="mb-7 p-4 cursor-default rounded-lg bg-red-50 border border-red-500 list-disc list-inside text-sm text-red-500">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
@include('components.student.kelola-lamaran.filter')
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