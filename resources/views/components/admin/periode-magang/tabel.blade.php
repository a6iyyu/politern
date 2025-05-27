<section class="p-6 mt-2 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
    <div class="flex items-center justify-between mb-7">
        <h2 class="text-base font-semibold text-[var(--primary-text)]">
            Periode Magang
        </h2>
        <a href="" class="text-sm bg-[var(--primary)] text-white px-4 py-3 rounded-md cursor-pointer hover:bg-[var(--primary)]/90 transition-colors">
            Tambah Periode
        </a>
    </div>
    
    <div class="flex items-center justify-between mb-7">
        <div class="flex items-center gap-4">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fas fa-search text-[var(--primary)] text-sm"></i>
                </div>
                <input type="text" id="search" name="search" placeholder="Cari periode" class="md:w-64 text-sm text-[var(--primary-text)] border border-[var(--primary)] rounded px-4 py-2 pl-10 bg-white min-w-[250px] focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:border-transparent">
            </div>

            <div class="flex items-center gap-2">
                <div class="relative">
                    <img src="/icons/data-mahasiswa-biru.svg" alt="Lokasi" class="absolute left-4 top-1/2 -translate-y-1/2 h-5 w-5" />
                    <select id="filter" name="filter" class="md:w-64 text-sm text-[var(--primary-text)] border border-[var(--primary)] rounded px-4 pl-10 py-2  bg-white appearance-none min-w-[200px] focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:border-transparent">
                        <option value="">Semester</option>
                        <option value="2022">Genap</option>
                        <option value="2023">Ganjil</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <i class="fas fa-chevron-down text-[var(--primary)] text-sm"></i>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <div class="relative">
                    <i class="fa-solid fa-calendar absolute left-4 top-1/2 -translate-y-1/2 text-[var(--primary)]"></i>
                    <select id="filter" name="filter" class="md:w-64 text-sm text-[var(--primary-text)] border border-[var(--primary)] rounded px-4 pl-10 py-2  bg-white appearance-none min-w-[200px] focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:border-transparent">
                        <option value="">Tahun</option>
                        <option value="2022">2023</option>
                        <option value="2023">2024</option>
                        <option value="2024">2025</option>
                        <option value="2025">2026</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <i class="fas fa-chevron-down text-[var(--primary)] text-sm"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-2">
            <label for="entries" class="text-sm text-[var(--primary-text)]">Show</label>
            <select id="entries" name="entries" class="border border-[var(--primary)] text-[var(--primary-text)] rounded px-2 py-2 text-sm">
                <option value="10" selected>10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
            <span class="text-sm text-[var(--primary-text)]">entries</span>
        </div>
    </div>

    <x-table
        :headers="['ID', 'Nama Periode', 'Tahun', 'Semester', 'Tanggal Mulai', 'Tanggal Selesai', 'Status', 'Aksi']"
        :sortable="[]"
        :rows="$rows"
    />
</section>