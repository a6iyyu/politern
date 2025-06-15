<form action="{{ route('dosen.log-aktivitas') }}" method="GET" class="mb-7 grid grid-cols-1 lg:grid-cols-4 gap-4 w-auto">
    <x-input
        icon="fa-solid fa-magnifying-glass"
        label="Cari Mahasiswa"
        name="nama_lengkap"
        placeholder="Cari Mahasiswa"
        type="text"
        :required="false"
    />
    <x-select
        label="Perusahaan"
        name="perusahaan"
        :options="$perusahaan"
        :selected="request('perusahaan', '')"
        :required="false"
    />
    <x-select
        label="Status"
        name="status"
        :options="$status_aktivitas"
        :selected="request('status', '')"
        :required="false"
    />
    <div class="flex items-end">
        <button type="submit" class="cursor-pointer bg-[var(--secondary)] border border-[var(--secondary)] text-white px-12 py-2 rounded-md transition-all duration-300 ease-in-out text-sm lg:py-2.5 lg:hover:bg-[#ff86cb] w-full sm:w-auto">
            Cari
        </button>
    </div>
</form>
@if ($periode_magang)
    <div class="cursor-default flex items-center mb-6 gap-2">
        <h5 class="text-sm text-[var(--secondary-text)]">Periode Aktif:</h5>
        <h5 class="px-4 py-2 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
            {{ $periode_magang->nama_periode }}
        </h5>
    </div>
@endif