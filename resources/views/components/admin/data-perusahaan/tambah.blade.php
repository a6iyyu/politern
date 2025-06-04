<section class="modal modal-tambah-perusahaan fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="min-h-screen flex items-center justify-center w-full px-4">
        <form action="{{ route('admin.data-perusahaan.tambah') }}" method="POST" class="max-h-[90vh] overflow-y-auto w-full max-w-xl rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('POST')
            <h2 class="text-lg font-semibold text-center text-gray-800 mb-3">
                Tambah Perusahaan Mitra
            </h2>
            <hr class="mb-4 border border-[var(--primary)]" />
            <div class="my-6 flex flex-col gap-3">
                <x-input
                    icon="fa-solid fa-building"
                    label="Nama Perusahaan"
                    type="text"
                    name="nama"
                    placeholder="Masukkan perusahaan mitra"
                    :required="true"
                />
                <x-input
                    icon="fa-solid fa-image"
                    label="Gambar/Logo Perusahaan"
                    type="file"
                    name="logo"
                    placeholder="Masukkan Logo"
                    :required="true"
                />
                <x-input
                    icon="fa-solid fa-id-card"
                    label="NIB"
                    type="number"
                    name="nib"
                    placeholder="Masukkan NIB"
                    :required="true"
                />
            <span class="mb-2 mt-3 flex items-center justify-between gap-4">
                <x-input
                    icon="fa-solid fa-envelope"
                    label="Email"
                    type="email"
                    name="email"
                    placeholder="Masukkan Email"
                    :required="true"
                />
                <x-input
                    icon="fa-solid fa-phone"
                    label="Nomor Telepon"
                    type="number"
                    name="nomor_telepon"
                    placeholder="Masukkan Nomor Telepon"
                    :required="true"
                />
            </span>
            <span class="mb-2 mt-3 flex items-center justify-between gap-4">
                <x-input
                    icon="fa-solid fa-globe"
                    label="Website"
                    type="text"
                    name="website"
                    placeholder="Masukkan Website"
                    :required="true"
                />
                <x-select
                    icon="fa-solid fa-toggle-on"
                    label="Status"
                    type="text"
                    name="status"
                    placeholder=""
                    :required="true"
                    :options="['Aktif' => 'Aktif', 'Tidak Aktif' => 'Tidak Aktif']"
                />
            </span>
            </div>
            <span class="flex justify-end gap-3 text-sm items-center mt-6">
                <button type="button" class="close cursor-pointer bg-red-500 text-white px-5 py-2 rounded hover:bg-red-600 transition-all duration-300">
                    Tutup
                </button>
                <button type="submit" class="cursor-pointer bg-[var(--blue-tertiary)] text-white px-5 py-2 rounded hover:bg-[#3d65a5] transition-all duration-300">
                    Kirim
                </button>
            </span>
        </form>
    </div>
</section>