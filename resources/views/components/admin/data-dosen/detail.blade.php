<section class="modal modal-detail-dosen fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm"
    aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="relative w-full max-w-lg rounded-xl bg-white p-6 shadow-lg border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold" style="color: var(--primary);">
                    Detail Dosen
                </h2>
                <button class="close text-black-500 hover:text-gray-700 text-xl font-bold" aria-label="Tutup Modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <hr class="mb-3 border border-[var(--primary)]" />
            <div class="mb-5">
                <div class="bg-gray-100 rounded p-4 text-sm text-gray-700 space-y-1">
                    <p><span class="font-semibold">Username:</span> <span id="modal-username"></span></p>
                    <p><span class="font-semibold">Email:</span> <span id="modal-email"></span></p>
                </div>
            </div>
            <div class="space-y-2 text-sm text-gray-700">
                <div><span class="font-semibold">NIP:</span> <span id="modal-nip"></span></div>
                <div><span class="font-semibold">Nama Lengkap:</span> <span id="modal-nama"></span></div>
                <div><span class="font-semibold">Nomor Telepon:</span> <span id="modal-telepon"></span></div>
                <div><span class="font-semibold">Jumlah Bimbingan:</span> <span id="modal-bimbingan"></span></div>
            </div>
            <div class="mt-6 flex justify-end">
                <button class="close cursor-pointer px-5 py-2 rounded text-white bg-pink-500 hover:bg-pink-600 transition-all duration-300">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</section>