<h4 class="cursor-default mt-10 mb-5 text-base font-semibold text-[var(--primary)]">
    Riwayat Lamaran
</h4>
<x-table
    :headers="['Nama Perusahaan', 'Posisi Magang', 'Tanggal Pengajuan', 'Status', 'Aksi']"
    :sortable="['Tanggal Pengajuan', 'Status']"
    :rows="[
        [
            'Nama Perusahaan' => 'PT Otsuka Amerta Indah',
            'Posisi' => 'Frontend Developer',
            'Tanggal' => '15 Mei 2025',
            'Status' => 'Diterima',
            'Aksi' => '#',
        ],
        [
            'Nama Perusahaan' => 'PT Gojek Indonesia',
            'Posisi' => 'Frontend Developer',
            'Tanggal' => '3 Mei 2025',
            'Status' => 'Menunggu',
            'Aksi' => '#',
        ],
        [
            'Nama Perusahaan' => 'Telkom Indonesia',
            'Posisi' => 'Backend Developer',
            'Tanggal' => '21 April 2025',
            'Status' => 'Ditolak',
            'Aksi' => '#',
        ],
    ]"
/>