<section id="modal-log-detail" class="modal fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4 w-full">
        <figure class="w-3/4 rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)] max-h-[90vh] overflow-y-auto lg:w-1/2">
            <span class="flex items-center justify-between mb-2">
                <h2 class="text-lg font-semibold text-[#5955B2]">Detail Log Aktivitas</h2>
                <button type="button" class="close transition-all duration-300 ease-in-out text-gray-400 lg:hover:text-gray-600">
                    <i class="fa-solid fa-xmark cursor-pointer"></i>
                </button>
            </span>
            <hr class="mb-3 border border-[var(--stroke)]" />
            <figcaption class="mb-6 rounded-lg text-xs bg-gray-100 px-5 py-4 border-l-4 border-[var(--primary)] lg:text-sm">
                <span class="mb-4 flex flex-col">
                    <h5>Nama Perusahaan:</h5>
                    <h5 class="font-semibold text-[var(--primary)]" id="nama_perusahaan"></h5>
                </span>
                <span class="mb-4 flex flex-col">
                    <h5>Lokasi:</h5>
                    <h5 class="text-gray-500" id="nama_lokasi"></h5>
                </span>
                <span class="mb-4 flex flex-col">
                    <h5>Bidang:</h5>
                    <h5 class="text-[var(--primary)]" id="nama_bidang"></h5>
                </span>
                <span class="flex flex-col">
                    <h5>Dosen Pembimbing:</h5>
                    <h5 class="text-[var(--primary)]" id="nama_dosen"></h5>
                </span>
            </figcaption>
            <figcaption class="cursor-default flex flex-col space-y-4">
                <span class="text-sm text-gray-700">
                    <strong>Minggu:</strong> <span id="minggu"></span>
                </span>
                <span class="text-sm text-gray-700">
                    <strong>Judul:</strong> <span id="judul_log"></span>
                </span>
                <span class="text-sm text-gray-700">
                    <strong>Deskripsi:</strong> <span id="deskripsi_log"></span>
                </span>
                <p class="text-gray-600" id="deskripsi"></p>
            </figcaption>
            <h5 class="font-semibold text-sm text-gray-700">
                Dokumentasi:
            </h5>
            <img id="foto" alt="Foto Dokumentasi" class="mt-4 w-full max-h-80 object-cover rounded-lg shadow-md hidden">
        </figure>
    </div>
</section>