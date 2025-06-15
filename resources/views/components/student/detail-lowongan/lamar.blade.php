<section class="modal-ajukan-lamaran fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <figure class="h-[90vh] w-9/10 rounded-xl bg-white p-7 shadow-lg border border-[var(--stroke)] overflow-y-auto md:w-3/4 lg:w-1/2">
            <span class="flex items-center justify-between mb-3">
                <h2 class="text-sm font-semibold text-[var(--primary)] lg:text-base">Pengajuan Lamaran Magang</h2>    
                <i id="tutup-ajukan-lamaran" class="fa-solid fa-xmark cursor-pointer"></i>
            </span>
            <hr class="border border-[var(--primary)]" />
            <figcaption class="flex-1 overflow-y-auto py-5 mb-5">
                <section aria-labelledby="info-pengajuan-heading" class="mb-6">
                    <h3 id="info-pengajuan-heading" class="mb-6 px-5 py-3 rounded-md text-sm bg-[var(--secondary)] text-white">
                        Informasi Pengajuan Magang
                    </h3>
                    <div class="px-6 flex items-center gap-8">
                        <div class="h-full flex items-center justify-center">
                            <img id="logo" alt="Logo Perusahaan" class="hidden w-12 h-12 object-cover lg:inline">
                        </div>
                        <div class="cursor-default h-full w-full flex flex-col space-y-2">
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
                        </div>
                    </div>
                </section>
                <section class="mb-6">
                    <h3 id="data-mahasiswa-heading" class="my-6 px-5 py-3 rounded-md text-sm bg-[var(--secondary)] text-white">Data Mahasiswa</h3>
                    <div class="px-2 grid grid-cols-2 gap-y-4 gap-x-14 mt-5 text-sm">
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">NIM:</dt>
                            <dd id="nim" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">Nama Lengkap:</dt>
                            <dd id="nama_lengkap" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">Angkatan:</dt>
                            <dd id="angkatan" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">Semester:</dt>
                            <dd id="semester" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">Program Studi:</dt>
                            <dd id="program_studi" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">IPK:</dt>
                            <dd id="ipk" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">Nomor Telepon:</dt>
                            <dd id="nomor_telepon" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">Status:</dt>
                            <dd id="status" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">Daftar Riwayat Hidup:
                                <div class="mt-2 px-6 py-4 border border-[var(--stroke)] rounded-md">
                                    <h5 id="file-downloads" class="space-y-1 text-sm text-blue-700 underline">-</h5>
                                </div>
                            </dt>
                        </dl>
                    </div>
                </section>
                {{-- <section class="mb-6">
                    <div class="px-2 grid grid-cols-2 gap-y-4 gap-x-14 mt-5 text-sm">
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">Preferensi lokasi magang</dt>
                            <dd id="nama_lokasi" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">Preferensi bidang keahlian</dt>
                            <dd id="bidang" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">Preferensi gaji</dt>
                            <dd id="gaji" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <dl class="flex flex-col">
                            <dt class="font-semibold text-[var(--primary-text)] mb-1">Preferensi jenis lokasi</dt>
                            <dd id="jenis_lokasi" class="text-[var(--secondary-text)]">-</dd>
                        </dl>
                        <figcaption class="mb-4">
                            <h3 class="font-semibold text-sm text-gray-800 mb-2">Keahlian</h3>
                            <div id="nama_keahlian" class="flex flex-wrap gap-2 text-xs"></div>
                        </figcaption>
                    </div>  
                </section> --}}
            </figcaption>
        </figure>
    </div>
</section>