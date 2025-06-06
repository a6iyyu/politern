<section class="modal modal-tambah-perusahaan fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="min-h-screen flex items-center justify-center w-full px-4">
        <form action="{{ route('admin.data-perusahaan.tambah') }}" enctype="multipart/form-data" method="POST" class="max-h-[90vh] overflow-y-auto w-full max-w-xl rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('POST')
              <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default text-sm font-semibold text-[var(--primary)]">
                    Tambah Perusahaan Mitra
                </h2>
                <i class="close fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
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
                    :options="['AKTIF' => 'Aktif', 'TIDAK AKTIF' => 'Tidak Aktif']"
                />
                <x-select
                    icon="fa-solid fa-map-marker-alt"
                    label="Lokasi"
                    type="text"
                    name="id_lokasi"
                    placeholder=""
                    :required="true"
                    :options="$lokasi"
                />
            </span>
            </div>
            <span class="flex justify-end gap-3 text-sm items-center mt-6">
               <button type="submit" class="mt-4 mb-2 w-full bg-[var(--primary)] text-white text-sm px-5 py-3 rounded-md transition-all hover:bg-[#5955b2]/90 duration-300 ">
                Simpan
               </button>
            </span>
        </form>
    </div>
</section>