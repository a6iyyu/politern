<section id="modal-detail-dosen" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <figure class="w-full max-w-2xl rounded-xl bg-white p-7 shadow-lg border border-[var(--stroke)]">
            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default text-sm font-semibold text-[var(--primary)] lg:text-base">
                    Detail Dosen
                </h2>
                <i id="close-detail" class="fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
            <hr class="mb-3 border border-[var(--primary)]" />
            <div class="mt-6 px-6 py-4 rounded-md bg-[#eeeeee]">
                <span class="flex items-center gap-4 text-sm text-[var(--primary-text)]">
                    <i class="fa-solid fa-user"></i>
                    <span class="font-semibold">Informasi Pengguna</span>
                </span>
                <span class="mt-3 flex items-center gap-2 text-sm">
                    <span class="font-medium text-[var(--primary-text)]">Nama Pengguna:</span>
                    <span id="nama_pengguna" class="text-[var(--secondary-text)]">-</span>
                </span>
                <span class="mt-2 flex items-center gap-2 text-sm">
                    <span class="font-medium text-[var(--primary-text)]">Email:</span>
                    <span id="email" class="text-[var(--secondary-text)]">-</span>
                </span>
            </div>
            <h5 class="cursor-default my-6 px-5 py-3 rounded-md text-sm bg-[var(--secondary)] text-white">
                Data Dosen
            </h5>
            <div class="px-2 grid grid-cols-2 gap-y-4 mt-5 text-sm">
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)] mb-1">NIP:</span>
                    <span id="nip" class="text-[var(--secondary-text)]">-</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)] mb-1">Nomor Telepon:</span>
                    <span id="nomor_telepon" class="text-[var(--secondary-text)]">-</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)] mb-1">Nama:</span>
                    <span id="nama_dosen" class="text-[var(--secondary-text)]">-</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)] mb-1">Total Bimbingan:</span>
                    <span id="jumlah_bimbingan" class="text-[var(--secondary-text)]">-</span>
                </div>
            </div>
        </figure>
    </div>
</section>