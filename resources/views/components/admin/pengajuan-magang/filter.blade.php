<form action="" class="mb-7 grid grid-cols-1 gap-4 lg:grid-cols-4" method="GET" enctype="multipart/form-data">
    @csrf
    @method('GET')
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
        placeholder="-- Semua Program Studi --"
        :options="$program_studi->pluck('nama', 'id_prodi')->toArray() ?? 'Tidak ada data.'"
        :selected="request('program_studi')"
        :required="false"
    />
    <x-select
        label="Perusahaan"
        name="perusahaan"
        placeholder="-- Semua Perusahaan --"
        :options="$perusahaan->pluck('nama', 'id_perusahaan_mitra')->toArray()"
        :selected="request('perusahaan', '')"
        :required="false"
    />
    <section class="flex items-end lg:justify-right">
        <button type="submit" class="cursor-pointer bg-[var(--secondary)] border border-[var(--secondary)] text-white px-7 py-2 rounded-md transition-all duration-300 ease-in-out text-sm lg:py-2.5 lg:hover:bg-[#ff86cb]">
            Cari
        </button>
    </section>
</form>
@if ($periode_magang)
    <div class="cursor-default flex items-center mb-6 gap-2">
        <h5 class="text-sm text-[var(--secondary-text)]">Periode Aktif:</h5>
        <h5 class="px-4 py-2 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
            {{ $periode_magang->nama_periode }}
        </h5>
    </div>
@endif