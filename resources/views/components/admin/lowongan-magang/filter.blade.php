<form action="" method="GET" class="mb-7 grid grid-cols-1 gap-4 lg:grid-cols-4">
    @method('GET')
    <x-select
        id="posisi"
        label="Posisi"
        name="posisi"
        :options="['' => 'Semua Posisi'] + ($bidang_filter->pluck('nama_bidang', 'id_bidang')->toArray() ?? [])"
        :required="false"
    />
    <x-select
        id="perusahaan"
        label="Perusahaan"
        name="perusahaan"
        :options="['' => 'Semua Perusahaan'] + ($perusahaan_filter->pluck('nama', 'id_perusahaan_mitra')->toArray() ?? [])"
        :required="false"
    />
    <x-select
        id="periode"
        label="Periode"
        name="periode"
        :options="['' => 'Semua Periode'] + ($periode_filter->pluck('nama_periode', 'id_periode')->toArray() ?? [])"
        :required="false"
    />
    <div class="flex items-end justify-end">
        <button type="submit" class="cursor-pointer bg-[var(--secondary)] border border-[var(--secondary)] text-white px-12 py-2 rounded-md transition-all duration-300 ease-in-out text-sm lg:py-2.5 lg:hover:bg-[#ff86cb] w-full sm:w-auto">
            Cari
        </button>
    </div>
</form>