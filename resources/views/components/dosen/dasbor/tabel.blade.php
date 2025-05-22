<div class="p-6 mt-8 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-sm text-[var(--text-primary)]">
            Daftar Mahasiswa Bimbingan
        </h2>
        <a href="#" class="text-xs bg-[var(--primary)] text-white font-medium px-5 py-2 rounded cursor-pointer">Lihat Semua</a>
    </div>
    <x-table
        :headers="['Mahasiswa', 'NIM', 'Perusahaan', 'Posisi', 'Status', 'Aksi']"
        :sortable="[]"
        :rows="$rows"
    />
    <!-- Menampilkan 8 dari 256 mahasiswa bimbingan -->
    <p class="text-xs font-light text-[var(--primary-text)]">
        Menampilkan 8 dari {{ $totalBimbingan }} mahasiswa bimbingan
    </p>
</div>