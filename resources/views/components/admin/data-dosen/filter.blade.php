<div class="mb-7 grid grid-cols-1 gap-4 lg:grid-cols-4">
    
    <x-select
        id="#"
        label="#"
        name="#"
        placeholder="--Semua--"
        :required="false"
    />
    
    <x-input
        id="nama_lengkap"
        icon="fa-solid fa-magnifying-glass"
        label="Cari nama dosen"
        name="nama_lengkap"
        placeholder="Cari nama dosen"
        type="text"
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
