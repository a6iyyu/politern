<div class="flex flex-col md:flex-row items-end gap-4 md:gap-6 w-full">
    <div class="flex flex-col">
        <label for="search" class="text-sm font-medium text-[var(--primary)] mb-2">Cari Aktivitas</label>
        <div class="flex gap-2">
            <div class="relative w-80">
                <span class="absolute inset-y-0 left-3 flex items-center text-[var(--primary)]">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </span>
                <input type="text" name="search" id="search" placeholder="Nama Aktivitas..."
                    class="w-full flex-grow pl-9 pr-3 py-2 placeholder-[var(--text-secondary)] text-[var(--text-secondary)] border border-[var(--stroke)] rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-[var(--primary)]">
            </div>
            <button type="submit"
                class="inline-block w-[80px] text-center px-4 py-2 bg-[var(--secondary)] text-white text-sm font-medium rounded-md">
                Cari
            </button>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="relative w-full md:w-56">
            <select name="periode" id="periode"
                class="appearance-none w-full text-[var(--text-secondary)] border border-[var(--stroke)] rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[var(--primary)]">
                <option value="">Urutkan</option>
                <option value="asc">Terbaru</option>
                <option value="desc">Terlama</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-[var(--text-secondary)]">
                <i class="fa-solid fa-chevron-down text-sm"></i>
            </div>
        </div>
    </div>

    <div class="ml-auto mt-auto justify-end">
        <a href="#"
            class="flex items-center gap-2 px-4 py-3 text-sm text-white bg-[var(--tersier-hijau)] rounded-md hover:bg-[var(--tersier-hijau)] text-center">
            <i class="fa-solid fa-plus text-white"></i>
            Tambah Log Aktivitas
        </a>
    </div>
</div>
