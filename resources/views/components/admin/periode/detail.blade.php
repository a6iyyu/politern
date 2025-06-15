<section id="modal-detail-periode" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <figure class="w-full max-w-2xl rounded-xl bg-white p-7 shadow-lg border border-[var(--stroke)]">
            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default text-sm font-semibold text-[var(--primary)] lg:text-base">
                    Detail Periode Magang
                </h2>
                <i id="close-detail" class="fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
            <hr class="mb-3 border border-[var(--primary)]" />
            <div class="px-2 grid grid-cols-2 gap-y-4 mt-5 text-sm">
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)] mb-1">Nama Periode:</span>
                    <span id="detail_nama_periode" class="text-[var(--secondary-text)]">-</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)] mb-1">Tanggal Mulai:</span>
                    <span id="tanggal_mulai" class="text-[var(--secondary-text)]">-</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)] mb-1">Status:</span>
                    <span id="status" class="text-[var(--secondary-text)]">-</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)] mb-1">Tanggal Selesai:</span>
                    <span id="tanggal_selesai" class="text-[var(--secondary-text)]">-</span>
                </div>
            </div>
        </figure>
    </div>
</section>