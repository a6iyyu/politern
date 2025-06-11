<section class="modal modal-edit-pengajuan fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <figure class="min-h-screen flex items-center justify-center w-full px-4">
        <form action="{{ route('admin.pengajuan-magang.perbarui', ['id' => 'id_edit_pengajuan']) }}" id="edit-formulir-pengajuan" method="POST" class="max-h-[90vh] overflow-y-auto w-full max-w-2xl rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)]" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id_edit_pengajuan" id="id_edit_pengajuan">
            <div class="flex items-center justify-between mb-3">
                <h2 class="text-lg font-semibold text-[#5955B2]">Edit Pengajuan Magang</h2>
                <button type="button" class="close-edit cursor-pointer transition-all duration-300 ease-in-out text-gray-400 lg:hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <hr class="border border-[var(--primary)] mb-6" />
            <h5 class="bg-[var(--primary)] text-white text-left py-3 rounded-md text-sm font-medium mb-6 px-4">
                Edit Pengajuan Magang
            </h5>
            <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input
                    disabled
                    id="edit_nim"
                    name="nim"
                    label="NIM"
                    icon="fa-solid fa-id-card"
                    type="text"
                    :required="true"
                    :value="old('nim')"
                />
                <x-input
                    disabled
                    id="edit_nama"
                    name="nama"
                    label="Nama Mahasiswa"
                    icon="fa-solid fa-user"
                    type="text"
                    :required="true"
                    :value="old('nama')"
                />
                <x-input
                    disabled
                    id="edit_prodi"
                    name="prodi"
                    label="Program Studi"
                    icon="fa-solid fa-school"
                    type="text"
                    :required="true"
                    :value="old('prodi')"
                />
                <x-input
                    disabled
                    id="edit_ipk"
                    name="ipk"
                    label="IPK"
                    icon="fa-solid fa-check-double"
                    type="text"
                    :required="true"
                    :value="old('ipk')"
                />
            </div>
            <x-select
                id="edit_status"
                name="status"
                icon="fa-solid fa-circle-info"
                label="Status"
                placeholder="-- Status --"
                :required="true"
                :options="['MENUNGGU' => 'Menunggu', 'DISETUJUI' => 'Disetujui', 'DITOLAK' => 'Ditolak']"
                :selected="old('status', $pengajuan->status ?? '')"
            />
            <fieldset class="relative mt-4">
                <label for="catatan" class="font-medium text-sm text-[var(--primary-text)]">Catatan</label>
                <textarea name="catatan" id="catatan" class="resize-none mt-4 w-full rounded-lg border border-[var(--stroke)] px-4 py-2 text-sm" rows="3">{{ old('catatan') }}</textarea>
            </fieldset>
            <div class="flex justify-end mt-6">
                <button type="submit" class="cursor-pointer bg-[var(--primary)] text-white font-semibold px-4 py-2 rounded-md text-sm transition-all duration-300 ease-in-out lg:hover:bg-[var(--primary)]/80">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </figure>
</section>