<section class="modal modal-konfirmasi fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <form id="konfirmasi" method="POST" class="konfirmasi max-h-[90vh] overflow-y-auto w-full max-w-3xl rounded-xl bg-white p-7 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" id="statusInput" value="">
            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default text-sm font-semibold text-[var(--primary)] lg:text-base">Konfirmasi Pengajuan Magang</h2>
                <i id="close-konfirmasi" class="close-konfirmasi fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
            <hr class="mb-6 border border-[var(--primary)]" />

            <h5 class="cursor-default mb-6 px-5 py-3 rounded-md text-sm bg-[var(--secondary)] text-white">
                Informasi Pengajuan Magang
            </h5>
            <div class="px-3 py-2 mb-6">
                <div class="space-y-3">
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-[var(--secondary-text)]">Nama Lengkap:</span>
                        <span id="nama_lengkap_konfirmasi" class="text-[var(--primary)] font-semibold"></span>
                    </div>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-[var(--secondary-text)]">NIM:</span>
                        <span id="nim_konfirmasi" class="text-[var(--primary)] font-semibold"></span>
                    </div>
                    <hr class="border-[var(--stroke)]" />
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-[var(--secondary-text)]">Bidang Posisi:</span>
                        <span id="posisi_konfirmasi" class="text-[var(--primary-text)] font-semibold"></span>
                    </div>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-[var(--secondary-text)]">Nama Perusahaan Mitra:</span>
                        <span id="nama_perusahaan_konfirmasi" class="text-[var(--primary-text)] font-semibold"></span>
                    </div>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-[var(--secondary-text)]">Lokasi:</span>
                        <span id="lokasi_konfirmasi" class="text-[var(--primary-text)] font-semibold"></span>
                    </div>
                </div>
            </div>

            <h5 class="cursor-default mb-6 px-5 py-3 rounded-md text-sm bg-[var(--secondary)] text-white">
                Konfirmasi Dosen Pembimbing
            </h5>
            <div class="mb-6">
                <x-select
                    label="Dosen Pembimbing"
                    name="dosen_pembimbing"
                    placeholder="-- Pilih Dosen --"
                    :options="$dosen_pembimbing"
                    :required="true"
                    :selected="old('dosen_pembimbing')"
                />
            </div>

            <div class="mt-10 mb-2 flex justify-end space-x-4">
                <button type="button" id="tolak" class="w-1/2 py-3 text-sm text-[var(--red-tertiary)] border border-[var(--red-tertiary)] rounded-md">Tolak</button>
                <button type="button" id="terima" class="w-1/2 py-3 text-sm text-white bg-[var(--primary)] rounded-md">Terima</button>
            </div>
        </form>
    </div>
</section>