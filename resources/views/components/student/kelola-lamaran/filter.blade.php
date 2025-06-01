<section class="overflow-x-auto mb-5">
    <div class="min-w-[900px] grid grid-cols-4 gap-4 px-7 pt-7 pb-4 bg-white border border-slate-200 rounded-xl">
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
        <fieldset class="relative">
            <label for="perusahaan" class="block text-sm font-medium text-slate-700 mb-2.5">Cari Nama Perusahaan</label>
            <i class="fa-solid fa-building absolute left-4 top-7/10 -translate-y-1/2 text-slate-400"></i>
            <input
                wire:model.defer="namaPerusahaan"
                class="w-full border pl-11 pr-3.5 py-2.75 rounded-lg text-sm border-[var(--primary)] text-[var(--secondary-text)] focus:outline-slate-400"
                name="perusahaan"
                id="perusahaan"
                placeholder="Perusahaan"
                type="search"
            />
        </fieldset>
        <fieldset class="flex items-end justify-end">
            <button
                wire:click="search"
                class="cursor-pointer font-semibold bg-[#e86bb1] text-white rounded-lg text-sm px-10 py-3 transition-all duration-300 ease-in-out hover:bg-[#da78b0]"
                type="button"
            >
                Cari
            </button>
        </fieldset>
    </div>
</section>