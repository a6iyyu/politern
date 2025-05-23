
<section id="modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        @if (!empty($log_aktivitas))
            <figure class="w-full max-w-md rounded-xl bg-white p-6 shadow-lg border-2 border-[var(--stroke)]">
                <h2 class="cursor-default mb-3 font-semibold text-center text-gray-800">
                    Detail Mahasiswa Bimbingan
                </h2>
                <hr class="mb-3 border border-[var(--stroke)]" />
                <figcaption class="cursor-default space-y-3 text-sm">
                    <strong>Nama Mahasiswa:</strong>
                    <h5 id="nama" class="mt-1 text-gray-700">
                        N/A
                    </h5>
                    <strong>Program Studi:</strong>
                    <h5 id="prodi" class="mt-1 text-gray-700">
                        N/A
                    </h5>
                    <strong>Judul Aktivitas:</strong>
                    <h5 id="judul" class="mt-1 text-gray-700">
                        N/A
                    </h5>
                    <strong>Deskripsi:</strong>
                    <h5 id="deskripsi" class="mt-1 text-gray-700">
                        N/A
                    </h5>
                    <strong>Status:</strong>
                    <h5 id="status_log_aktivitas" class="mt-1 text-gray-700">
                        N/A
                    </h5>
                </figcaption>
                <button id="tutup" class="cursor-pointer mt-6 w-full px-4 py-2 bg-red-500 text-white rounded-lg transition-all duration-300 ease-in-out lg:hover:bg-red-600">
                    Tutup
                </button>
            </figure>
        @else
            <span class="w-full max-w-md rounded-xl bg-white p-6 shadow-lg text-center">
                <h5 class="text-gray-500">Tidak ada data untuk ditampilkan</h5>
            </span>
        @endif
    </div>
</section>