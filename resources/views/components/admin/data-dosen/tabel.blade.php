<section class="p-6 mt-8 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
    <div class="flex items-center justify-between mb-7">
        <h2 class="text-base font-semibold text-[var(--primary-text)]">
            Daftar Data Dosen
        </h2>
        <a href="" class="text-sm bg-[var(--primary)] text-white px-4 py-3 rounded-md cursor-pointer hover:bg-[var(--primary)]/90 transition-colors">
            Tambah Data Dosen
        </a>
    </div>
    
    <div class="flex items-center justify-between mb-7">
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2">
                <label for="filter" class="text-sm text-[var(--primary-text)]">Filter</label>
                <div class="relative">
                    <select id="filter" name="filter" class="md:w-64 text-sm text-[var(--primary)] border border-[var(--primary)] rounded px-4 py-2 pr-10 bg-white appearance-none min-w-[200px] focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:border-transparent">
                        <option value="">--Semua--</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <i class="fas fa-chevron-down text-[var(--primary)] text-sm"></i>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fas fa-search text-[var(--primary)] text-sm"></i>
                </div>
                <input type="text" id="search" name="search" placeholder="Cari nama mahasiswa" class="md:w-64 text-sm text-[var(--primary-text)] border border-[var(--primary)] rounded px-4 py-2 pl-10 bg-white min-w-[250px] focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:border-transparent">
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
        :headers="['ID', 'Dosen', 'NIP', 'Nomor Telepon', 'Status', 'Aksi']"
        :sortable="[]"
        :rows="$rows"
    />

    <div class="mt-4">
        <h5 class="cursor-default text-xs font-light text-[var(--primary-text)]">
            Menampilkan {{ count($rows) ?? 0 }} dari {{ $total_dosen ?? "N/A" }} dosen
        </h5>
    </div>
</section>