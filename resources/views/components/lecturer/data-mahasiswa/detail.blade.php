<section id="modal-detail-mahasiswa-bimbingan" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px] overflow-y-auto" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="w-full max-w-3xl max-h-[90vh] flex flex-col bg-white rounded-xl shadow-lg border border-[var(--stroke)] overflow-hidden">

            <div class="px-7 pt-7 pb-2 flex-shrink-0">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="cursor-default text-sm font-semibold text-[var(--primary)] lg:text-base">
                        Detail Mahasiswa Bimbingan
                    </h2>
                    <i id="close-detail-mahasiswa-bimbingan" class="fa-solid fa-xmark cursor-pointer text-[var(--primary)] text-lg"></i>
                </div>
                <hr class="border border-[var(--primary)]" />
            </div>

            <div class="flex-1 overflow-y-auto px-7 py-5 mb-5">
                <h5 class="cursor-default mb-6 px-5 py-3 rounded-md text-sm bg-[var(--secondary)] text-white">
                    Informasi Magang
                </h5>
                <div class="px-6 py-2 flex items-start gap-8">
                    <img id="logo_perusahaan" src="" alt="Logo Perusahaan" class="w-12 h-12 rounded-full object-cover mt-1">
                    <div class="space-y-2">
                        <div class="flex items-center gap-2 text-sm">
                            <span class="font-medium text-[var(--primary-text)]">Bidang Posisi:</span>
                            <span id="posisi_bimbingan" class="text-[var(--secondary-text)]">-</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="font-medium text-[var(--primary-text)]">Nama Perusahaan Mitra:</span>
                            <span id="nama_perusahaan_bimbingan" class="text-[var(--secondary-text)]">-</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="font-medium text-[var(--primary-text)]">Lokasi:</span>
                            <span id="lokasi_bimbingan" class="text-[var(--secondary-text)]">-</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="font-medium text-[var(--primary-text)]">Periode Magang:</span>
                            <span id="periode_bimbingan" class="text-[var(--secondary-text)]">-</span>
                        </div>
                    </div>
                </div>

                <h5 class="cursor-default my-6 px-5 py-3 rounded-md text-sm bg-[var(--secondary)] text-white">
                    Data Mahasiswa
                </h5>
                
                <div class="px-2">
                    <div class="grid grid-cols-2 gap-y-4 gap-x-14 mt-5 text-sm">
                        <div class="flex flex-col">
                            <span class="font-semibold text-[var(--primary-text)] mb-1">NIM:</span>
                            <span id="nim_bimbingan" class="text-[var(--secondary-text)]">-</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-[var(--primary-text)] mb-1">Nama Lengkap:</span>
                            <span id="nama_mahasiswa_bimbingan" class="text-[var(--secondary-text)]">-</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-[var(--primary-text)] mb-1">Angkatan:</span>
                            <span id="angkatan_bimbingan" class="text-[var(--secondary-text)]">-</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-[var(--primary-text)] mb-1">Semester:</span>
                            <span id="semester_bimbingan" class="text-[var(--secondary-text)]">-</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-[var(--primary-text)] mb-1">Program Studi:</span>
                            <span id="prodi_bimbingan" class="text-[var(--secondary-text)]">-</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-[var(--primary-text)] mb-1">IPK:</span>
                            <span id="ipk_bimbingan" class="text-[var(--secondary-text)]">-</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-[var(--primary-text)] mb-1">Nomor Telepon:</span>
                            <span id="nomor_telepon_bimbingan" class="text-[var(--secondary-text)]">-</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-semibold text-[var(--primary-text)] mb-3">Status Magang:</span>
                            <div>
                                <span id="status_magang_bimbingan" class="text-[var(--secondary-text)] px-3">-</span>
                            </div>
                        </div>
                    </div>

                    <h5 class="text-sm font-semibold text-[var(--primary-text)] mt-5">Keahlian</h5>
                    <div class="keahlian-container mt-3" id="keahlian_list_bimbingan"></div>
                </div>
            </div>
        </div>
    </div>
</section>