<section class="overflow-x-auto">
    <div class="min-w-[900px] grid grid-cols-3 gap-4 px-7 pt-7 pb-4 bg-white border border-slate-200 border-b-0 rounded-t-xl">
        <fieldset class="relative">
            <label for="nama" class="sr-only">Nama Pekerjaan</label>
            <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input
                wire:model.defer="judul"
                class="w-full border pl-11 pr-3.5 py-2.75 rounded-lg text-sm border-[var(--primary)] text-[var(--secondary-text)] focus:outline-slate-400"
                name="nama"
                id="nama"
                placeholder="Cari Nama Pekerjaan"
                type="search"
            />
        </fieldset>
        <fieldset class="relative">
            <label for="lokasi" class="sr-only">Lokasi</label>
            <i class="fa-solid fa-location-dot absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input
                wire:model.defer="lokasi"
                class="w-full border pl-11 pr-3.5 py-2.75 rounded-lg text-sm border-[var(--primary)] text-[var(--secondary-text)] focus:outline-slate-400"
                name="lokasi"
                id="lokasi"
                placeholder="Lokasi"
                type="search"
            />
        </fieldset>
        <fieldset class="relative">
            <label for="perusahaan" class="sr-only">Perusahaan</label>
            <i class="fa-solid fa-building absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input
                wire:model.defer="namaPerusahaan"
                class="w-full border pl-11 pr-3.5 py-2.75 rounded-lg text-sm border-[var(--primary)] text-[var(--secondary-text)] focus:outline-slate-400"
                name="perusahaan"
                id="perusahaan"
                placeholder="Perusahaan"
                type="search"
            />
        </fieldset>
    </div>
</section>
<section class="overflow-x-auto">
    <div class="min-w-[900px] grid grid-cols-5 gap-4 px-7 pb-7 bg-white border border-slate-200 border-t-0 rounded-b-xl">
        <fieldset class="relative">
            <label for="gaji_min" class="sr-only">Gaji Minimal</label>
            <i class="fa-solid fa-money-bill-wave absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input
                wire:model.defer="gajiMinimal"
                class="w-full border pl-11 pr-3.5 py-2.75 rounded-lg text-sm border-[var(--primary)] text-[var(--secondary-text)] focus:outline-slate-400"
                name="gaji_min"
                id="gaji_min"
                placeholder="Gaji Minimal"
                type="number"
                min="0"
            />
        </fieldset>
        <fieldset class="relative">
            <label for="gaji_max" class="sr-only">Gaji Maksimal</label>
            <i class="fa-solid fa-money-check-dollar absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input
                wire:model.defer="gajiMaksimal"
                class="w-full border pl-11 pr-3.5 py-2.75 rounded-lg text-sm border-[var(--primary)] text-[var(--secondary-text)] focus:outline-slate-400"
                name="gaji_max"
                id="gaji_max"
                placeholder="Gaji Maksimal"
                type="number"
                min="0"
            />
        </fieldset>
        <fieldset class="relative">
            <label for="tipe" class="sr-only">Tipe</label>
            <i class="fa-solid fa-briefcase absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <select
                wire:model.defer="tipe"
                class="w-full border pl-11 pr-3.5 py-2.75 rounded-lg text-sm appearance-none border-[var(--primary)] text-[var(--secondary-text)] focus:outline-slate-400"
                name="tipe"
                id="tipe"
            >
                <option value="">Semua Tipe</option>
                <option value="Remote">Remote</option>
                <option value="Onsite">Onsite</option>
                <option value="Hybrid">Hybrid</option>
            </select>
        </fieldset>
        <fieldset class="relative">
            <label for="waktu" class="sr-only">Waktu Posting</label>
            <i class="fa-solid fa-clock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <select
                wire:model.defer="waktuPosting"
                class="w-full border pl-11 pr-3.5 py-2.75 rounded-lg text-sm appearance-none border-[var(--primary)] text-[var(--secondary-text)] focus:outline-slate-400"
                name="waktu"
                id="waktu"
            >
                <option value="">Semua Waktu</option>
                <option value="1">1 hari terakhir</option>
                <option value="3">3 hari terakhir</option>
                <option value="7">7 hari terakhir</option>
                <option value="30">30 hari terakhir</option>
            </select>
        </fieldset>
        <button
            wire:click="search"
            class="w-full bg-[#e86bb1] text-white px-6 py-2.5 rounded-lg text-sm hover:bg-opacity-90 transition"
            type="button"
        >
            Cari
        </button>
    </div>
</section>