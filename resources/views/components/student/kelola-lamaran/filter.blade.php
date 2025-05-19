<div class="mb-5 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
    <div class="p-6 flex flex-col md:flex-row items-end gap-4 md:gap-6 w-full">
        <div class="flex flex-col">
            <label for="status" class="text-sm font-medium text-[var(--primary)] mb-2">Status Lamaran</label>
            <div class="relative w-full md:w-80">
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center">
                        <img src="{{ asset('icons/status-lamaran.svg') }}" alt="Status Lamaran" class="w-4 h-4">
                    </span>
                    <select name="status" id="status"
                        class="appearance-none w-full text-[var(--text-secondary)] border border-[var(--stroke)] rounded-md pl-10 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[var(--primary)]">
                        <option value="">Semua Status</option>
                        <option value="diterima">Diterima</option>
                        <option value="menunggu">Menunggu</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-[var(--text-secondary)]">
                    <i class="fa-solid fa-chevron-down text-sm"></i>
                </div>
            </div>
        </div>

        <div class="flex flex-col">
            <label for="periode" class="text-sm font-medium text-[var(--primary)] mb-2">
                Periode Magang
            </label>
            <div class="relative w-full md:w-80">
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center">
                        <img src="{{ asset('icons/periode-magang.svg') }}" alt="Periode Magang" class="w-4 h-4" />
                    </span>
                    <select name="periode" id="periode"
                        class="appearance-none w-full pl-10 pr-8 text-[var(--text-secondary)] border border-[var(--stroke)] rounded-md py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[var(--primary)]">
                        <option value="">Semua Periode</option>
                        <option value="genap_2024_2025">Genap 2024/2025</option>
                        <option value="ganjil_2024_2025">Ganjil 2024/2025</option>
                        <option value="genap_2025_2026">Genap 2025/2026</option>
                        <option value="ganjil_2025_2026">Ganjil 2025/2026</option>
                    </select>
                </div>
                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-[var(--text-secondary)]">
                    <i class="fa-solid fa-chevron-down text-sm"></i>
                </div>
            </div>
        </div>


        <div class="flex flex-col">
            <label for="search" class="text-sm font-medium text-[var(--primary)] mb-2">Cari Lamaran</label>
            <div class="flex gap-2">
                <div class="relative w-80">
                    <span class="absolute inset-y-0 left-3 flex items-center text-[var(--primary)]">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </span>
                    <input type="text" name="search" id="search" placeholder="Nama Perusahaan..."
                        class="w-full flex-grow pl-9 pr-3 py-2 placeholder-[var(--text-secondary)] text-[var(--text-secondary)] border border-[var(--stroke)] rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-[var(--primary)]">
                </div>
                <button type="submit"
                    class="inline-block w-[80px] text-center px-4 py-2 bg-[var(--secondary)] text-white text-sm font-medium rounded-md">
                    Cari
                </button>
            </div>
        </div>
    </div>
</div>