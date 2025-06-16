<form action="{{ route('admin.pengajuan-magang') }}" method="GET" class="mb-7 grid grid-cols-1 gap-4 lg:grid-cols-5">
    <x-input
        icon="fa-solid fa-magnifying-glass"
        label="Cari Mahasiswa"
        name="nama_lengkap"
        placeholder="Cari Mahasiswa"
        type="text"
        :required="false"
    />
    <x-select
        label="Program Studi"
        name="program_studi"
        :options="['' => 'Semua Program Studi'] + ($program_studi->pluck('nama', 'id_prodi')->toArray() ?? 'Tidak ada data.')"
        :selected="request('program_studi')"
        :required="false"
    />
    <x-select
        label="Perusahaan"
        name="perusahaan"
        :options="['' => 'Semua Perusahaan'] + ($perusahaan->pluck('nama', 'id_perusahaan_mitra')->toArray() ?? 'Tidak ada data.')"
        :selected="request('perusahaan', '')"
        :required="false"
    />
    <x-select
        label="Periode"
        name="periode"
        :options="['' => 'Semua Periode'] + ($periodes->pluck('nama_periode', 'id_periode')->toArray() ?? 'Tidak ada data.')"
        :selected="request('periode', '')"
        :required="false"
    />
    <div class="flex items-end justify-end">
        <button type="submit" class="cursor-pointer bg-[var(--secondary)] border border-[var(--secondary)] text-white px-12 py-2 rounded-md transition-all duration-300 ease-in-out text-sm lg:py-2.5 lg:hover:bg-[#ff86cb] w-full sm:w-auto">
            Cari
        </button>
    </div>
</form>
@if (isset($periode_magang) && !empty($periode_magang))
    <div class="cursor-default flex items-center mb-6 gap-2">
        <h5 class="text-sm text-[var(--secondary-text)]">Periode Aktif:</h5>
        <h5 class="px-4 py-2 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
            {{ $periode_magang->nama_periode }}
        </h5>
    </div>
@endif