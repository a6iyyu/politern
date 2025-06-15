<form action="{{ route('dosen.data-mahasiswa') }}" method="GET" class="mb-7 grid grid-cols-1 gap-4 lg:grid-cols-4">
    <x-input
        id="nama_lengkap"
        icon="fa-solid fa-magnifying-glass"
        label="Cari Mahasiswa"
        name="nama_lengkap"
        placeholder="Cari Mahasiswa"
        type="text"
        :required="false"
    />
    <x-select
        id="periode_magang"
        label="Periode Magang"
        name="periode_magang"
        :options="['' => 'Semua Periode Magang'] + $periode_magang"
        :required="false"
    />
    <x-select
        id="status"
        label="Status Magang"
        name="status"
        :options="['' => 'Semua Status'] + array_filter($status_aktivitas, fn($key) => $key !== 'BELUM MAGANG', ARRAY_FILTER_USE_KEY)"
        :required="false"
    />
    <div class="flex items-end justify-end">
        <button type="submit" class="cursor-pointer bg-[var(--secondary)] border border-[var(--secondary)] text-white px-12 py-2 rounded-md transition-all duration-300 ease-in-out text-sm lg:py-2.5 lg:hover:bg-[#ff86cb] w-full sm:w-auto">
            Cari
        </button>
    </div>
</form>