<section class="flex items-center justify-between mb-5">
    <h2 class="cursor-default text-base font-semibold text-[var(--primary-text)]">
        Data Mahasiswa Bimbingan
    </h2>
</section>
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
@include('components.lecturer.data-mahasiswa.filter')
<x-table :headers="['No', 'Mahasiswa', 'NIM', 'Program Studi','Periode Magang', 'Perusahaan', 'Bidang', 'Status', 'Aksi']" :sortable="['Mahasiswa', 'Status']" :rows="$data" />
@if ($paginasi->hasPages())
    <div class="mt-4">
        {{ $paginasi->links() }}
    </div>
@else
    <h5 class="mt-4 cursor-default text-xs font-light text-[var(--primary-text)]">
        Menampilkan {{ count($data) ?? 0 }} dari {{ $total_mahasiswa ?? 'N/A' }} mahasiswa
    </h5>
@endif