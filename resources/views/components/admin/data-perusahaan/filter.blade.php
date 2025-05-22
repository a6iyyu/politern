<section class="mt-4 flex flex-col justify-between lg:items-center lg:flex-row">
    <h5 class="cursor-default font-medium text-sm lg:text-base">Data Perusahaan Mitra</h5>
    <a href="" class="w-fit mt-4 text-sm bg-[var(--primary)] text-[var(--background)] font-medium px-5 py-2.5 rounded transition-all duration-300 ease-in-out lg:mt-0 lg:hover:bg-[#6965b7]">
        Tambah Data Perusahaan
    </a>
</section>
<section class="mt-8 grid grid-cols-1 gap-3 lg:grid-cols-3">
    <fieldset class="relative">
        <label for="" class="sr-only">Nama Perusahaan</label>
        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
        <input
            type="search"
            class="w-full pl-12 text-sm border border-[var(--stroke)] rounded-md pr-3 py-3 placeholder-[var(--secondary-text)] text-[var(--secondary-text)]"
            placeholder="Cth. PT. Pertamina"
        />
    </fieldset>
    <fieldset class="relative">
        <label for="" class="sr-only">Bidang</label>
        <i class="fa-solid fa-building absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
        <select name="" id="" class="appearance-none w-full pl-12 text-sm border border-[var(--stroke)] rounded-md pr-3 py-3">
            <option value="">Semua Bidang</option>
            <option value="">BUMN</option>
            <option value="">Industri</option>
            <option value="">Sipil</option>
            <option value="">Rintisan</option>
        </select>
        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 text-xs -translate-y-1/2 text-slate-400"></i>
    </fieldset>
    <fieldset class="relative">
        <label for="" class="sr-only">Lokasi</label>
        <i class="fa-solid fa-location-dot absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
        <select name="" id="" class="appearance-none w-full pl-12 text-sm border border-[var(--stroke)] rounded-md pr-3 py-3">
            <option value="">Dimana saja</option>
            <option value="">Malang</option>
            <option value="">Surabaya</option>
            <option value="">Jakarta</option>
            <option value="">Medan</option>
        </select>
        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 text-xs -translate-y-1/2 text-slate-400"></i>
    </fieldset>
</section>
<section class="mt-4 flex gap-4">
    <button type="button" class="cursor-pointer text-sm font-medium px-5 py-2.5 rounded-full border border-[var(--primary)] text-[var(--primary)] transition-all duration-300 ease-in-out lg:hover:bg-[#6965b7] lg:hover:text-white focus:bg-[var(--primary)] focus:text-[var(--background)]">
        Aktif
    </button>
    <button type="button" class="cursor-pointer text-sm font-medium px-5 py-2.5 rounded-full border border-[var(--primary)] text-[var(--primary)] transition-all duration-300 ease-in-out lg:hover:bg-[#6965b7] lg:hover:text-white focus:bg-[var(--primary)] focus:text-[var(--background)]">
        Tidak Aktif
    </button>
</section>