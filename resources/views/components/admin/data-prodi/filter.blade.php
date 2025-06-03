<div class="mb-7 grid grid-cols-1 gap-4 lg:grid-cols-4">
    <x-input
        id="nama_prodi"
        icon="fa-solid fa-magnifying-glass"
        label="Cari Prodi"
        name="nama_prodi"
        placeholder="Cari Prodi"
        type="text"
        :required="false"
    />

    <x-select
        id="jenjang_prodi"
        label="Jenjang"
        name="jenjang"
        :options="['' => '-- Semua Jenjang --'] + ($jenjang ?? [])"
        :required="false"
    />

    <div class="flex items-end lg:justify-right">
        <button
            type="button"
            class="cursor-pointer bg-[var(--secondary)] border border-[var(--secondary)] text-white px-7 py-2 rounded-md transition-all duration-300 ease-in-out text-sm lg:py-2.5 lg:hover:bg-[#ff86cb]"
            onclick="filterData()"
        >
            Cari
        </button>
    </div>
</div>
