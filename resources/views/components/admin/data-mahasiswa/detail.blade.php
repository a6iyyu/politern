<section id="modal-detail-mahasiswa" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <figure class="w-full max-w-2xl rounded-xl bg-white p-8 shadow-lg border border-[var(--stroke)]">
            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default text-sm font-semibold text-[var(--primary)]">
                    Detail Mahasiswa
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
                Data Mahasiswa
            </h5>
            <div class="px-2 grid grid-cols-2 gap-y-4 mt-5 text-sm">
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)] mb-1">NIM:</span>
                    <span id="nim" class="text-[var(--secondary-text)]">-</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)] mb-1">Nama Lengkap:</span>
                    <span id="detail_nama_lengkap" class="text-[var(--secondary-text)]">-</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)] mb-1">Angkatan:</span>
                    <span id="detail_angkatan" class="text-[var(--secondary-text)]">-</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)] mb-1">Semester:</span>
                    <span id="detail_semester" class="text-[var(--secondary-text)]">-</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)] mb-1">IPK:</span>
                    <span id="ipk" class="text-[var(--secondary-text)]">-</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)] mb-1">Nama Program Studi:</span>
                    <span id="nama_prodi" class="text-[var(--secondary-text)]">-</span>
                </div>
                <div class="flex flex-col">
                    <span class="font-semibold text-[var(--primary-text)] mb-1">Status</span>
                    <span id="detail_status" class="inline-block px-5 py-1 mt-2 rounded-full text-xs font-medium bg-green-100 text-green-600 w-fit">Aktif</span>
                </div>
            </div>
        </figure>
    </div>
</section>