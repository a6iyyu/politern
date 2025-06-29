<form action="{{ route('admin.data-perusahaan') }}" method="GET" class="mb-7 grid grid-cols-1 gap-4 lg:grid-cols-5">
    <div class="lg:col-span-2">
        <x-input
            id="nama_perusahaan"
            icon="fa-solid fa-magnifying-glass"
            label="Cari Perusahaan"
            name="nama_perusahaan"
            placeholder="Cari Perusahaan"
            type="text"
            :value="request('nama_perusahaan')"
            :required="false"
        />
    </div>
    <div class="lg:col-span-2">
        <x-select
            id="lokasi"
            label="Lokasi"
            name="lokasi"
            :options="['' => 'Semua Lokasi'] + ($lokasi_filter ?? [])"
            :selected="request('lokasi')"
            :required="false"
        />
    </div>
    <div class="flex items-end justify-end">
        <button type="submit" class="cursor-pointer bg-[var(--secondary)] border border-[var(--secondary)] text-white px-12 py-2 rounded-md transition-all duration-300 ease-in-out text-sm lg:py-2.5 lg:hover:bg-[#ff86cb]">
            Cari
        </button>
    </div>
</form>