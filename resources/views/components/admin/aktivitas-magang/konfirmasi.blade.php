<!-- Modal Konfirmasi -->
<section class="modal-konfirmasi fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <form id="form-konfirmasi" method="POST" class="max-h-[90vh] overflow-y-auto w-full max-w-3xl rounded-xl bg-white p-7 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="DISETUJUI">
            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default text-sm font-semibold text-[var(--primary)] lg:text-base">Konfirmasi Pengajuan Magang</h2>
                <i class="close-konfirmasi fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
            <hr class="mb-6 border border-[var(--primary)]" />
            <h5 class="cursor-default mb-6 px-5 py-3 rounded-md text-sm bg-[var(--secondary)] text-white">
                Konfirmasi Aktivitas Magang
            </h5>
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Komentar</label>
                <textarea 
                    name="komentar" 
                    placeholder="Masukkan komentar (opsional)"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="4"
                ></textarea>
            </div>

            <div class="mt-10 mb-2 flex justify-end">
                <button type="submit" class="w-full py-3 text-sm text-white bg-[var(--primary)] rounded-md">Konfirmasi</button>
            </div>
        </form>
    </div>
</section>

<!-- Modal Penolakan -->
<section class="modal-tolak fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <form id="form-tolak" method="POST" class="max-h-[90vh] overflow-y-auto w-full max-w-3xl rounded-xl bg-white p-7 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="DITOLAK">
            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default text-sm font-semibold text-[var(--primary)] lg:text-base">Tolak Pengajuan Magang</h2>
                <i class="close-tolak fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
            <hr class="mb-6 border border-[var(--primary)]" />
            <h5 class="cursor-default mb-6 px-5 py-3 rounded-md text-sm bg-[var(--secondary)] text-white">
                Konfirmasi Aktivitas Magang
            </h5>
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Alasan Penolakan <span class="text-red-500">*</span></label>
                <textarea 
                    name="komentar" 
                    placeholder="Masukkan alasan penolakan"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    rows="4"
                ></textarea>
            </div>

            <div class="mt-10 mb-2 flex justify-end">
                <button type="submit" class="w-full py-3 text-sm text-white bg-[var(--red-tertiary)] rounded-md">Tolak Pengajuan</button>
            </div>
        </form>
    </div>
</section>