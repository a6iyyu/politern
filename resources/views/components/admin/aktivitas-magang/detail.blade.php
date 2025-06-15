<section id="modal-detail-aktivitas-admin" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px] overflow-y-auto" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen p-4">
        <figcaption class="w-full max-w-4xl max-h-[90vh] flex flex-col bg-white rounded-xl shadow-lg border border-[var(--stroke)] overflow-hidden">
            <header class="px-7 pt-7 pb-2 flex-shrink-0">
                <span class="flex items-center justify-between mb-3">
                    <h2 class="font-semibold text-[var(--primary)]">
                        Detail Aktivitas Magang
                    </h2>
                    <i id="close-detail-aktivitas-admin" class="fa-solid fa-xmark cursor-pointer text-[var(--primary)] transition-colors lg:hover:text-[var(--primary)]/80"></i>
                </span>
                <hr class="border border-[var(--primary)]" />
            </header>
            <article class="flex-1 overflow-y-auto">
                <section class="px-7 py-4 border-b border-[var(--stroke)] flex flex-col justify-between gap-5 lg:items-center lg:flex-row">
                    <div class="flex flex-col gap-3 sm:items-center sm:flex-row">
                        <h5 class="bg-[var(--primary)] w-fit text-white text-xs font-medium px-4 py-2 rounded-full">
                            Minggu ke-<span id="minggu_log_admin">-</span>
                        </h5>
                        <h3 id="judul_log_admin" class="w-fit text-sm font-semibold text-[var(--primary)]">-</h3>
                    </div>
                    <div id="status_badge_admin" class="w-fit px-4 py-2 rounded-full font-medium">
                        <h5 id="status_admin">-</h5>
                    </div>
                </section>
                <section class="px-7 py-5 bg-gray-50 border-b border-[var(--stroke)]">
                    <h4 class="text-base font-semibold text-[var(--primary)] mb-3">Informasi Mahasiswa</h4>
                    <div class="flex items-start gap-4">
                        <img id="foto_profil_admin" src="" alt="Foto Profil"
                            class="w-16 h-16 rounded-full object-cover border-2 border-[var(--stroke)]">
                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <span class="text-sm text-[var(--secondary-text)] font-medium">Nama Lengkap</span>
                                <span id="nama_mahasiswa_admin" class="block text-base text-[var(--primary-text)] font-semibold mt-1">-</span>
                            </div>
                            <div>
                                <span class="text-sm text-[var(--secondary-text)] font-medium">NIM</span>
                                <span id="nim_admin" class="block text-base text-[var(--primary-text)] font-semibold mt-1">-</span>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="px-7 py-5">
                    <h4 class="text-base font-semibold text-[var(--primary)] mb-4">Detail Aktivitas</h4>
                    <div class="mb-6">
                        <span class="text-sm text-[var(--secondary-text)] font-medium">Deskripsi Aktivitas</span>
                        <div class="mt-2 p-4 bg-gray-50 rounded-lg border border-[var(--stroke)]">
                            <p id="deskripsi_admin" class="text-sm text-[var(--primary-text)] leading-relaxed">-</p>
                        </div>
                    </div>
                    <div class="mb-6">
                        <span class="text-sm text-[var(--secondary-text)] font-medium">Bukti Foto Aktivitas</span>
                        <div class="mt-2">
                            <div id="no-foto-admin" class="p-4 bg-gray-50 rounded-lg border border-[var(--stroke)] text-center text-[var(--secondary-text)]">
                                Tidak ada foto
                            </div>
                            <div id="foto-container-admin" class="hidden">
                                <img id="foto-preview-admin" src="" alt="Bukti Foto Aktivitas" class="w-full max-w-md mx-auto rounded-lg border border-[var(--stroke)] shadow-sm">
                                <div class="mt-2 text-center">
                                    <button id="foto-fullscreen-admin"
                                        class="text-sm text-[var(--primary)] hover:underline">
                                        <i class="fa-solid fa-expand mr-1"></i>Lihat dalam layar penuh
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <span class="text-sm text-[var(--secondary-text)] font-medium">Komentar Dosen</span>
                        <div class="mt-2 p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <p id="komentar_admin" class="text-sm text-[var(--primary-text)] leading-relaxed">-</p>
                        </div>
                    </div>
                    <footer class="flex justify-between items-center pt-4 border-t border-[var(--stroke)]">
                        <h5 class="text-sm text-[var(--secondary-text)]">
                            Dikonfirmasi pada:
                            <span id="konfirmasi_pada_admin" class="font-medium text-[var(--primary-text)]">-</span>
                        </h5>
                    </footer>
                </section>
            </article>
        </figcaption>
    </div>
</section>
<section id="foto-fullscreen-modal-admin" class="fixed inset-0 z-60 hidden items-center justify-center bg-black/80 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="relative max-w-screen-lg max-h-screen p-4">
        <button id="close-fullscreen-admin" class="absolute top-2 right-2 text-white text-2xl hover:text-gray-300 z-10">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <img id="foto-fullscreen-img-admin" src="" alt="Bukti Foto Aktivitas" class="max-w-full max-h-full object-contain">
    </div>
</section>