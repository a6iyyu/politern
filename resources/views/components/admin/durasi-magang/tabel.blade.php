<section class="flex items-center justify-between mb-9">
    <h2 class="cursor-default text-base font-semibold text-[var(--primary-text)]">
        Daftar Durasi Magang
    </h2>
    <a href="javascript:void(0)" data-target="tambah-durasi" class="open text-xs bg-[var(--primary)] text-white font-medium px-4 py-3 rounded-md cursor-pointer hover:bg-[var(--primary)]/90 transition-colors">
        Tambah Data Durasi
    </a>
</section>
@if (session('success'))
    <h5 class="mb-7 p-4 cursor-default rounded-lg bg-emerald-50 border border-emerald-500 list-disc list-inside text-sm text-emerald-500">
        {{ session('success') }}
    </h5>
@elseif ($errors->any())
    <ul class="mb-7 p-4 cursor-default rounded-lg bg-red-50 border border-red-500 list-disc list-inside text-sm text-red-500">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
@include('components.admin.durasi-magang.filter')
<x-table :headers="['No', 'Nama Durasi', 'Aksi']" :sortable="['Nama Durasi']" :rows="$data_durasi" />
@if ($paginasi->hasPages())
    <div class="mt-4">
        {{ $paginasi->links() }}
    </div>
@else
    <h5 class="mt-4 cursor-default text-xs font-light text-[var(--primary-text)]">
        Menampilkan {{ count($data_durasi) ?? 0 }} dari {{ $total_durasi ?? 'N/A' }} durasi
    </h5>
@endif