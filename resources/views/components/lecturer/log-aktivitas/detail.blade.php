<section id="modal-detail-aktivitas" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px] overflow-y-auto" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="w-full max-w-4xl max-h-[90vh] flex flex-col bg-white rounded-xl shadow-lg border border-[var(--stroke)] overflow-hidden">
            <div class="px-7 pt-7 pb-2 flex-shrink-0">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="cursor-default text-lg font-semibold text-[var(--primary)]">
                        Detail Aktivitas Magang
                    </h2>
                    <i id="close-detail-aktivitas" class="fa-solid fa-xmark cursor-pointer text-[var(--primary)] text-xl hover:text-red-500 transition-colors"></i>
                </div>
                <hr class="border border-[var(--primary)]" />
            </div>
            <div class="flex-1 overflow-y-auto">
                <div class="px-7 py-4 border-b border-[var(--stroke)]">
                    <div class="flex flex-col gap-5 justify-between lg:items-center lg:flex-row">
                        <div class="flex flex-col gap-5 lg:items-center lg:flex-row">
                            <span class="w-fit bg-[var(--primary)] text-white text-sm font-medium px-4 py-2 rounded-full">
                                Minggu ke-<span id="minggu_log">-</span>
                            </span>
                            <h3 id="judul_log" class="text-lg font-semibold text-[var(--primary)]">-</h3>
                        </div>
                        <div id="status_badge" class="px-4 py-2 rounded-full text-sm font-medium">
                            <span id="status">-</span>
                        </div>
                    </div>
                </div>
                <div class="px-7 py-5 bg-gray-50 border-b border-[var(--stroke)]">
                    <h4 class="text-base font-semibold text-[var(--primary)] mb-3">Informasi Mahasiswa</h4>
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <img id="foto_profil" src="" alt="Foto Profil" class="w-16 h-16 rounded-full object-cover border-2 border-[var(--stroke)]">
                        </div>
                        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex flex-col">
                                <span class="text-sm text-[var(--secondary-text)] font-medium">Nama Lengkap</span>
                                <span id="nama_mahasiswa" class="text-base text-[var(--primary-text)] font-semibold mt-1">-</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm text-[var(--secondary-text)] font-medium">NIM</span>
                                <span id="nim"
                                    class="text-base text-[var(--primary-text)] font-semibold mt-1">-</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-7 py-5">
                    <h4 class="text-base font-semibold text-[var(--primary)] mb-4">Detail Aktivitas</h4>
                    <div class="mb-6">
                        <span class="text-sm text-[var(--secondary-text)] font-medium">Deskripsi Aktivitas</span>
                        <div class="mt-2 p-4 bg-gray-50 rounded-lg border border-[var(--stroke)]">
                            <p id="deskripsi" class="text-[var(--primary-text)] leading-relaxed">-</p>
                        </div>
                    </div>
                    <div class="mb-6">
                        <span class="text-sm text-[var(--secondary-text)] font-medium">Bukti Foto Aktivitas</span>
                        <div class="mt-2">
                            <div id="no-foto" class="p-4 bg-gray-50 rounded-lg border border-[var(--stroke)] text-center text-[var(--secondary-text)]">
                                Tidak ada foto
                            </div>
                            <div id="foto-container" class="hidden">
                                <img id="foto-preview" src="" alt="Bukti Foto Aktivitas" class="w-full max-w-md mx-auto rounded-lg border border-[var(--stroke)] shadow-sm">
                                <div class="mt-2 text-center">
                                    <button id="foto-fullscreen" class="text-sm text-[var(--primary)] hover:underline">
                                        <i class="fa-solid fa-expand mr-1"></i>
                                        Lihat dalam layar penuh
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <span class="text-sm text-[var(--secondary-text)] font-medium">Komentar Dosen</span>
                        <div class="mt-2 p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <p id="komentar" class="text-[var(--primary-text)] leading-relaxed">-</p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4 border-t border-[var(--stroke)]">
                        <span class="text-sm text-[var(--secondary-text)]">
                            Dikonfirmasi pada: <span id="konfirmasi_pada"
                                class="font-medium text-[var(--primary-text)]">-</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="foto-fullscreen-modal" class="fixed inset-0 z-60 hidden items-center justify-center bg-black/80 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="relative max-w-screen-lg max-h-screen p-4">
        <button id="close-fullscreen" class="absolute top-2 right-2 text-white text-2xl hover:text-gray-300 z-10">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <img id="foto-fullscreen-img" src="" alt="Bukti Foto Aktivitas" class="max-w-full max-h-full object-contain">
    </div>
</section>