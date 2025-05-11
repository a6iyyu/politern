<section>
    <h4 class="cursor-default mt-10 mb-3 text-base font-semibold text-[var(--primary)]">
        Riwayat Lamaran
    </h4>

    <x-table
        :headers="['No', 'Nama Perusahaan', 'Posisi Magang', 'Tanggal Pengajuan', 'Status', 'Aksi']"
        :rows="[
            [
                'no' => 1,
                'nama_perusahaan' => 'PT Otsuka Amerta Indah',
                'posisi' => 'Frontend Developer',
                'tanggal' => '15 Mei 2025',
                'status' => 'Diterima',
                'aksi' => '#'
            ],
            [
                'no' => 2,
                'nama_perusahaan' => 'PT Gojek Indonesia',
                'posisi' => 'Frontend Developer',
                'tanggal' => '3 Mei 2025',
                'status' => 'Menunggu',
                'aksi' => '#'
            ],
            [
                'no' => 3,
                'nama_perusahaan' => 'Telkom Indonesia',
                'posisi' => 'Backend Developer',
                'tanggal' => '21 April 2025',
                'status' => 'Ditolak',
                'aksi' => '#'
            ]
        ]"
    />
</section>