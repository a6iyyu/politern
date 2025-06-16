<form action="{{ route('mahasiswa.log-aktivitas') }}" method="GET" class="mb-7 grid grid-cols-1 gap-4 lg:grid-cols-3">
    <x-input
        id="judul"
        icon="fa-solid fa-magnifying-glass"
        label="Cari Judul"
        name="judul"
        placeholder="Cari Judul Aktivitas"
        type="text"
        :required="false"
    />
    <x-select
        id="status"
        label="Status"
        name="status"
        :options="['' => 'Semua Status'] + $status_aktivitas"
        :required="false"
    />
    <div class="flex items-end justify-end">
        <button type="submit" class="cursor-pointer bg-[var(--secondary)] border border-[var(--secondary)] text-white px-12 py-2 rounded-md transition-all duration-300 ease-in-out text-sm lg:py-2.5 lg:hover:bg-[#ff86cb] w-full sm:w-auto">
            Cari
        </button>
    </div>
</form>