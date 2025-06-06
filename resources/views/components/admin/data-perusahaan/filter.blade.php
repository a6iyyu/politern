<section class="mb-7 flex flex-wrap items-end gap-4 w-auto">
    <div class="w-80">
        <livewire:search
            icon="fa-solid fa-magnifying-glass"
            label="Cari nama perusahaan"
            name="nama"
            placeholder="Cari nama perusahaan"
            :model="\App\Models\Perusahaan::class"
            :required="false"
        />
    </div>
    <div class="w-80">
        <x-select
            icon="fa-solid fa-location-dot"
            label="Lokasi"
            name="lokasi"
            :options="['' => 'Semua Lokasi'] + $lokasi_filter"
            :required="false"
        />
    </div>
    <div class="w-full sm:w-auto">
        <button type="submit" class="cursor-pointer bg-[var(--secondary)] border border-[var(--secondary)] text-white px-12 py-2 rounded-md transition-all duration-300 ease-in-out text-sm lg:py-2.5 lg:hover:bg-[#ff86cb]">
            Cari
        </button>
    </div>
</section>