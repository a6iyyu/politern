<form action="" method="GET" class="mb-7 flex flex-wrap items-end gap-4 w-auto">
    @csrf
    @method('GET')
    <div class="w-80">
        <x-input
            id="nama_lengkap"
            icon="fa-solid fa-magnifying-glass"
            label="Cari Mahasiswa"
            name="nama_lengkap"
            placeholder="Cari Mahasiswa"
            type="text"
            :required="false"
        />
    </div>
    <div class="w-80">
        <x-select
            id="program_studi"
            label="Program Studi"
            name="program_studi"
            :options="['' => 'Semua Program Studi'] + ($program_studi->pluck('nama', 'id_prodi')->toArray() ?? [])"
            :required="false"
        />
    </div>
    <div class="w-80">
        <x-select
            id="status"
            label="Status"
            name="status"
            :options="['' => 'Semua Status'] + $status_aktivitas"
            :required="false"
        />
    </div>
    <div class="w-full sm:w-auto">
        <button type="submit" class="cursor-pointer bg-[var(--secondary)] border border-[var(--secondary)] text-white px-12 py-2 rounded-md transition-all duration-300 ease-in-out text-sm lg:py-2.5 lg:hover:bg-[#ff86cb] w-full sm:w-auto">
            Cari
        </button>
    </div>
</form>