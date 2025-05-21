<div class="flex flex-col md:flex-row items-end justify-between gap-4 md:gap-6 w-full">
    <div class="flex flex-col">
        <label for="search" class="text-sm font-medium text-[var(--primary)] mb-2">Data Perusahaan Mitra</label>
        <div class="flex gap-2">
            <div class="relative w-80">
                <span class="absolute inset-y-0 left-3 flex items-center text-[var(--primary)]">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </span>
                <input type="text" name="search" id="search" placeholder="Cari nama perusahaan"
                    class="w-full flex-grow pl-9 pr-3 py-2 placeholder-[var(--secondary-text)] text-[var(--secondary-text)] border border-[var(--stroke)] rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-[var(--primary)]">
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="relative w-full md:w-50">
            <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-[var(--secondary-text)]">
                <i class="fa-solid fa-chevron-down text-sm"></i>
            </div>
            <select name="bidang" id="bidang"
                class="appearance-none w-full text-[var(--secondary-text)] border border-[var(--stroke)] rounded-md pl-10 pr-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[var(--primary)]">
                <option value="">Bidang</option>
                <option value="#">?</option>
                <option value="#">?</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-[var(--secondary-text)]">
                <i class="fa-solid fa-chevron-down text-sm"></i>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="relative w-full md:w-50">
            <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-[var(--secondary-text)]">
                <i class="fa-solid fa-location-dot text-[var(--primary)]"></i>
            </div>
            <select name="periode" id="periode"
                class="appearance-none w-full text-[var(--secondary-text)] border border-[var(--stroke)] rounded-md pl-10 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[var(--primary)]">
                <option value="">Dimana Saja</option>
                <option value="#"></option>
                <option value="#"></option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-[var(--secondary-text)]">
                <i class="fa-solid fa-chevron-down text-sm"></i>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="relative w-full md:w-30">
            <label class="text-sm">Show</label>
            <select name="sort" id="sort"
                class="appearance-none w-full text-[var(--secondary-text)] border border-[var(--stroke)] rounded-md pl-10 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[var(--primary)]">
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
            <label class="text-sm">entries</label>
            <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-[var(--secondary-text)]">
                <i class="fa-solid fa-sort text-[var(--primary)]"></i>
            </div>
        </div>
    </div>

    {{-- <div class="ml-auto mt-auto justify-end">
        <a href="#"
            class="flex items-center gap-2 px-4 py-2 text-sm text-white bg-[var(--green-tertiary)] rounded-md hover:bg-[var(--green-tertiary)] text-center">
            <i class="fa-solid fa-plus text-white"></i>
            Tambah Log Aktivitas
        </a>
    </div> --}}
</div>