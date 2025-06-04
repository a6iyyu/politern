<section class="mb-7 grid grid-cols-1 gap-4 lg:grid-cols-3">
    <livewire:search
        icon="fa-solid fa-magnifying-glass"
        label="Cari nama perusahaan"
        name="nama"
        placeholder="Cth. PT. Pertamina"
        :model="\App\Models\Perusahaan::class"
        :required="false"
    />
    <x-select
        icon="fa-solid fa-building"
        label="Bidang"
        name="bidang"
        placeholder="Cth. BUMN"
        :options="$bidang ?? ['Tidak ada data.']"
        :required="false"
    />
    <x-select
        icon="fa-solid fa-location-dot"
        label="Kota"
        name="kota"
        placeholder="Cth. Malang"
        :options="$kota ?? ['Tidak ada data.']"
        :required="false"
    />
</section>