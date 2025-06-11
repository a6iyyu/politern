<section id="modal-detail-lowongan" class="modal fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="w-full flex items-center justify-center min-h-screen px-4">
        <figure class="cursor-default w-4/5 max-h-[90vh] max-w-full overflow-y-auto rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)] lg:max-w-[90vh]">
            <span class="mb-4 flex items-center justify-between">
                <h2 class="font-semibold text-[var(--primary)]">Detail Lowongan Magang</h2>
                <button aria-label="Tutup detail" class="fa-solid fa-xmark cursor-pointer text-[var(--primary)] close"></button>
            </span>
            <hr class="border border-[var(--primary)] mb-6" />
            <h5 class="bg-[var(--secondary)] text-white text-left px-4 py-2 rounded-md text-sm font-medium mb-6 lg:text-base">
                Informasi Lowongan Magang
            </h5>
            <div class="flex flex-col items-center mb-4 lg:gap-6 lg:flex-row">
                <img id="logo_perusahaan" alt="Logo Perusahaan" class="hidden h-20 w-20 rounded-full object-cover lg:inline" />
                <figcaption class="w-full grid grid-cols-1 gap-4 text-sm lg:grid-cols-2">
                    <span class="mb-1">
                        <h5 class="font-semibold">Bidang posisi:</h5>
                        <h5 id="nama_bidang" class="text-gray-800"></h5>
                    </span>
                    <span class="mb-1">
                        <h5 class="font-semibold">Nama Perusahaan Mitra:</h5>
                        <h5 id="nama" class="text-gray-800"></h5>
                    </span>
                    <span class="mb-1">
                        <h5 class="font-semibold">Lokasi:</h5>
                        <h5 id="nama_lokasi" class="text-gray-800"></h5>
                    </span>
                    <span>
                        <h5 class="font-semibold">Jenis Lokasi Magang:</h5>
                        <h5 id="nama_jenis_lokasi" class="text-gray-800"></h5>
                    </span>
                </figcaption>
            </div>
            <figcaption class="mb-4">
                <h3 class="font-semibold text-sm text-gray-800 mb-2">Keahlian</h3>
                <div id="nama_keahlian" class="flex flex-wrap gap-2 text-xs"></div>
            </figcaption>
            <figcaption class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-800 mb-4">
                <span>
                    <h5 class="font-semibold mb-3">Periode Magang:</h5>
                    <dd id="nama_periode" class="text-gray-600"></dd>
                </span>
                <div>
                    <h5 class="font-semibold mb-3">Jenis Magang:</h5>
                    <dd id="jenis_magang" class="text-gray-600"></dd>
                </div>
            </figcaption>
            <figcaption class="mt-4 text-sm text-gray-800 mb-4">
                <h5 class="font-semibold mb-3">Deskripsi:</h5>
                <h5 id="deskripsi" class="break-all mt-1 whitespace-pre-line"></h5>
            </figcaption>
            <figcaption class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-800 mb-4">
                <span>
                    <h5 class="font-semibold mb-3">Gaji:</h5>
                    <h5 id="gaji" class="text-gray-600"></h5>
                </span>
                <span>
                    <h5 class="font-semibold mb-3">Durasi Magang:</h5>
                    <h5 id="durasi" class="text-gray-600"></h5>
                </span>
                <span>
                    <h5 class="font-semibold mb-3">Jumlah Kuota:</h5>
                    <h5 id="kuota" class="text-gray-600"></h5>
                </span>
                <span>
                    <h5 class="font-semibold mb-3">Status:</h5>
                    <h5 id="status" class="text-gray-600"></h5>
                </span>
                <span>
                    <h5 class="font-semibold mb-3">Tanggal Mulai Pendaftaran:</h5>
                    <h5 id="tanggal_mulai_pendaftaran" class="text-gray-600"></h5>
                </span>
                <span>
                    <h5 class="font-semibold mb-3">Tanggal Selesai Pendaftaran:</h5>
                    <h5 id="tanggal_selesai_pendaftaran" class="text-gray-600"></h5>
                </span>
            </figcaption>
        </figure>
    </div>
</section>