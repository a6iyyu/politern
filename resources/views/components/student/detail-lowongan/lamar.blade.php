<figure id="modal-detail-lamaran" class="modal-detail-lamaran fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <form action="{{ route('mahasiswa.lowongan.lamar', ['id' => $lowongan->id_lowongan]) }}" method="POST" class="h-[90vh] w-9/10 rounded-xl bg-white p-7 shadow-lg border border-[var(--stroke)] overflow-y-auto md:w-3/4 lg:w-1/2" role="document">
            @csrf
            @method('POST')
            <input type="hidden" name="id_lowongan" id="id_lowongan" value="{{ $lowongan->id_lowongan }}" />
            <span class="flex items-center justify-between mb-3">
                <h2 class="text-sm font-semibold text-[var(--primary)] lg:text-base" id="modal-title">Pengajuan Lamaran Magang</h2>
                <button type="button" class="close fa-solid fa-xmark text-[var(--primary)] cursor-pointer" aria-label="Tutup modal"></button>
            </span>
            <hr class="border border-[var(--primary)]" />
            <article class="flex-1 overflow-y-auto py-5 mb-5">
                <section aria-labelledby="info-pengajuan-heading" class="mb-6">
                    <h3 id="info-pengajuan-heading" class="mb-6 px-5 py-3 rounded-md text-sm bg-[var(--secondary)] text-white">
                        Informasi Pengajuan Magang
                    </h3>
                    <div class="px-6 flex items-center gap-8">
                        <span class="h-full flex items-center justify-center">
                            <img id="logo" alt="Logo Perusahaan" class="hidden w-12 h-12 object-cover lg:inline">
                        </span>
                        <span class="cursor-default h-full w-full flex flex-col space-y-2">
                            <p class="flex items-center gap-2 text-sm">
                                <strong class="text-[var(--primary-text)]">Bidang Posisi:</strong>
                                <span id="bidang_posisi" class="text-[var(--secondary-text)]">-</span>
                            </p>
                            <p class="flex items-center gap-2 text-sm">
                                <strong class="text-[var(--primary-text)]">Nama Perusahaan Mitra:</strong>
                                <span id="nama_perusahaan" class="text-[var(--secondary-text)]">-</span>
                            </p>
                            <p class="flex items-center gap-2 text-sm">
                                <strong class="text-[var(--primary-text)]">Lokasi:</strong>
                                <span id="lokasi" class="text-[var(--secondary-text)]">-</span>
                            </p>
                        </span>
                    </div>
                </section>
                <section class="mb-6" aria-labelledby="data-mahasiswa-heading">
                    <h3 id="data-mahasiswa-heading" class="my-6 px-5 py-3 rounded-md text-sm bg-[var(--secondary)] text-white">Data Mahasiswa</h3>
                    <div class="px-2 grid grid-cols-2 gap-y-4 gap-x-14 mt-5 text-sm">
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">NIM:</dt>
                            <dd id="nim_mahasiswa" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">Nama Lengkap:</dt>
                            <dd id="nama_lengkap_mahasiswa" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">Angkatan:</dt>
                            <dd id="angkatan_mahasiswa" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">Semester:</dt>
                            <dd id="semester_mahasiswa" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">Program Studi:</dt>
                            <dd id="program_studi_mahasiswa" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">IPK:</dt>
                            <dd id="ipk_mahasiswa" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">Nomor Telepon:</dt>
                            <dd id="nomor_telepon_mahasiswa" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">Status:</dt>
                            <dd id="status_mahasiswa" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                    </div>
                </section>
            </article>
            <span class="mt-5 flex justify-end gap-3">
                <button type="submit" class="px-4 py-2 bg-[var(--primary)] text-white rounded-md hover:bg-opacity-80 transition-all">
                    Kirim Lamaran
                </button>
                <button type="button" class="close px-4 py-2 bg-gray-300 text-black rounded-md hover:bg-opacity-80 transition-all">
                    Batal
                </button>
            </span>
        </form>
    </div>
</figure>