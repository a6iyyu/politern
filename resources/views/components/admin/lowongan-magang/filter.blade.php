<form action="" method="GET" class="mb-7 flex flex-wrap items-end gap-4 w-auto">
    @csrf
    @method('GET')
    <div class="w-80">
        <x-input
            id="nama_lengkap"
            icon="fa-solid fa-magnifying-glass"
            label="Cari Lowongan"
            name="nama_lowonggan"
            placeholder="Cari Lowongan"
            type="text"
            :required="false"
        />
    </div>
    <div class="w-80">
        <x-select
            id="perusahaan"
            label="Perusahaan"
            name="perusahaan"
            :options="['' => 'Semua Perusahaan'] + ($perusahaan_filter->pluck('nama', 'id_perusahaan_mitra')->toArray() ?? [])"
            :required="false"
        />
    </div>
    <div class="w-80">
        <x-select
            id="periode"
            label="Periode"
            name="periode"
            :options="['' => 'Semua Periode'] + ($periode_filter->pluck('nama_periode', 'id_periode')->toArray() ?? [])"
            :required="false"
        />
    </div>
    <div class="w-full sm:w-auto">
        <button type="submit" class="cursor-pointer bg-[var(--secondary)] border border-[var(--secondary)] text-white px-12 py-2 rounded-md transition-all duration-300 ease-in-out text-sm lg:py-2.5 lg:hover:bg-[#ff86cb] w-full sm:w-auto">
            Cari
        </button>
    </div>
</form>