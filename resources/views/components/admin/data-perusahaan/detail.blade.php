<section id="modal-detail-perusahaan" class="cursor-default fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <figure class="w-full max-w-xl rounded-xl bg-white px-7 py-6 shadow-lg border border-[var(--stroke)]">
            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default font-semibold text-sm text-[var(--primary)] lg:text-base">
                    Detail Perusahaan Mitra
                </h2>
                <i id="close-detail" class="fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
            <hr class="mb-3 border border-[var(--primary)]" />
            <span class="mt-3 flex items-center gap-2 text-sm">
                <h5 class="font-medium text-[var(--primary-text)]">Nama Perusahaan Mitra:</h5>
                <h5 id="nama" class="text-[var(--secondary-text)]">-</h5>
            </span>
            <span class="mt-2 flex items-center gap-2 text-sm">
                <h5 class="font-medium text-[var(--primary-text)]">NIB:</h5>
                <h5 id="nib" class="text-[var(--secondary-text)]">-</h5>
            </span>
            <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
                <span>
                    <h5 class="mb-1 font-medium text-[var(--primary-text)]">Email</h5>
                    <h5 id="email" class="text-[var(--secondary-text)]">-</h5>
                </span>
                <span>
                    <h5 class="mb-1 font-medium text-[var(--primary-text)]">Nomor Telepon</h5>
                    <h5 id="nomor_telepon" class="text-[var(--secondary-text)]">-</h5>
                </span>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
                <span>
                    <h5 class="mb-1 font-medium text-[var(--primary-text)]">Website</h5>
                    <h5 id="website" class="text-[var(--secondary-text)]">-</h5>
                </span>
                <span>
                    <h5 class="mb-1 font-medium text-[var(--primary-text)]">Status</h5>
                    <h5 id="status" class="w-fit rounded-full bg-green-100 px-4 py-1 text-xs font-semibold text-green-700">-</h5>
                </span>
            </div>
            <div class="mt-4 text-sm">
                <h5 class="mb-1 font-medium text-[var(--primary-text)]">Tanggal Dibuat</h5>
                <h5 id="tanggal_dibuat" class="text-[var(--secondary-text)]">-</h5>
            </div>
        </figure>
    </div>
</section>