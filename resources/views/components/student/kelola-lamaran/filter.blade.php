<div class="flex flex-col md:flex-row gap-4 md:gap-6">
    <div class="flex flex-col">
        <label for="status" class="text-sm font-medium text-[var(--primary)] mb-2">Status Lamaran</label>
        <div class="relative w-full md:w-56">
            <select name="status" id="status"
                class="appearance-none w-full text-[var(--text-secondary)] border border-[var(--stroke)] rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[var(--primary)]">
                <option value="">Semua Status</option>
                <option value="Diterima">Diterima</option>
                <option value="Menunggu">Menunggu</option>
                <option value="Ditolak">Ditolak</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-[var(--text-secondary)]">
                <i class="fa-solid fa-chevron-down text-sm"></i>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <label for="periode" class="text-sm font-medium text-[var(--primary)] mb-2">Periode Magang</label>
        <div class="relative w-full md:w-56">
            <select name="periode" id="periode"
                class="appearance-none w-full text-[var(--text-secondary)] border border-[var(--stroke)] rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[var(--primary)]">
                <option value="">Semua Periode</option>
                <option value="2025-01">Januari 2025</option>
                <option value="2025-05">Mei 2025</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-[var(--text-secondary)]">
                <i class="fa-solid fa-chevron-down text-sm"></i>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <label for="search" class="text-sm font-medium text-[var(--primary)] mb-2">Cari Nama Perusahaan</label>
        <div class="flex gap-2">
            <input type="text" name="search" id="search" placeholder="Nama Perusahaan..."
                class="w-64 flex-grow placeholder-[var(--text-secondary)] text-[var(--text-secondary)] border border-[var(--stroke)] rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[var(--primary)]">
            <button type="submit"
                class="inline-block w-[80px] text-center px-4 py-2 bg-[var(--secondary)] text-white text-sm font-medium rounded-md ">
                Cari
            </button>
        </div>
    </div>
</div>
