<section id="modal-detail-lowongan" class="modal fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <article class="w-full max-w-3xl rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)]">
            <span class="mb-4 flex items-center justify-between">
                <h2 class="font-semibold text-[var(--primary)]">Detail Lowongan Magang</h2>
                <button aria-label="Tutup detail" class="fa-solid fa-xmark cursor-pointer text-[var(--primary)] close"></button>
            </span>
            <hr class="mb-4 border-[var(--primary)]" />
            <section class="mb-4 px-4 py-2 bg-pink-200 text-pink-800 font-medium rounded-full w-fit text-sm">
                Informasi Lowongan Magang
            </section>
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-800">
                <div>
                    <dt class="font-semibold">Bidang Posisi:</dt>
                    <dd id="nama_bidang"></dd>
                </div>
                <div>
                    <dt class="font-semibold">Nama Perusahaan Mitra:</dt>
                    <dd id="nama"></dd>
                </div>
                <div>
                    <dt class="font-semibold">Lokasi:</dt>
                    <dd id="nama_lokasi"></dd>
                </div>
                <div>
                    <dt class="font-semibold">Jenis Lokasi Magang:</dt>
                    <dd id="nama_jenis_lokasi"></dd>
                </div>
            </dl>
            <section class="mt-6">
                <h3 class="font-semibold text-sm text-gray-800">Keahlian:</h3>
                <div class="mt-2 text-xs">
                    <span id="nama_keahlian" class="bg-pink-100 text-pink-800 px-3 py-1 rounded-full"></span>
                </div>
            </section>

            <dl class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-800">
                <div>
                    <dt class="font-semibold">Periode Magang:</dt>
                    <dd id="durasi"></dd>
                </div>
                <div>
                    <dt class="font-semibold">Minimal IPK:</dt>
                    <dd id="nilai_minimal"></dd>
                </div>
                <div>
                    <dt class="font-semibold">Perkiraan Gaji:</dt>
                    <dd id="gaji"></dd>
                </div>
                <div>
                    <dt class="font-semibold">Jumlah Kuota:</dt>
                    <dd id="kuota"></dd>
                </div>
                <div>
                    <dt class="font-semibold">Tanggal Mulai Pendaftaran:</dt>
                    <dd id="tanggal_mulai_pendaftaran"></dd>
                </div>
                <div>
                    <dt class="font-semibold">Tanggal Selesai Pendaftaran:</dt>
                    <dd id="tanggal_selesai_pendaftaran"></dd>
                </div>
                <div class="md:col-span-2">
                    <dt class="font-semibold">Status:</dt>
                    <dd id="status"></dd>
                </div>
            </dl>
            <section class="mt-6 text-sm text-gray-800">
                <h3 class="font-semibold">Deskripsi:</h3>
                <p id="deskripsi" class="mt-1 whitespace-pre-line"></p>
            </section>
        </article>
    </div>
</section>