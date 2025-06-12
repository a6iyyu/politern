<section class="grid grid-cols-1 gap-4 lg:grid-cols-4">
    <x-select
        label="Status Lamaran"
        name="waktu"
        placeholder="-- Semua Status --"
        :options="['MENUNGGU' => 'Menunggu', 'DISETUJUI' => 'Disetujui', 'DITOLAK' => 'Ditolak']"
        :selected="request('waktu', '')"
        :required="true"
    />
    <x-select
        label="Periode Magang"
        name="periode"
        placeholder="-- Semua Periode --"
        :options="$periode_magang"
        :selected="request('periode', '')"
        :required="true"
    />
    <livewire:search
        icon="fa-solid fa-building"
        label="Cari nama perusahaan"
        name="perusahaan"
        placeholder="Cari nama perusahaan"
        :model="\App\Models\Perusahaan::class"
        :required="true"
    />
    <fieldset class="flex items-end justify-end">
        <button
            wire:click="search"
            class="cursor-pointer font-semibold bg-[#e86bb1] text-white rounded-lg text-sm px-10 py-3 transition-all duration-300 ease-in-out hover:bg-[#da78b0]"
            type="button"
        >
            Cari
        </button>
    </fieldset>
</section>