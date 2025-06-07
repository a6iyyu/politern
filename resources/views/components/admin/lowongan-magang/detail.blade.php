<section id="modal-detail-lowongan"
    class="modal fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true"
    role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <figure class="w-full max-w-5x rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)]">
            <span class="mb-4 flex items-center justify-between">
                <h2 class="font-semibold text-[var(--primary)]">Detail Lowongan Magang</h2>
                <button aria-label="Tutup detail"
                    class="fa-solid fa-xmark cursor-pointer text-[var(--primary)] close"></button>
            </span>
            <hr class="border border border-[var(--primary)] mb-6" />
            <h5 class="bg-[#E86BB1] text-white text-left py-2 rounded-md text-sm font-medium mb-6 px-4">
                Informasi Lowongan Magang
            </h5>
            <div class="flex items-center gap-6 mb-4">
                <img id="logo_perusahaan" alt="Logo Perusahaan"
                    class="w-20 h-20 rounded-full object-cover" />
                <div>
                    <div class="mb-1">
                        <span class="font-semibold">Bidang posisi:</span>
                        <span id="nama_bidang" class="text-gray-800"></span>
                    </div>
                    <div class="mb-1">
                        <span class="font-semibold">Nama Perusahaan Mitra:</span>
                        <span id="nama" class="text-gray-800"></span>
                    </div>
                    <div class="mb-1">
                        <span class="font-semibold">Lokasi:</span>
                        <span id="nama_lokasi" class="text-gray-800"></span>
                    </div>
                    <div>
                        <span class="font-semibold">Jenis Lokasi Magang:</span>
                        <span id="nama_jenis_lokasi" class="text-gray-800"></span>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <h3 class="font-semibold text-sm text-gray-800 mb-2">Keahlian</h3>
                <div id="nama_keahlian" class="flex flex-wrap gap-2"></div>
            </div>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-800 mb-4">
                <div>
                    <dt class="font-semibold mb-3">Periode Magang:</dt>
                    <dd id="nama_periode" class="text-gray-600"></dd>
                </div>
                <div>
                    <dt class="font-semibold mb-3">Jenis Magang:</dt>
                    <dd id="jenis_magang" class="text-gray-600"></dd>
                </div>
            </dl>
            <section class="mt-4 text-sm text-gray-800 mb-4">
                <h3 class="font-semibold mb-3">Deskripsi:</h3>
                <p id="deskripsi" class="mt-1 whitespace-pre-line"></p>
            </section>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-800 mb-4">
                <div>
                    <dt class="font-semibold mb-3">Perkiraan Gaji:</dt>
                    <dd id="gaji" class="text-gray-600"></dd>
                </div>
                <div>
                    <dt class="font-semibold mb-3">Durasi Magang:</dt>
                    <dd id="durasi" class="text-gray-600"></dd>
                </div>
                <div>
                    <dt class="font-semibold mb-3">Jumlah Kuota:</dt>
                    <dd id="kuota" class="text-gray-600"></dd>
                </div>
                <div>
                    <dt class="font-semibold mb-3">Status:</dt>
                    <dd id="status" class="text-gray-600"></dd>
                </div>
                <div>
                    <dt class="font-semibold mb-3">Tanggal Mulai Pendaftaran:</dt>
                    <dd id="tanggal_mulai_pendaftaran" class="text-gray-600"></dd>
                </div>
                <div>
                    <dt class="font-semibold mb-3">Tanggal Selesai Pendaftaran:</dt>
                    <dd id="tanggal_selesai_pendaftaran" class="text-gray-600"></dd>
                </div>
            </dl>
        </figure>
    </div>
</section>
