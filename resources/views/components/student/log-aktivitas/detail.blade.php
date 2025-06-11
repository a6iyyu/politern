<section id="modal-log-detail" class="modal fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <figure class="w-full max-w-xl rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)]">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-[#5955B2]">Detail Log Aktivitas</h2>
                <button type="button" class="text-gray-400 hover:text-gray-600 close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <hr class="mb-3 border border-[var(--stroke)]" />

            <div class="mb-6 rounded-lg bg-gray-100 px-5 py-4 border-l-4 border-[#5955B2]">
                <div class="text-sm font-semibold text-[#5955B2] mb-1" id="nama_perusahaan"></div>
                <div class="text-sm text-gray-500 mb-2" id="nama_lokasi"></div>
                <div class="text-sm text-[#5955B2]" id="nama_bidang"></div>
                <div class="text-sm text-[#5955B2]" id="nama_dosen"></div>
            </div>

            <figcaption class="space-y-4">
                <div class="text-sm text-gray-700">
                    <strong>Minggu:</strong> <span id="minggu"></span>
                </div>
                <div class="text-sm text-gray-700">
                    <strong>Judul:</strong> <span id="judul_log"></span>
                </div>
                <div class="text-sm text-gray-700">
                    <strong>Deskripsi:</strong> <span id="deskripsi_log"></span>
                </div>
                <p class="text-gray-600" id="deskripsi"></p>

                <div class="mt-4">
                    <img id="foto" alt="Foto Dokumentasi" class="rounded-lg shadow-md hidden">
                </div>
            </figcaption>
        </figure>
    </div>
</section>