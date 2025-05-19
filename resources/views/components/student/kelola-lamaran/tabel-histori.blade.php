<div class="p-6 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
    <h4 class="cursor-default mb-5 text-base font-semibold text-[var(--primary)]">
        Riwayat Lamaran
    </h4>
    <x-table
        :headers="['ID', 'Nama Perusahaan', 'Posisi Magang', 'Tanggal Pengajuan', 'Status', 'Aksi']"
        :sortable="['Tanggal Pengajuan', 'Status']"
        :rows="[
            [
                'ID' => 1,
                'Nama Perusahaan' => 'PT Otsuka Amerta Indah',
                'Posisi' => 'Frontend Developer',
                'Tanggal' => '15 Mei 2025',
                'Status' => 'Diterima',
                'Aksi' => '#',
            ],
            [
                'ID' => 2,
                'Nama Perusahaan' => 'PT Gojek Indonesia',
                'Posisi' => 'Frontend Developer',
                'Tanggal' => '3 Mei 2025',
                'Status' => 'Menunggu',
                'Aksi' => '#',
            ],
            [
                'ID' => 3,
                'Nama Perusahaan' => 'Telkom Indonesia',
                'Posisi' => 'Backend Developer',
                'Tanggal' => '21 April 2025',
                'Status' => 'Ditolak',
                'Aksi' => '#',
            ],
        ]"
    />
</div>