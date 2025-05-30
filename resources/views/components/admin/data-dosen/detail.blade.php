<section id="modal-detail-dosen" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <figure class="w-full max-w-lg rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)]">
            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default font-semibold text-[var(--primary)]">
                    Detail Dosen
                </h2>
                <i id="close-detail" class="fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
            <hr class="mb-3 border border-[var(--primary)]" />
            <figcaption class="mt-6 px-6 py-4 rounded-md bg-[#eeeeee]">
                <span class="flex items-center gap-4 text-sm text-gray-800">
                    <i class="fa-solid fa-user"></i>
                    <h5>Informasi Pengguna</h5>
                </span>
                <span class="mt-3 flex items-center gap-2 text-sm">
                    <strong>Nama Pengguna:</strong>
                    <h6 id="nama_pengguna"></h6>
                </span>
                <span class="mt-1 flex items-center gap-2 text-sm">
                    <strong>Surel:</strong>
                    <h6 id="email"></h6>
                </span>
            </figcaption>
            <figcaption class="cursor-default mt-6 px-6 py-4 rounded-md text-sm bg-[var(--secondary)] text-white">
                Data Dosen
            </figcaption>
            <figcaption class="mt-4 grid grid-cols-1 gap-2 md:grid-cols-2">
                <span class="mt-1 flex items-center gap-2 text-sm">
                    <strong>NIP:</strong>
                    <h6 id="nip"></h6>
                </span>
                <span class="mt-1 flex items-center gap-2 text-sm">
                    <strong>Nomor Telepon:</strong>
                    <h6 id="nomor_telepon"></h6>
                </span>
                <span class="mt-1 flex items-center gap-2 text-sm">
                    <strong>Nama:</strong>
                    <h6 id="nama_dosen"></h6>
                </span>
                <span class="mt-1 flex items-center gap-2 text-sm">
                    <strong>Jumlah Bimbingan:</strong>
                    <h6 id="jumlah_bimbingan"></h6>
                </span>
            </figcaption>
        </figure>
    </div>
</section>