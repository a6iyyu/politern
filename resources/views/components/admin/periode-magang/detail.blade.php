<section id="modal-detail-periode" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <figure class="w-full max-w-lg rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)]">
            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default font-semibold text-[var(--primary)]">
                    Detail Periode Magang
                </h2>
                <i id="close-detail" class="fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
            <hr class="mb-4 border border-[var(--primary)]" />
            <span class="mt-1 flex items-center gap-2 text-sm">
                <strong>Nama Periode:</strong>
                <h6 id="detail_nama_periode"></h6>
            </span>
            <figcaption class="mt-4 grid grid-cols-1 gap-2 md:grid-cols-2">
                <span class="mt-1 flex items-center gap-2 text-sm">
                    <strong>Tanggal Mulai:</strong>
                    <h6 id="tanggal_mulai"></h6>
                </span>
                <span class="mt-1 flex items-center gap-2 text-sm">
                    <strong>Tanggal Selesai:</strong>
                    <h6 id="tanggal_selesai"></h6>
                </span>
                <div class="mt-2 flex items-center gap-2 text-sm">
                    <strong>Status:</strong>
                    <h6 id="status" class="m-0"></h6>
                </div>
                
            </figcaption>
        </figure>
    </div>
</section>