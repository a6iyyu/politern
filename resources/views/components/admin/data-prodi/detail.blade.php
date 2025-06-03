<section id="modal-detail-prodi" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <figure class="w-full max-w-2xl rounded-xl bg-white p-8 shadow-lg border border-[var(--stroke)]">
            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default text-sm font-semibold text-[var(--primary)]">
                    Detail Program Studi
                </h2>
                <i id="close-detail" class="fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
            <hr class="mb-3 border border-[var(--primary)]" />
            <div class="px-2 grid grid-cols-2 gap-y-4 mt-5 text-sm">
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)]">Kode:</span>
                    <span id="kode_prodi" class="text-[var(--secondary-text)]">-</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)]">Nama:</span>
                    <span id="nama" class="text-[var(--secondary-text)]">-</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)]">Jenjang:</span>
                    <span id="jenjang_prodi_detail" class="text-[var(--secondary-text)]">-</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)]">Jurusan:</span>
                    <span id="jurusan_prodi" class="text-[var(--secondary-text)]">-</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)]">Status</span>
                    <span id="status_prodi" class="inline-block px-5 py-1 mt-2 rounded-full text-xs font-medium bg-green-100 text-green-600 w-fit">Aktif</span>
                </div>
            </div>
        </figure>
    </div>
</section>